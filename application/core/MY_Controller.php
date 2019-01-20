<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{



	function _page_front($content, $data = NULL)
	{				
		$data['head'] = $this->load->view('head', $data, TRUE);	
		$data['content'] = $this->load->view($content, $data, TRUE);	
		$this->load->view('foot', $data);
	}






}