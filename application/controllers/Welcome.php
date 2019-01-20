<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}


	function _code($nim)
    {

	    $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
 
        $image_name=$nim.'.png'; //buat name dari qr code sesuai dengan nim
 
        $params['data'] = $nim; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
	}


  public function generate()
  {

          $data = array ('success' => false, 'messages'=> array());       
          $valid = $this->form_validation;

          $valid->set_rules('code','Code','trim|required|xss_clean');                                  
          $valid->set_error_delimiters('<p class="text-danger">', '</p>');
          if($valid->run() == FALSE)
          {
                  foreach($_POST as $key => $value) 
                  {
                          $data['messages'][$key] = form_error($key);
                  }               
          
          }
          else
          {
                $code=$this->input->post('code');              
                $img = $code.'.png';
                $qrcode = $this->_code($code);
               // $this->siswa_model->simpan_siswa($nim,$nama,$jurusan,$code); //simpan ke database
				  $data['info'] = "<img src=".base_url('assets/images/'.$img)." class='rounded mx-auto d-block'>";
                  $data['success'] = true;   
                  //$data['redirect'] = base_url();     
                  
          }
          echo json_encode($data);        

  }
}
