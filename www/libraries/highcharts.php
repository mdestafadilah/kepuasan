<?php
/***************************************************************************************
 *                       			highcharts.php
 ***************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	highcharts.php
 *      Created:   		2013 - 02.25.14 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 						Version 1, December 2009
 *						Copyright (C) 2009 Philip Sturgeon
 *
 *		source:			https://github.com/ronan-gloo/codeigniter-highcharts-library
 *
 ****************************************************************************************/
 class Highcharts 
 {
 	// static variabel, untuk deklarasi render function
 	private static $chart_id = 0;	
 	// shared graph data
 	private $shared_opts	= array();
 	// stoked graph data
 	private $global_opts	= array();
 	// current graph data
 	private $opts			= array();
 	
 	private $replace_keys, $orig_keys, $serie_index = 0;
 	
 	// nama chart for render fungsionality
 	public $js_chart_name = 'chart';
 	
 	/*
 	 * fungsi konstruktor, default OOp Codeigniter.
 	 * 
 	 * @access public
 	 * @param array $config (array())
 	 * @return void
 	 */
 	public function __construct($config = array())
 	{
 		if (count($config) > 0) $this->intialize($config);
 	}
 	
 	/*
 	 * Initalize Function
 	 * load config file from form
 	 * 
 	 * @access public
 	 * @param mixed $template
 	 * @param bool $config_file, default: FALSE
 	 * @param string $config_path, default: 'highcharts'
 	 * @return void
 	 */
 	public function intialize($config = array(), $config_path = 'highcharts')
 	{
 		// it's mean load the template
 		if (is_string($config))
 		{
 			$ci =& get_instance();
 			$ci->config->load($config_path);
 			
 			$config = $ci->config->item($config);
 			
 			if (count($config) > 0)
 			{
 				$this->opts = $this->set_local_options($config);
 			}
 		}
 		
 		if (isset($config['shared_options']) && empty($this->shared_opts))
 		{
 			$this->shared_opts = $config['shared_options'];
 			unset($config['shared_options']);
 		}
 		
 		if (! isset($this->opts['series'])) $this->opts['series'] = array();
 		if (! isset($this->opts['chart']['renderTo'])) $this->opts['chart']['renderTo'] = 'hc_chart';
 		
 		return $this;
 	}
 	
 	/*
 	 * Set_options function
 	 * fungsi ini memberikan seting global chart menyeluruh
 	 * 
 	 * @acceess public
 	 * @param array $optiosn, default: array()
 	 * @return void
 	 */
 	public function set_global_options($options = array())
 	{
 		if (! empty($options)) $this->shared_opts = $this->set_local_options($options);
 		return $this;
 	}
 	
 	/*
 	 * __Call function
 	 * 
 	 * @access public
 	 * @param mixed $func
 	 * @param mixed $args
 	 * @return void
 	 */
 	public function __call($func, $args)
 	{
 		if(strpos($func,'_'))
 		{
 			list($action, $type) = explode('_',$func);
 			
 			if (! isset($this->opts[$type]))
 			{
 				$this->opts[$type] = array();
 			}
 			switch ($action)
 			{
 				case 'set':
 					$this->opts[$type] = $this->set_local_options($args[0]);
 					break;
 				case 'push':
 					$this->opts[$type] += $this->set_local_options($args[0]);
 					break;
 				case 'unset':
 					$this->unset_local_options($args, $type);
 					break;
 			}
 		}
 		return $this;
 	}
 	
 	/*
 	 * Set_Local_Options function
 	 * 
 	 * @access private
 	 * @param array $options, default: array()
 	 * @param array $root, default: array()
 	 * @return void
 	 */
 	private function set_local_options($options = array(), $root = array())
 	{
 		foreach ($options as $opt_key => $opt_name)
 		{
 			if (is_string($opt_key))
 			{
 				if (is_object($opt_name))
 				{
 					$root[$opt_key] = array();
 					$root[$opt_key] = $this->set_local_options($opt_key); // convert back to array
 				}
 				else
 					$root[$opt_key] = $this->encode_function($opt_name);
 			}
 		}
 		return $root;
 	}
 	
 	/*
 	 * unset_options function
 	 * 
 	 * @access private
 	 * @param array $options, default: array()
 	 * @param mixed $type
 	 * @return void
 	 */
 	private function unset_local_options($options = array(), $type)
 	{
 		foreach ($options as $option)
 		{
 			if (array_key_exists($option, $this->opts[$type]))
 			{
 				unset ($this->opts[$type][$option]);
 			}
 		}
 	}
 	
 	// ---------------------------------------------------------------
 	// FUNCTION USED!!
 	// ---------------
 	// 1. set_title -> set title and subtitle dalam 1 kali tulisan
 	// 2. set_axis_titles -> seting x dan y axis in graph
 	// 3. render_to -> set container 'id' untuk render graphik
 	//
 	//
 	// ----------------------------------------------------------------
 	
 	/*
 	 * set_title function
 	 * -----
 	 * Digunakan untuk judul dan sub judul grafik,
 	 * 
 	 * @access public
 	 * @param string $title, default: ''
 	 * @param array $options, default: array()
 	 * @return void
 	 */
 	function set_title($title = '', $subtitle = '')
 	{
 		// jika title di isi, passing ke array assosiasi
 		if ($title) $this->opts['title']['text'] = $title; 
 		// 
 		if ($subtitle) $this->opts['subtitle']['text'] = $subtitle;
 		
 		// give me back!
 		return $this;
 	}
 	
 	/*
 	 * set_axis_titles function
 	 * ------
 	 * menulis bagan x dan y dengan teks
 	 * 
 	 * @access public
 	 * @param string $x_label, default: ''
 	 * @param string $y_label, default: ''
 	 * @return void
 	 */
 	function set_axis_titles($x_title = '', $y_title = '')
 	{
 		// jika setting x
 		if ($x_title) $this->opts['xAxis']['title']['text'] = $x_title;
 		// jika setting y
 		if ($x_title) $this->opts['yAxis']['title']['text'] = $y_title;
 		
 		return $this;
 	}
 	
 	/*
 	 * render_to function
 	 * ----
 	 * set graphik to render 'id's
 	 * 
 	 * @access public
 	 * @param $string $id, default: ''
 	 * @return void
 	 */
 	function render_to($id = '')
 	{
 		$this->opts['chart']['renderTo'] = $id;
 		return $this;
 	}
 	
 	/*
 	 * set_type function
 	 * -----
 	 * type grapik yang digunakan
 	 * see: http://api.highcharts.com/highcharts#chart.type
 	 * 	@documentation, try tested with me!!
 	 * 	- pie
 	 * 	- spline
 	 * 	- area
 	 *  - bar
 	 *  - column
 	 *  - areaspline
 	 *  - scatter
 	 *  
 	 * @access public
 	 * @param string $type, default: ''
 	 * @return void
 	 */
 	
 	function set_type($type = '')
 	{
 		if ($type && is_string($type)) $this->opts['chart']['type'] = $type;
 		
 		return $this;
 	}
 	
 	/*
 	 * set_dimension functiion
 	 * ---------
 	 * fasat set dimension of the graph is desired
 	 * see: http://api.highcharts.com/highcharts#chart.width
 	 * see: http://api.highcharts.com/highcharts#chart.height
 	 * 
 	 * @access public
 	 * @param mixed $width, default: null
 	 * @param mixed $height, default: null
 	 * @return void
 	 */
 	function set_dimensions($width = null, $height = null)
 	{
 		if ($width) $this->opts['chart']['width'] = (int)$width;
 		if ($height) $this->opts['chart']['height'] = (int)$height;
 		
 		return $this;
 	}
 	
 	/*
 	 * set_serie function
 	 * ---------
 	 * see: http://api.highcharts.com/highcharts#Series.chart
 	 * 
 	 * @access public
 	 * @param string $s_serie_name, default: ''
 	 * @param array ($a_value, default: array()
 	 * @return void
 	 */
 	function set_serie($options = array(), $serie_name = '')
 	{
 		if (! $serie_name && ! isset($options['name']))
 		{
 			$serie_name = count($this->opts['series']);
 		}
 		// overide with the serie name passed
 		else if ($serie_name && isset($options['name']))
 		{
 			$options['name'] = $serie_name;
 		}
 		
 		$index = $this->find_serie_name($serie_name);
 		
 		if (count($options) > 0)
 		{
 			foreach ($options as $key => $value)
 			{
 				$value = (is_numeric($value)) ? (float)$value : $value;
 				$this->opts['series'][$index][$key] = $value;
 			}
 		}
 		return $this;
 	}
 	
 	/*
 	 * set_serie_option function
 	 * -----
 	 * setting each serie options for graph
 	 * 
 	 * @access public
 	 * @param string $s_serie_name default: ''
 	 * @param string $s_option, defulat: ''
 	 * @param string $value , default: ''
 	 * @return void
 	 */
 	function set_serie_options($options = array(), $serie_name = '')
 	{
 		if($serie_name && count($options) > 0)
 		{
 			$index = $this->find_serie_name($serie_name);
 			
 			foreach ($options as $key => $opt)
 			{
 				$this->opts['series'][$index][$key] = $opt;
 			}
 		}
 		return $this;
 	}
 	
 	/*
 	 * push_serie_data function
 	 * ----
 	 * 
 	 * @access public
 	 * @param string $s_serie_name, default: ''
 	 * @param string $s_value, default: ''
 	 * @return void
 	 */
 	function push_serie_data($value = '', $serie_name = '')
 	{
 		if ($serie_name && $value)
 		{
 			$index = $this->find_serie_name($serie_name);
 			
 			$value = (is_numeric($value)) ? (float)$value : $value;
 			
 			$this->opts['series'][$index]['data'][] = $value;
 		}
 		return $this;
 	}
 	
 	/*
 	 * find_serie_name function
 	 * ----
 	 * 
 	 * @access private
 	 * @return void
 	 */
 	private function find_serie_name($name)
 	{
 		$tot_indexes = count($this->opts['series']);
 		
 		if ($tot_indexes > 0)
 		{
 			foreach ($this->opts['series'] as $index => $serie)
 			{
 				if (isset($serie['name']) && strtolower($serie['name']) == strtolower($name))
 				{
 					return $index;
 				}
 			}
 		}
 		
 		$this->opts['series'][$tot_indexes]['name'] = $name;
 		return $tot_indexes;
 	}
 	
 	/*
 	 * push_categories
 	 * ----
 	 * add custom name to axes
 	 * 
 	 * @access public
 	 * @param mixed $value
 	 * @return void
 	 * 
 	 */
 	function push_categories($value, $axis = 'x')
 	{
 		if(trim($value)!= '') $this->opts[$axis.'axis']['categories'][] = $value;
 		return $this;
 	}
 	
 	/*
 	 * from_result function
 	 * 
 	 * @access public
 	 * @param array $data, default: array()
 	 * @return void
 	 */
 	function from_result($data = array())
 	{
 		if (! isset($this->opts['series']))
 		{
 			$this->opts['series'] = array();
 		}
 		foreach ($data['data'] as $row)
 		{
 			if (isset($data['x_labels'])) $this->push_categories($row->$data['x_labels'],'x');
 			if (isset($data['y_labels'])) $this->push_categories($row->$data['y_labels'],'y');
 			
 			foreach ($data['series'] as $name => $value)
 			{
 				// 
 				if (is_string($value))
 				{
 					$text = (is_string($name)) ? $name : $value;
 					$dat = $row->$value;
 				}
 				else if (is_array($value))
 				{
 					if (isset($value['name']))
 					{
 						$text = $value['name'];
 						unset($value['name']);
 					}
 					else
 					{
 						$text = $value['row'];
 					}
 					$dat = $row->{$value['row']};
 					unset($value['row']);
 					
 					$this->set_serie_options($value, $text);
 				}
 				
 				$this->push_serie_data($dat, $text);
 			}
 		}
 		return $this;
 	}
 	
 	/*
 	 * Add function
 	 * ------
 	 * jika pilihan berupa string, dan halaman dari pilihan di simpan
 	 * 
 	 * @access public
 	 * @param array $options, default: array()
 	 * @return void
 	 */
 	function add($options = array(), $clear = true)
 	{
 		if (count($this->global_opts) <= self::$chart_id && ! empty($this->opts['series']))
 		{
 			if (is_string($options) && trim ($options) !== '')
 			{
 				$this->global_opts[$options] = $this->opts;
 			}
 			else
 			{
 				$this->global_opts[self::$chart_id] = (count($options) > 0) ? $options : $this->opts;
 			}
 		}
 		
 		self::$chart_id++;
 		
 		if ($clear === true) $this->clear();
 		
 		return $this;
 	}
 	
 	/*
 	 * Get function
 	 * ------------
 	 * return the global options array as json string
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	function get($clear = true)
 	{
 		$this->add();
 		
 		foreach ($this->global_opts as $key => $opts)
 		{
 			$this->global_opts[$key] = $this->encode($opts);
 		}
 		
 		return $this->process_get($this->global_opts, $clear, 'json');
 	}
 	
 	function get_array($clear = true)
 	{
 		$this->add();
 		return $this->process_get($this->global_opts, $clear, 'array');
 	}
 	
 	/**
 	 * encode function.
 	 * Search and replace delimited functions by encode_function()
 	 * We need to remove quotes from json string in order to
 	 * make javascript function works.
 	 *
 	 * @access public
 	 * @param mixed $options
 	 * @return void
 	 */
 	public function encode($options)
 	{
 		$options = str_replace('\\', '', json_encode($options));
 		return str_replace($this->replace_keys, $this->orig_keys, $options);
 	}
 	
 	/**
 	 * process_get function.
 	 * This functon send the output for get() and get_array().
 	 * it will return an associative array if some global variables are defined.
 	 *
 	 * @access private
 	 * @param mixed $options
 	 * @param mixed $clear
 	 * @return Json / Array
 	 */
 	private function process_get($options, $clear, $type)
 	{
 		if (count($this->shared_opts) > 0)
 		{
 			$global = ($type == 'json') ? $this->encode($this->shared_opts) : $this->shared_opts;
 				
 			$options = array('global' => $global, 'local' => $options);
 		}
 	
 		if ($clear === true) $this->clear();
 	
 		return $options;
 	}
 	
 	/**
 	 * get_embed function.
 	 * Return javascript embedable code and friend div
 	 *
 	 * @access public
 	 * @return void
 	 */
 	public function render()
 	{
 		$this->add();
 	
 		$i = 1; $d = 1; $divs = '';
 	
 		$embed  = '<script type="text/javascript">'."\n";
 		$embed .= '$(function(){'."\n";
 	
 		foreach ($this->global_opts as $opts)
 		{
 			if (count($this->shared_opts) > 0 AND $i === 1)
 			{
 				$embed .= 'Highcharts.setOptions('.$this->encode($this->shared_opts).');'."\n";
 			}
 	
 			if ($opts['chart']['renderTo'] == 'hc_chart')
 			{
 				$opts['chart']['renderTo'] .= '_'.$d;
 				$d++;
 			}
 				
 			$embed .= 'var '.$this->js_chart_name.'_'.	$i.' = new Highcharts.Chart('.$this->encode($opts).');'."\n";
 			$divs  .= '<div id="'.$opts['chart']['renderTo'].'"></div>'."\n";
 			$i++;
 		}
 	
 		$embed .= '});'."\n";
 		$embed .= '</script>'."\n";
 		$embed .= $divs;
 	
 		$this->clear();
 	
 		return $embed;
 	}
 	
 	/**
 	 * clear function.
 	 * clear instance properties. Very general at the moment, should only reset
 	 * desired vars when lib will be finish
 	 *
 	 * @access public
 	 * @return void
 	 */
 	public function clear($shared = false)
 	{
 		$this->opts = array();
 		$this->opts['series'] = array();
 		$this->opts['chart']['renderTo'] = 'hc_chart';
 		$this->serie_index = 0;
 	
 		if ($shared === true) $this->shared_opts = array();
 	
 		return $this;
 	}
 	
 	/**
 	 * encode_functions function.
 	 * We are looking for javascript functions and delimit them
 	 *
 	 * @access private
 	 * @param mixed $array
 	 * @return void
 	 */
 	private function encode_function($array = array())
 	{
 		if (is_string($array)) {
 			$array = $this->delimit_function($array);
 		}
 		else {
 			foreach($array as $key => $value) {
 				if (is_array($value)) {
 					$this->encode_function($value);
 				}
 				else {
 					$array[$key] = $this->delimit_function($value);
 				}
 			}
 		}
 		return $array;
 	}
 	
 	/**
 	 * delimit_function function.
 	 * 'Tag' javascript functions
 	 *
 	 * @access private
 	 * @param string $string. (default: '')
 	 * @return void
 	 */
 	private function delimit_function($string = '')
 	{
 		if(strpos($string, 'function(') !== false)
 		{
 			$this->orig_keys[] = $string;
 			$string = '$$' . $string . '$$';
 			$this->replace_keys[] = '"' . $string . '"';
 		}
 		return $string;
 	}
 	
 }
 
 
 /* End of File: highcharts.php */
/* Location: ../www/libraries/highcharts.php */ 