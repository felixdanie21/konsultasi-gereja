<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notfound extends CI_Controller
{

	public function index()
	{
		$data['url_kembali'] = "Dashboard";
		if(!empty($_SERVER['HTTP_REFERER'])){
			$data['url_kembali'] = $_SERVER['HTTP_REFERER'];
		}
		$this->load->view('notfound',$data);
	}
}
