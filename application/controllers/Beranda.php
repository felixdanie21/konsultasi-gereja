<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('RyuModel');
    }

	public function index()
	{
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
		$this->load->view('beranda/templates/header',$data);
		$this->load->view('beranda/index');
		$this->load->view('beranda/templates/footer');
	}

	public function berita($idberita)
	{
        $this->db->where('beritaid !=',$idberita);
        $this->db->order_by('beritatime','DESC');
        $data['beritalain'] = $this->db->get('mberita')->result_array();

        $this->db->where('beritaid',$idberita);
        $data['mberita'] = $this->db->get('mberita')->row();
        if(!$data['mberita']){
            redirect('Beranda');
        }

		$this->load->view('beranda/templates/header',$data);
		$this->load->view('beranda/berita');
		$this->load->view('beranda/templates/footer');
	}

    
    public function komentar_post()
    {
        $post = $this->input->post();
        // cek double
        $this->db->where('userkomentar',$post['userkomentar']);
        $this->db->where('pesankomentar',htmlspecialchars($post['pesankomentar']));
        $this->db->where('jeniskomentar','I');
        $cek = $this->db->get('mkomentar')->row();
        if(!$cek){
            $mkomentar = [
                'userkomentar' => $post['userkomentar'],
                'pesankomentar' => htmlspecialchars($post['pesankomentar']),
                'jeniskomentar' => 'I',
                'timekomentar' => date('Y-m-d H:i:s'),
                'lastupdate' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('mkomentar',$mkomentar);
        }
        $this->session->set_userdata('successmsg','BERHASIL TAMBAH KOMENTAR');
        redirect('Beranda');
    }

    public function komentar_reply($idkomentar)
    {
        $post = $this->input->post();
        // cek double
        $this->db->where('indukidkomentar',$idkomentar);
        $this->db->where('userkomentar',$post['userkomentar']);
        $this->db->where('pesankomentar',htmlspecialchars($post['pesankomentar']));
        $this->db->where('tagkomentar',$post['tagkomentar']);
        $this->db->where('jeniskomentar','S');
        $cek = $this->db->get('mkomentar')->row();
        if(!$cek){
            $mkomentar = [
                'indukidkomentar'=> $idkomentar,
                'userkomentar' => $post['userkomentar'],
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
        redirect('Beranda');
    }

}
