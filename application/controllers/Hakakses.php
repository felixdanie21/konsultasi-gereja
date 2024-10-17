<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->load->model('PendaftaranModel');
        $this->RyuModel->is_login();
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),0);
    }

	public function index()
	{
        $this->db->where('userlevel','1');
		$data['muser'] = $this->db->get('muser')->result_array();

		$data['idtable'] = 'hakaksespanitia';
        $data['submenu'] = 'hakakses';
        $data['indukmenu'] = '';
        $data['controller'] = 'Hakakses/index';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
		$this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('hakakses/index');
        $this->load->view('templates/footer');
	}

    public function form($userid,$kodemodul)
	{
        // security
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),'0');

		$this->db->where('userid',$userid);
		$data['muser'] = $this->db->get('muser')->row();

		$this->db->where('kodemodul',$kodemodul);
		$this->db->order_by('kodemenu','ASC');
		$data['mmenu'] = $this->db->get('mmenu')->result_array();

		$data['submenu'] = 'hakakses';
		$data['indukmenu'] = '';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
		$this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('hakakses/form');
        $this->load->view('templates/footer');
    }

    public function post($userid,$kodemodul)
	{
		$post = $this->input->post();
        // hapus musemenu
        $this->db->trans_start();
        $this->db->delete('musmenu',['userid'=>$userid,'kodemenu >='=>$kodemodul.'000000','kodemenu <='=>$kodemodul.'999999']);
        // insert musmenu
		foreach($post as $kodemenu => $value){
            $musmenu = [
				'userid' => $userid,
				'kodemenu' => $kodemenu
			];
			$this->db->insert("musmenu",$musmenu);
		}
        $this->db->trans_complete();

		$this->session->set_userdata('successmsg','BERHASIL MENGATUR HAK AKSES PANITIA');
		redirect('Hakakses');
	}
}
