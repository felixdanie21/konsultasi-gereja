<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {

    
public function __construct() {
    parent::__construct();
    $this->load->model('RyuModel');
    $this->load->model('MenuModel');
    $this->RyuModel->is_login();
    $this->MenuModel->userlevel($this->session->userdata('userlevel'),0);
}
public function index()
{
    $data['table'] =$this->db->get('mberita')->result_array();
    
    $data['idtable'] = 'mberita';
    $data['submenu'] = 'D050000';
    $data['indukmenu'] = '';
    $data['controller'] = 'Kegiatan/index';
    $data['dbmenu'] = $this->MenuModel->listmenu('D');
    $this->load->view('templates/header',$data);
    $this->load->view('templates/sidebar');
    $this->load->view('kegiatan/index',$data);
    $this->load->view('templates/footer');
}

    public function tambahberita($method = 'tambah')
    {
        if($method == 'edit'){
            $beritaid = $this->input->get('beritaid');
            $this->db->where('beritaid',$beritaid);
            $data['mberita'] = $this->db->get('mberita')->row();
        }
        $data['method'] = $method;
        $data['idtable'] = 'mberita';
        $data['submenu'] = 'D050000';
        $data['indukmenu'] = '';
        $data['controller'] = 'Kegiatan/formberita';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kegiatan/formberita', $data);
        $this->load->view('templates/footer');
    }
 public function form_post($jenis)
 {
    $beritagambar = '';
    if (!empty($_FILES['beritagambar']['name'])) {
        $config['upload_path'] = $this->session->userdata('urlfile') . 'assets/img/berita/';
        $config['allowed_types'] = 'png|jpg|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('beritagambar')) {
            $this->session->set_userdata('errormsg', 'KESALAHAN PADA UPLOAD GAMBAR, FORMAT GAMBAR TIDAK SESUAI');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $beritagambar = $this->upload->data("file_name");
    }

     // jika edit hapus dlu
     if ($jenis == 'edit') {
        $beritaid = $this->input->post('beritaid');
        $this->db->where('beritaid', $beritaid);
        $mberita = $this->db->get('mberita')->row();
        // jika ada foto baru, hapus foto lama
        if ($beritagambar) {
            $filefoto = $this->session->userdata('urlfile') . 'assets/img/berita/' . $mberita->beritagambar;
            unlink($filefoto);
        } else {
            // jika tidak ambil foto lama
            $beritagambar = $mberita->beritagambar;
        }
        $this->db->delete('mberita', ['beritaid' => $beritaid]);
    }
    
    $beritajudul = $this->input->post('beritajudul');
    $beritaisi = $this->input->post('beritaisi');
    if($jenis == 'tambah'){
        $berita = [
            'beritagambar' => $beritagambar,
            'beritauser' => $this->session->userdata('userid'),
            'beritajudul' => $beritajudul,
            'beritaisi' => $beritaisi,
            'beritatime' => date('Y-m-d H:i:s')
        ];
    } elseif($jenis == 'edit'){
        $berita = [
            'beritaid' => $beritaid,
            'beritagambar' => $beritagambar,
            'beritauser' => $this->session->userdata('userid'),
            'beritajudul' => $beritajudul,
            'beritaisi' => $beritaisi,
            'beritatime' => $mberita->beritatime
        ];
    }

    $this->db->insert('mberita', $berita);
    if($jenis == 'tambah'){
        $this->session->set_userdata('successmsg', 'BERHASIL TAMBAH BERITA');
    } elseif($jenis == 'edit'){
        $this->session->set_userdata('successmsg', 'BERHASIL EDIT BERITA');
    }
    redirect('Kegiatan');
}
public function hapus($beritaId)
{
    if (!$beritaId) {
        redirect('Kegiatan');
    }
    $berita = $this->db->get_where('mberita', ['beritaid' => $beritaId])->row();
    if (!$berita) {
        redirect('Kegiatan');
    }
    $filefoto = $this->session->userdata('urlfile') . 'assets/img/berita/' . $berita->beritagambar;
    unlink($filefoto);
    $this->db->delete('mberita', ['beritaid' => $beritaId]);
    $this->session->set_userdata('successmsg', 'BERHASIL HAPUS BERITA');
    redirect('Kegiatan');
}
}  
