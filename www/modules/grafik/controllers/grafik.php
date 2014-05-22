<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grafik extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
					'perawat/perawat_model',
					'pelanggan/pelanggan_model',
					'jawaban/jawaban_model',
					'group/group_model',
					'soal/soal_model',
				));
		$this->load->library(array('highcharts','ion_auth','session','form_validation'));
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}
	
	function debuk()
	{
		$data = $this->_data();
		$data2 = $this->_ar_data();
		echo "Data masih mentah";
		
		dump($data);
		br(2);
		echo "Data sesudah foreach()";
		dump($data2); 
		exit;
	}
	
	/**
	 * _data function.
	 * data for examples
	 */
	function _data()
	{
		$data['users']['data'] = array(536564837, 444948013, 153309074, 99143700, 82548200);
		$data['users']['name'] = 'Users by Language';
		$data['popul']['data'] = array(1277528133, 1365524982, 420469703, 126804433, 250372925);
		$data['popul']['name'] = 'World Population';
		$data['axis']['categories'] = array('English', 'Chinese', 'Spanish', 'Japanese', 'Portuguese');
	
		return $data;
	}
	
	/**
	 * _ar_data function.
	 * simulate Active Record result
	 */
	function _ar_data()
	{
		$data = $this->_data();
		foreach ($data['users']['data'] as $key => $val)
		{
			// make an object push
			$output[] = (object)array(
					'users' 		=> $val,
					'population'	=> $data['popul']['data'][$key],
					'contries'		=> $data['axis']['categories'][$key]
			);
		}
		return $output;
	}
	
	/**
	 * index function.
	 * Very basic example: juste draw some data
	 */
	function index()
	{
		$result = $this->_ar_data();
		$graph_data = $this->_data();
		
		// set data for conversion
		$dat1['x_labels'] 	= 'contries'; // optionnal, set axis categories from result row
		$dat1['series'] 	= array('users', 'population'); // set values to create series, values are result rows
		$dat1['data']		= $result;
		
		// just made some changes to display only one serie with custom name
		$dat2 = $dat1;
		$dat2['series'] = array('custom name' => 'users');
		
		$serie['data'] = array(20, 45, 60, 22, 6);
		
		// displaying muli graphs
		$this->highcharts
			->set_title('Home')
			->set_type('areaspline')
			->set_serie($serie)
			->set_serie($graph_data['users'])
			->set_serie($graph_data['popul'], 'Another series')// ovverride serie name
			->from_result($dat1)
			->add(); // first graph: add() register the graph
		
		$this->highcharts
			->initialize('highcharts')
			->set_dimensions(400, 200) // dimension: width, height
			->set_axis_titles('Angak', 'Jenis KElamin')
			->from_result($dat1)
			->add(); // second graph
		
		$data['charts'] = $this->highcharts->render();
		
		// render template
		$data['welcome'] = ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		
		//$this->load->view('charts', $data);
		
	}
	
	function soal()
	{
		// ambil masing masing soal
		
		
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "chart_soal"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		
	}
	
	/*
	 * Menjumlah seluruh karyawan
	 */
	function jumlah_semua()
	{
		$data['hasil'] 	 = $this->pelanggan_model->count();
		dump($data['hasil']);
		exit;
	}
	
	
	/**
	 * categories function.
	 * Lets go for a real world example
	 */
	function categories()
	{		
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		
		//$this->load->view('charts', $data);
	}
	
	/**
	 * template function.
	 * Load basic graph structure form template located in config file
	 */
	function template()
	{
		$graph_data = $this->_data();

		$this->load->library('highcharts');
		$this->highcharts->set_global(array('useUTC' => false));
		
		$this->highcharts
			//->initialize('chart_template') // load template	
			// ->push_xAxis($graph_data['axis']) // we use push to not override template config
			->set_serie($graph_data['users'], 'Another users')
			->set_serie($graph_data['popul'], 'Another population'); // ovverride serie name 
		
		
		// we want to display the second serie as sline. First parameter is the serie name
		$this->highcharts->set_serie_options(array('type' => 'area'), 'Another description');
		
		$data['charts'] = $this->highcharts->render();
		
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik']  = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		// $this->load->view('charts', $data);
	}
	
	/**
	 * active_record function.
	 * Example by passing data from AR result() (not result_array())
	 * 
	 * @access public
	 * @return void
	 */
	function active_record()
	{
		$result = $this->_ar_data();
		
		// set data for conversion
		$dat1['x_labels'] 	= 'contries'; // optionnal, set axis categories from result row
		$dat1['series'] 	= array('users', 'population'); // set values to create series, values are result rows
		$dat1['data']		= $result;
		
		// just made some changes to display only one serie with custom name
		$dat2 = $dat1;
		//$dat2['series'] = array('custom name' => 'users');
		
		$this->load->library('highcharts');
		
		// displaying muli graphs
		$this->highcharts->from_result($dat1)->add(); // first graph: add() register the graph
		$this->highcharts
			->initialize('chart_template')
			->set_dimensions('', 200) // dimension: width, height
			->from_result($dat2)
			->add(); // second graph
		
		$data['charts'] = $this->highcharts->render();
		
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		//$this->load->view('charts', $data);
	}
	
	/**
	 * data_get function.
	* Output data as array on json string
	 */
	function data_get()
	{
		$this->load->library('highcharts');
		
		// some data series
		$serie['data'] = array(20, 45, 60, 22, 6, 36);
		$this->highcharts->set_serie($serie);
		
		$data['array']  = $this->highcharts->get_array();
		$data['json']   = $this->highcharts->get(); // false to keep data (dont clear current options)
				
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		
		// $this->load->view('charts', $data);

	}
	
	/**
	 * pie function.
	 * Draw a Pie, and run javascript callback functions
	 * 
	 * @access public
	 * @return void
	 */
	function pie()
	{
		$this->load->library('highcharts');
		
		$serie['data']	= array(
			array('value one', 20), 
			array('value two', 45), 
			array('other value', 60)
		);
		
		$callback = "function() { return '<b>'+ this.point.name +'</b>: '+ this.y +' %'}";
		
		$tool->formatter = $callback;
		$plot->pie->dataLabels->formatter = $callback;
		
		$this->highcharts
			->set_type('pie')
			->set_serie($serie)
			->set_tooltip($tool)
			->set_plotOptions($plot);
		
		$data['charts'] = $this->highcharts->render();
		
		// render template
		$data['welcome'] = "Welcome " . ucfirst($this->session->userdata('email'));
		$data['title'] 	 = "Charts";
		$data['grafik'] = "grafik"; // Controller
		$data['view'] 	 = "charts"; // View
		$data['module']  = "grafik"; // Controller
		
		echo Modules::run('template/direktur',$data);
		// $this->load->view('charts', $data);
	}
	
	
	// HELPERS FUNCTIONS
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */