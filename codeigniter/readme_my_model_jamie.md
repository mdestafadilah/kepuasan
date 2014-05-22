codeigniter-base-model
=====================================

[![Build Status](https://secure.travis-ci.org/jamierumbelow/codeigniter-base-model.png?branch=master)](http://travis-ci.org/jamierumbelow/codeigniter-base-model)

My CodeIgniter Base Model is an extended CI_Model class to use in your CodeIgniter applications. It provides a full CRUD base to make developing database interactions easier and quicker, as well as an event-based observer system, in-model data validation, intelligent table name guessing and soft delete.

Synopsis
--------

```php
class Post_model extends MY_Model { }

$this->load->model('post_model', 'post');

$this->post->get_all();

$this->post->get(1);
$this->post->get_by('title', 'Pigs CAN Fly!');
$this->post->get_many_by('status', 'open');

$this->post->insert(array(
    'status' => 'open',
    'title' => "I'm too sexy for my shirt"
));

$this->post->update(1, array( 'status' => 'closed' ));

$this->post->delete(1);
```

Installation/Usage
------------------

Download and drag the MY\_Model.php file into your _application/core_ folder. CodeIgniter will load and initialise this class automatically for you.

Extend your model classes from `MY_Model` and all the functionality will be baked in automatically.

Naming Conventions
------------------

This class will try to guess the name of the table to use, by finding the plural of the class name. 

For instance:

    class Post_model extends MY_Model { }

...will guess a table name of `posts`. It also works with `_m`:

    class Book_m extends MY_Model { }

...will guess `books`.

If you need to set it to something else, you can declare the _$\_table_ instance variable and set it to the table name:

    class Post_model extends MY_Model
    {
        public $_table = 'blogposts';
    }

Some of the CRUD functions also assume that your primary key ID column is called _'id'_. You can overwrite this functionality by setting the _$primary\_key_ instance variable:

    class Post_model extends MY_Model
    {
        public $primary_key = 'post_id';
    }

Callbacks/Observers
-------------------

There are many times when you'll need to alter your model data before it's inserted or returned. This could be adding timestamps, pulling in relationships or deleting dependent rows. The MVC pattern states that these sorts of operations need to go in the model. In order to facilitate this, **MY_Model** contains a series of callbacks/observers -- methods that will be called at certain points.

The full list of observers are as follows:

* $before_create
* $after_create
* $before_update
* $after_update
* $before_get
* $after_get
* $before_delete
* $after_delete

These are instance variables usually defined at the class level. They are arrays of methods on this class to be called at certain points. An example:

```php
class Book_model extends MY_Model
{
    public $before_create = array( 'timestamps' );
    
    protected function timestamps($book)
    {
        $book['created_at'] = $book['updated_at'] = date('Y-m-d H:i:s');
        return $book;
    }
}
```

**Remember to always always always return the `$row` object you're passed. Each observer overwrites its predecesor's data, sequentially, in the order they're defined.**

Observers can also take parameters in their name, much like CodeIgniter's Form Validation library. Parameters are then accessed in `$this->callback_parameters`:

    public $before_create = array( 'data_process(name)' );
    public $before_update = array( 'data_process(date)' );

    protected function data_process($row)
    {
        $row[$this->callback_parameters[0]] = $this->_process($row[$this->callback_parameters[0]]);

        return $row;
    }

Validation
----------

MY_Model uses CodeIgniter's built in form validation to validate data on insert.

You can enable validation by setting the `$validate` instance to the usual form validation library rules array:

    class User_model extends MY_Model
    {
        public $validate = array(
            array( 'field' => 'email', 
                   'label' => 'email',
                   'rules' => 'required|valid_email|is_unique[users.email]' ),
            array( 'field' => 'password',
                   'label' => 'password',
                   'rules' => 'required' ),
            array( 'field' => 'password_confirmation',
                   'label' => 'confirm password',
                   'rules' => 'required|matches[password]' ),
        );
    }

Anything valid in the form validation library can be used here. To find out more about the rules array, please [view the library's documentation](http://codeigniter.com/user_guide/libraries/form_validation.html#validationrulesasarray).

With this array set, each call to `insert()` or `update()` will validate the data before allowing  the query to be run. **Unlike the CodeIgniter validation library, this won't validate the POST data, rather, it validates the data passed directly through.**

You can skip the validation with `skip_validation()`:

    $this->user_model->skip_validation();
    $this->user_model->insert(array( 'email' => 'blah' ));

Alternatively, pass through a `TRUE` to `insert()`:

    $this->user_model->insert(array( 'email' => 'blah' ), TRUE);

Under the hood, this calls `validate()`.

Protected Attributes
--------------------

If you're lazy like me, you'll be grabbing the data from the form and throwing it straight into the model. While some of the pitfalls of this can be avoided with validation, it's a very dangerous way of entering data; any attribute on the model (any column in the table) could be modified, including the ID.

To prevent this from happening, MY_Model supports protected attributes. These are columns of data that cannot be modified.

You can set protected attributes with the `$protected_attributes` array:

    class Post_model extends MY_Model
    {
        public $protected_attributes = array( 'id', 'hash' );
    }

Now, when `insert` or `update` is called, the attributes will automatically be removed from the array, and, thus, protected:

    $this->post_model->insert(array(
        'id' => 2,
        'hash' => 'aqe3fwrga23fw243fWE',
        'title' => 'A new post'
    ));

    // SQL: INSERT INTO posts (title) VALUES ('A new post')

Relationships
-------------

**MY\_Model** now has support for basic _belongs\_to_ and has\_many relationships. These relationships are easy to define:

    class Post_model extends MY_Model
    {
        public $belongs_to = array( 'author' );
        public $has_many = array( 'comments' );
    }

It will assume that a MY_Model API-compatible model with the singular relationship's name has been defined. By default, 
this will be `relationship_model`. The above example, for instance, would require two other models:

    class Author_model extends MY_Model { }
    class Comment_model extends MY_Model { }

If you'd like to customise this, you can pass through the model name as a parameter:

    class Post_model extends MY_Model
    {
        public $belongs_to = array( 'author' => array( 'model' => 'author_m' ) );
        public $has_many = array( 'comments' => array( 'model' => 'model_comments' ) );
    }

You can then access your related data using the `with()` method:

    $post = $this->post_model->with('author')
                             ->with('comments')
                             ->get(1);

The related data will be embedded in the returned value from `get`:

    echo $post->author->name;

    foreach ($post->comments as $comment)
    {
        echo $message;
    }

Separate queries will be run to select the data, so where performance is important, a separate JOIN and SELECT call is recommended.

The primary key can also be configured. For _belongs\_to_ calls, the related key is on the current object, not the foreign one. Pseudocode:

    SELECT * FROM authors WHERE id = $post->author_id

...and for a _has\_many_ call:

    SELECT * FROM comments WHERE post_id = $post->id

To change this, use the `primary_key` value when configuring:

    class Post_model extends MY_Model
    {
        public $belongs_to = array( 'author' => array( 'primary_key' => 'post_author_id' ) );
        public $has_many = array( 'comments' => array( 'primary_key' => 'parent_post_id' ) );
    }

Arrays vs Objects
-----------------

By default, MY_Model is setup to return objects using CodeIgniter's QB's `row()` and `result()` methods. If you'd like to use their array counterparts, there are a couple of ways of customising the model.

If you'd like all your calls to use the array methods, you can set the `$return_type` variable to `array`.

    class Book_model extends MY_Model
    {
        protected $return_type = 'array';
    }

If you'd like just your _next_ call to return a specific type, there are two scoping methods you can use:

    $this->book_model->as_array()
                     ->get(1);
    $this->book_model->as_object()
                     ->get_by('column', 'value');

Soft Delete
-----------

By default, the delete mechanism works with an SQL `DELETE` statement. However, you might not want to destroy the data, you might instead want to perform a 'soft delete'.

If you enable soft deleting, the deleted row will be marked as `deleted` rather than actually being removed from the database.

Take, for example, a `Book_model`:

    class Book_model extends MY_Model { }

We can enable soft delete by setting the `$this->soft_delete` key:

    class Book_model extends MY_Model
    { 
        protected $soft_delete = TRUE;
    }

By default, MY_Model expects a `TINYINT` or `INT` column named `deleted`. If you'd like to customise this, you can set `$soft_delete_key`:

    class Book_model extends MY_Model
    { 
        protected $soft_delete = TRUE;
        protected $soft_delete_key = 'book_deleted_status';
    }

Now, when you make a call to any of the `get_` methods, a constraint will be added to not withdraw deleted columns:

    => $this->book_model->get_by('user_id', 1);
    -> SELECT * FROM books WHERE user_id = 1 AND deleted = 0

If you'd like to include deleted columns, you can use the `with_deleted()` scope:

    => $this->book_model->with_deleted()->get_by('user_id', 1);
    -> SELECT * FROM books WHERE user_id = 1

Built-in Observers
-------------------

**MY_Model** contains a few built-in observers for things I've found I've added to most of my models.

The timestamps (MySQL compatible) `created_at` and `updated_at` are now available as built-in observers:

    class Post_model extends MY_Model
    {
        public $before_create = array( 'created_at', 'updated_at' );
        public $before_update = array( 'updated_at' );
    }

**MY_Model** also contains serialisation observers for serialising and unserialising native PHP objects. This allows you to pass complex structures like arrays and objects into rows and have it be serialised automatically in the background. Call the `serialize` and `unserialize` observers with the column name(s) as a parameter:

    class Event_model extends MY_Model
    {
        public $before_create = array( 'serialize(seat_types)' );
        public $before_update = array( 'serialize(seat_types)' );
        public $after_get = array( 'unserialize(seat_types)' );
    }

Unit Tests
----------

MY_Model contains a robust set of unit tests to ensure that the system works as planned.

Install the testing framework (PHPUnit) with Composer:

    $ curl -s https://getcomposer.org/installer | php
    $ php composer.phar install

You can then run the tests using the `vendor/bin/phpunit` binary and specify the tests file:

    $ vendor/bin/phpunit tests/MY_Model_test.php


Contributing to MY_Model
------------------------

If you find a bug or want to add a feature to MY_Model, great! In order to make it easier and quicker for me to verify and merge changes in, it would be amazing if you could follow these few basic steps:

1. Fork the project.
2. **Branch out into a new branch. `git checkout -b name_of_new_feature_or_bug`**
3. Make your feature addition or bug fix.
4. **Add tests for it. This is important so I don’t break it in a future version unintentionally.**
5. Commit.
6. Send me a pull request!


Other Documentation
-------------------

* My book, The CodeIgniter Handbook, talks about the techniques used in MY_Model and lots of other interesting useful stuff. [Get a copy now.](https://efendibooks.com/books/codeigniter-handbook/vol-1)
* Jeff Madsen has written an excellent tutorial about the basics (and triggered me updating the documentation here). [Read it now, you lovely people.](http://www.codebyjeff.com/blog/2012/01/using-jamie-rumbelows-my_model)
* Rob Allport wrote a post about MY_Model and his experiences with it. [Check it out!](http://www.web-design-talk.co.uk/493/codeigniter-base-models-rock/)
* I've written a write up of the new 2.0.0 features [over at my blog, Jamie On Software.](http://jamieonsoftware.com/journal/2012/9/11/my_model-200-at-a-glance.html)

-------------------
CodeByJeff
-------------------
$row = $this->article_model->get(2);		
//stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) 
//SELECT * FROM (`articles`) WHERE `id` = 2

$row = $this->article_model->get_by('title', 'Fuzzy Wuzzy');
//stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) 
//SELECT * FROM (`articles`) WHERE `title` = 'Fuzzy Wuzzy'
// NOTE: if more than 1, returns first

$result = $this->article_model->get_many(array(1,3,4));
//Array ( [0] => stdClass Object ( [body] => bears are fuzzy and cute - but don't try to pet them! [title] => Something about bears [id] => 1 ) [1] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [2] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) ) 
//SELECT * FROM (`articles`) WHERE `id` IN (1, 3, 4)  

$result = $this->article_model->get_many_by('title', 'Dumb and boring post');
//Array ( [0] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [1] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) ) 
//SELECT * FROM (`articles`) WHERE `title` = 'Dumb and boring post'

$result = $this->article_model->get_all();
//Array ( [0] => stdClass Object ( [body] => bears are fuzzy and cute - but don't try to pet them! [title] => Something about bears [id] => 1 ) [1] => stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) [2] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [3] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) [4] => stdClass Object ( [body] => Ain't no sunshine [title] => When she's gone [id] => 13 ) [5] => stdClass Object ( [body] => Woot! [title] => My thoughts [id] => 11 ) [6] => stdClass Object ( [body] => Hello [title] => I must be going [id] => 12 ) ) 
//SELECT * FROM (`articles`)

$count = $this->article_model->count_by('title', 'Dumb and boring post');
//2
//SELECT COUNT(*) AS `numrows` FROM (`articles`) WHERE `title` = 'Dumb and boring post'

$count = $this->article_model->count_all();
//4
//SELECT COUNT(*) AS `numrows` FROM `articles`

$insert_id = $this->article_model->insert(array('body'=>'Woot!', 'title'=>'My thoughts'), FALSE);
//5
//INSERT INTO `articles` (`body`, `title`) VALUES ('Woot!', 'My thoughts')


$insert_array = array(
		array('body'=>'Hello', 'title'=>'I must be going'),
		array('body'=>"When she's gone", 'title'=>"Ain't no sunshine" ),
	);
$insert_ids = $this->article_model->insert_many($insert_array, FALSE);	
//Array ( [0] => 16 [1] => 17 ) //1
//INSERT INTO `articles` (`body`, `title`) VALUES ('When she\'s gone', 'Ain\'t no sunshine')


$update_id = $this->article_model->update(4, array('body'=>'This is dumber and more boring', 'title'=>'Dumber and boringer'));
//1
//UPDATE `articles` SET `body` = 'This is dumber and more boring', `title` = 'Dumber and boringer' WHERE `id` = 4

$update_id = $this->article_model->update_by(array('title'=>'My thoughts'), array('body'=>'Having deeper thoughts'));
//1
//UPDATE `articles` SET `body` = 'Having deeper thoughts' WHERE `title` = 'My thoughts'	

$update_id = $this->article_model->update_many(array(3,4,5), array('body'=>"Oh! I've been updated...and I feel MARVELOUS!"));
//1
//UPDATE `articles` SET `body` = 'Oh! I\'ve been updated...and I feel MARVELOUS!' WHERE `id` IN (3, 4, 5) 	

$update_id = $this->article_model->update_all( array('title'=>"Another dumb title"));
//1
//UPDATE `articles` SET `title` = 'Another dumb title' 	

$delete_id = $this->article_model->delete( 7);
//1
//DELETE FROM `articles` WHERE `id` = 7 

$delete_id = $this->article_model->delete_by( array('body'=>'Hello'));
//1
//DELETE FROM `articles` WHERE `body` = 'Hello' 

$delete_id = $this->article_model->delete_many( array(3,4,5));
//1
//DELETE FROM `articles` WHERE `id` IN (3, 4, 5) 

//// Utilities ////

// dropdown - automatically picks the primary key if only one value passed
$dropdown_array = $this->article_model->dropdown( 'title');
//Array ( [1] => Another dumb title [2] => Another dumb title ) 
//SELECT `id`, `title` FROM (`articles`)


// otherwise, give it a key, value pair to build on (my data is bad for example at this point)
$dropdown_array = $this->article_model->dropdown( 'title', 'body');
//Array ( [Another dumb title] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? ) 
//SELECT `title`, `body` FROM (`articles`)