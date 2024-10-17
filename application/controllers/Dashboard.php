<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RyuModel');
        $this->load->model('MenuModel');
        $this->load->model('PendaftaranModel');
        $this->RyuModel->is_login();
    }

    public function index()
    {
        // ambil nilai verifikasi untuk peserta
        $verifikasi = $this->PendaftaranModel->status_verifikasi($this->session->userdata('userid'));

        $this->db->order_by('beritatime','DESC');
        $data['mberita'] = $this->db->get('mberita')->result_array();
        $this->db->order_by('galeriid','DESC');
        $data['mgaleri'] = $this->db->get('mgaleri')->result_array();
        $this->db->join('msidang','msidang.sidangkode=mdaftar.sidangkode');
        $this->db->join('mwilayah','mwilayah.wilayahkode=msidang.wilayahkode');
        $this->db->order_by('daftarnama','ASC');
        $data['mdaftar'] = $this->db->get('mdaftar')->result_array();
        $this->db->order_by('lastupdate','DESC');
        $this->db->where('jeniskomentar','I');
        $data['mkomentar'] = $this->db->get('mkomentar')->result_array();
        $data['idtable'] = '';
        $data['submenu'] = 'dashboard';
        $data['indukmenu'] = '';
        $data['controller'] = 'Dashboard/index';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        if($this->session->userdata('userlevel') == '0' || $verifikasi == 'V'){
            $this->load->view('dashboard/index');
        } else {
            $this->load->view('dashboard/waitroom');
        }
        $this->load->view('templates/footer');
    }

    public function berita($idberita)
    {
        $verifikasi = $this->PendaftaranModel->status_verifikasi($this->session->userdata('userid'));

        $this->db->where('beritaid !=',$idberita);
        $this->db->order_by('beritatime','DESC');
        $data['beritalain'] = $this->db->get('mberita')->result_array();

        $this->db->where('beritaid',$idberita);
        $data['mberita'] = $this->db->get('mberita')->row();
        if(!$data['mberita']){
            redirect('Dashboard');
        }

        $data['idtable'] = '';
        $data['submenu'] = 'dashboard';
        $data['indukmenu'] = '';
        $data['controller'] = 'Dashboard/berita';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        if($this->session->userdata('userlevel') == '0' || $verifikasi == 'V'){
            $this->load->view('dashboard/berita');
        } else {
            $this->load->view('dashboard/waitroom');
        }
        $this->load->view('templates/footer');
    }

    public function komentar_post()
    {
        $post = $this->input->post();
        // cek double
        $this->db->where('userkomentar',$this->session->userdata('username'));
        $this->db->where('pesankomentar',htmlspecialchars($post['pesankomentar']));
        $this->db->where('jeniskomentar','I');
        $cek = $this->db->get('mkomentar')->row();
        if(!$cek){
            $mkomentar = [
                'userkomentar' => $this->session->userdata('username'),
                'pesankomentar' => htmlspecialchars($post['pesankomentar']),
                'jeniskomentar' => 'I',
                'timekomentar' => date('Y-m-d H:i:s'),
                'lastupdate' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('mkomentar',$mkomentar);
        }
        $this->session->set_userdata('successmsg','BERHASIL TAMBAH KOMENTAR');
        redirect('Dashboard');
    }
  
    public function komentar_reply($idkomentar)
    {
        $post = $this->input->post();
        // cek double
        $this->db->where('indukidkomentar',$idkomentar);
        $this->db->where('userkomentar',$this->session->userdata('username'));
        $this->db->where('pesankomentar',htmlspecialchars($post['pesankomentar']));
        $this->db->where('tagkomentar',$post['tagkomentar']);
        $this->db->where('jeniskomentar','S');
        $cek = $this->db->get('mkomentar')->row();
        if(!$cek){
            $mkomentar = [
                'indukidkomentar'=> $idkomentar,
                'userkomentar' => $this->session->userdata('username'),
                'pesankomentar' => htmlspecialchars($post['pesankomentar']),
                'tagkomentar' => $post['tagkomentar'],
                'jeniskomentar' => 'S',
                'timekomentar' => date('Y-m-d H:i:s'),
                'lastupdate' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('mkomentar',$mkomentar);
            // update induk komentar
            $this->db->update('mkomentar',['lastupdate'=>date('Y-m-d H:i:s')],['idkomentar'=>$idkomentar]);
        }
        $this->session->set_userdata('successmsg','BERHASIL REPLY KOMENTAR');
        $this->session->set_userdata('openkomentar',$idkomentar);
        redirect('Dashboard');
    }
}
