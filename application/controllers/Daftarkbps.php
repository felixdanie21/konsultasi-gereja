<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftarkbps extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RyuModel');
        $this->load->model('MenuModel');
        $this->load->model('PendaftaranModel');
        $this->RyuModel->is_login();
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),1);
        $this->MenuModel->cekmenu('D010000');
    }

    public function index()
    {
        $this->db->join('msidang','msidang.sidangkode=mdaftar.sidangkode');
        $this->db->join('muser','muser.userid=mdaftar.daftarhp');
        $this->db->order_by('daftarverif','ASC');
        $this->db->order_by('daftarnama','ASC');
        $data['table'] = $this->db->get('mdaftar')->result_array();
        
        $data['idtable'] = 'mdaftar';
        $data['submenu'] = 'D010000';
        $data['indukmenu'] = '';
        $data['controller'] = 'Daftarkbps/index';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('daftarkbps/index',$data);
        $this->load->view('templates/footer');
    }

    public function verifikasi($daftarkp)
    {
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),0);
        $this->db->update('mdaftar',['daftarverif' => 'V'],['daftarkp'=>$daftarkp]);
        $this->session->set_userdata('successmsg','BERHASIL VERIFIKASI');
        redirect('Daftarkbps');
    }

    public function verifikasi_batal($daftarkp)
    {
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),0);
        $this->db->update('mdaftar',['daftarverif' => 'B'],['daftarkp'=>$daftarkp]);
        $this->session->set_userdata('successmsg','BERHASIL BATAL VERIFIKASI');
        redirect('Daftarkbps');
    }
}