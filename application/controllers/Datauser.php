<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datauser extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('MenuModel');
    $this->RyuModel->is_login();
    $this->MenuModel->userlevel($this->session->userdata('userlevel'),1);
}
public function index()
{
    $data['table'] =$this->db->get('muser')->result_array();
    
    $data['idtable'] = '';
    $data['submenu'] = 'datauser';
    $data['indukmenu'] = '';
    $data['controller'] = 'Datauser/index';
    $data['dbmenu'] = $this->MenuModel->listmenu('D');
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('datauser/index');
    $this->load->view('templates/footer');
}
public function form($method = 'tambah')
{
    if($method == 'edit'){
        $userId = $this->input->get('userid');
        $this->db->where('userid',$userId);
        $data['muser'] = $this->db->get('muser')->row();
    }
    $data['method'] = $method;
    $data['idtable'] = 'muser';
    $data['submenu'] = 'datauser';
    $data['indukmenu'] = '';
    $data['controller'] = 'Datauser/formuser';
    $data['dbmenu'] = $this->MenuModel->listmenu('D');
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('datauser/formuser',$data);
    $this->load->view('templates/footer');
}
public function ajax_datauser_cek_userid()
{
    $userid = $this->input->post('userid'); 
    $this->db->where('userid',$userid);
    $muser = $this->db->get('muser')->row();
    if($muser){
        echo '1';
    } else {
        echo '0';
    }
}

public function form_post($jenis)
{
 $userid = $this->input->post('userid');
 $username = $this->input->post('username');
 $userlevel = $this->input->post('userlevel');
 $password = $userid;

 if ($jenis == 'tambah') {
    $user = [
        'userid' => $userid,
        'username' => $username,
        'password' => $password,
        'userlevel' => $userlevel
    ];
    $this->db->insert('muser', $user);
    $this->session->set_userdata('successmsg', 'BERHASIL TAMBAH USER');
} elseif ($jenis == 'edit') {
    $user = [
        'username' => $username,
        'userlevel' => $userlevel
    ];
    $this->db->where('userid', $userid);
    $this->db->update('muser', $user);
    $this->session->set_userdata('successmsg', 'BERHASIL EDIT USER');
}

redirect('Datauser');
}
public function hapus($userId)
{
    if (!$userId) {
        redirect('Datauser');
    }
    $user = $this->db->get_where('muser', ['userid' => $userId])->row();
    if (!$user) {
        redirect('Datauser');
    }
    if($user->userid !== $user->password){
        $this->session->set_userdata('errormsg','USER INI TIDAK DAPAT DIHAPUS');
        redirect('Datauser');
    }
    $this->db->delete('muser', ['userid' => $userId]);
    $this->session->set_userdata('successmsg', 'BERHASIL HAPUS USER');
    redirect('Datauser');
}
}
