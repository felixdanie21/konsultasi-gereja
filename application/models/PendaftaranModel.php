<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PendaftaranModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("RyuModel");
    }

    // public function debug($jenispeserta,$sidangkode)
    // {
    //     echo $this->PendaftaranModel->create_kodepeserta($jenispeserta,$sidangkode);
    // }

    function create_kodepeserta($jenispeserta,$sidangkode)
    {
        // Set variable2 kode peserta
        $kodepeserta = '';
        $now_nomorurut = '01';
        // Peserta Sidang
        if($jenispeserta == 'S')
        {
            // set string depan kode peserta
            $front_kodepeserta = $jenispeserta.$sidangkode;
            // cek peserta dengan sidang yang sama
            $this->db->where('daftarjenis',$jenispeserta);
            $this->db->where('sidangkode',$sidangkode);
            $this->db->order_by('daftarkp','DESC');
            $is_any = $this->db->get('mdaftar')->row();
        }
        // Peserta Wilayah
        else if($jenispeserta == 'W')
        {
            // ambil kode wilayah
            $this->db->where('sidangkode',$sidangkode);
            $msidang = $this->db->get('msidang')->row();
            $wilayahkode = $msidang->wilayahkode;
            // set string depan kode peserta
            $front_kodepeserta = $jenispeserta.$wilayahkode;
            // cek peserta dengan sidang yang sama
            $this->db->join('msidang','msidang.sidangkode=mdaftar.sidangkode');
            $this->db->where('daftarjenis',$jenispeserta);
            $this->db->where('wilayahkode',$wilayahkode);
            $this->db->order_by('daftarkp','DESC');
            $is_any = $this->db->get('mdaftar')->row();
        }
        // Peserta PPMG dan Lainnya
        else
        {
            // set string depan kode peserta
            $front_kodepeserta = $jenispeserta;
            // cek peserta dengan sidang yang sama
            $this->db->where('daftarjenis',$jenispeserta);
            $this->db->order_by('daftarkp','DESC');
            $is_any = $this->db->get('mdaftar')->row();
        }
        // Pembuatan Kode Peserta
        if($is_any){
            $last_nomorurut = str_replace($front_kodepeserta,'',$is_any->daftarkp);
            $now_nomorurut = $last_nomorurut + 1;
            $now_nomorurut = $this->RyuModel->nomorurut('2',$now_nomorurut);
        }
        $kodepeserta = $front_kodepeserta.$now_nomorurut;
        return $kodepeserta;
    }

    function insert($data)
    {
        $is_true = $this->cek_nomorhp($data['daftarhp']);
        if($is_true){
            $this->session->set_userdata('datadaftargagal',$data);
            $this->session->set_userdata('errormsg','NOMOR HP SUDAH DIGUNAKAN');
        } else {
            $userlevel = '3';
            if($data['daftarjenis'] == 'A'){
                $userlevel = '1';
            }
            $this->db->trans_start();
            // create daftar
            $this->db->insert('mdaftar',$data);
            // create user
            $insert_muser = [
                'userid' => $data['daftarhp'],
                'username' => $data['daftarnama'],
                'password' => $data['daftarhp'],
                'userlevel' => $userlevel,
            ];
            $this->db->insert('muser',$insert_muser);
            $this->db->trans_complete();
            $this->session->set_userdata('infologinuserid',$data['daftarhp']);
            $this->session->set_userdata('infologinpassword',$data['daftarhp']);
        }
    }

    function cek_nomorhp($nomorhp)
    {
        $this->db->where('daftarhp',$nomorhp);
        $is_any = $this->db->get('mdaftar')->row();
        if($is_any){
            return '1';
        } else {
            return '0';
        }
    }
    
    function jenispeserta($kode)
    {
        switch($kode){
            case 'S':
                return 'SIDANG';
                break;
            case 'W':
                return 'WILAYAH';
                break;
            case 'P':
                return 'PPMG';
                break;
            case 'A':
                return 'PANITIA';
                break;
            case 'L':
                return 'PENINJAU';
                break;
            default:
                return '-';
                break;
        }
    }

    function statuspendaftaran($kode)
    {
        switch($kode){
            case 'D':
                return 'DAFTAR';
                break;
            case 'C':
                return 'CALON';
                break;
            case 'P':
                return 'PESERTA';
                break;
            case 'B':
                return 'BATAL';
                break;
            default:
                return '-';
                break;
        }
    }

    function fungsihp($kode,$jenis = 'text')
    {
        switch($kode){
            case 'T':
                if($jenis == 'text'){
                    return 'TELPON';
                } elseif($jenis == 'icon') {
                    return '<i class="fas fa-phone"></i>';
                }
                break;
            case 'W':
                if($jenis == 'text'){
                    return 'WHATSAPP';
                } elseif($jenis == 'icon') {
                    return '<i class="fab fa-whatsapp"></i>';
                }
                break;
            case 'G':
                if($jenis == 'text'){
                    return 'TELEGRAM';
                } elseif($jenis == 'icon') {
                    return '<i class="fab fa-telegram"></i>';
                }
                break;
            default:
                return '-';
                break;
        }
    }

    function jenisverifikasi($kode,$jenis = 'text')
    {
        switch($kode){
            case 'V':
                return 'TERVERIF';
                break;
            case 'B':
                return 'BELUM';
                break;
            default:
                return '-';
                break;
        }
    }

    function status_verifikasi($nomorhp)
    {
        $this->db->where('daftarhp',$nomorhp);
        $mdaftar = $this->db->get('mdaftar')->row();
        if($mdaftar){
            return $mdaftar->daftarverif;
        } else {
            return 'V';
        }
    }
}
