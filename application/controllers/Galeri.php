<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('RyuModel');
    $this->load->model('MenuModel');
    $this->RyuModel->is_login();
    $this->MenuModel->userlevel($this->session->userdata('userlevel'),1);
    $this->MenuModel->cekmenu('D040000');
}
public function index()
{
    $data['table'] =$this->db->get('mgaleri')->result_array();
    
    $data['idtable'] = 'mgaleri';
    $data['submenu'] = 'D040000';
    $data['indukmenu'] = '';
    $data['controller'] = 'Galerifoto/index';
    $data['dbmenu'] = $this->MenuModel->listmenu('D');
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('galerifoto/index',$data);
    $this->load->view('templates/footer');
}

public function tambahfoto($method = 'tambah')
{
    if($method == 'edit'){
        $galeriid = $this->input->get('galeriid');
        $this->db->where('galeriid',$galeriid);
        $data['mgaleri'] = $this->db->get('mgaleri')->row();
    }
    $data['method'] = $method;
    $data['idtable'] = 'mgaleri';
    $data['submenu'] = 'D040000';
    $data['indukmenu'] = '';
    $data['controller'] = 'Galerifoto/tambahfoto';
    $data['dbmenu'] = $this->MenuModel->listmenu('D');
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('galerifoto/tambahfoto',$data);
    $this->load->view('templates/footer');
}

public function tambah_post($jenis)
{
    $galerifile = '';
    if (!empty($_FILES['galerifile']['name'])) {
        $config['upload_path'] = $this->session->userdata('urlfile') . 'assets/img/galeri/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('galerifile')) {
            $this->session->set_userdata('errormsg', 'KESALAHAN PADA UPLOAD GAMBAR, FORMAT GAMBAR TIDAK SESUAI');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $galerifile = $this->upload->data("file_name");
    }

     // jika edit hapus dlu
     if ($jenis == 'edit') {
        $galeriid = $this->input->post('galeriid');
        $this->db->where('galeriid', $galeriid);
        $mgaleri = $this->db->get('mgaleri')->row();
        // jika ada foto baru, hapus foto lama
        if ($galerifile) {
            $filefoto = $this->session->userdata('urlfile') . 'assets/img/galeri/' . $mgaleri->galerifile;
            unlink($filefoto);
        } else {
            // jika tidak ambil foto lama
            $galerifile = $mgaleri->galerifile;
        }
        $this->db->delete('mgaleri', ['galeriid' => $galeriid]);
    }
    
    $galeriket = $this->input->post('galeriket');
    if($jenis == 'tambah'){
        $galeri = [
            'galerifile' => $galerifile,
            'galeriuser' => $this->session->userdata('userid'),
            'galeriket' => $galeriket
        ];
    } elseif($jenis == 'edit'){
        $galeri = [
            'galeriid' => $galeriid,
            'galerifile' => $galerifile,
            'galeriuser' => $this->session->userdata('userid'),
            'galeriket' => $galeriket
        ];
    }

    $this->db->insert('mgaleri', $galeri);
    if($jenis == 'tambah'){
        $this->session->set_userdata('successmsg', 'BERHASIL TAMBAH FOTO');
    } elseif($jenis == 'edit'){
        $this->session->set_userdata('successmsg', 'BERHASIL EDIT FOTO');
    }
    redirect('Galeri');
}
public function hapus($galeriId)
{
    if (!$galeriId) {
        redirect('Galeri');
    }
    $galeri = $this->db->get_where('mgaleri', ['galeriid' => $galeriId])->row();
    if (!$galeri) {
        redirect('Galeri');
    }
    $filefoto = $this->session->userdata('urlfile') . 'assets/img/galeri/' . $galeri->galerifile;
    unlink($filefoto);
    $this->db->delete('mgaleri', ['galeriid' => $galeriId]);
    $this->session->set_userdata('successmsg', 'BERHASIL HAPUS FOTO');
    redirect('Galeri');
}
}