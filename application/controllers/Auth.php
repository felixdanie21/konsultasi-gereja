<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('RyuModel');
        $this->load->model('PendaftaranModel');
    }

    public function cek_session()
    {
        $usertoken = get_cookie('kbps_usertoken');
        if($usertoken){
            $this->db->where('usertoken',$usertoken);
            $cekuser = $this->db->get('muser')->row();
            // userdata
            $userdata = [
                'userid' => $cekuser->userid,
                'username' => $cekuser->username,
                'userlevel' => $cekuser->userlevel,
                'userimage' => $cekuser->userimage,
                'is_login' => '1',
            ];
            $this->session->set_userdata($userdata);
            $this->session->unset_userdata('errormsg');
            redirect('Dashboard');
        }
    }

    public function registrasi()
    {
        $this->db->order_by('sidanglengkap','ASC');
        $data['msidang'] = $this->db->get('msidang')->result_array();
        $this->load->view('auth/templates/header',$data);
        $this->load->view('auth/registrasi');
        $this->load->view('auth/templates/footer');
    }

    public function registrasi_post()
    {
        $post = $this->input->post();
        // kode peserta
        $kodepeserta  = $this->PendaftaranModel->create_kodepeserta($post['jenispeserta'],$post['asalsidang']);
        // insert mdaftar
        $insert_mdaftar = [
            'daftarhp' => $post['nomorhp'],
            'daftarfungsi' => $post['fungsihp'],
            'daftarmajelis' => $post['jabatanmajelis'],
            'daftarnama' => strtoupper($post['namalengkap']),
            'daftartglhr' => $this->RyuModel->datemask_format($post['tgllahir']),
            'daftarjk' => $post['jeniskelamin'],
            'sidangkode' => $post['asalsidang'],
            'sidangkode' => $post['asalsidang'],
            'daftarjenis' => $post['jenispeserta'],
            'daftarkp' => $kodepeserta,
            'daftarstat' => 'D',
            'daftaremail' => $post['email'],
            'daftarverif' => 'B',
            'daftarnamapanggilan' => strtoupper($post['namapanggilan']),
            'daftarkejakarta' => $this->RyuModel->datemask_format($post['tgldatangke'],'time'),
            'daftardarijakarta' => $this->RyuModel->datemask_format($post['tgldatangdari'],'time'),
            'daftarukuranbaju' => strtoupper($post['ukuranbaju']),
            'daftardgnpasangan' => $post['datangpasangan'],
            'daftarnamapasangan' => strtoupper($post['namapasangan']),
        ];
        $this->PendaftaranModel->insert($insert_mdaftar);
        redirect('Auth/registrasi');
    }

    public function ajax_registrasi_cek_nomorhp()
    {
        $nomorhp = $this->input->post('nomorhp');
        echo $this->PendaftaranModel->cek_nomorhp($nomorhp);
    }

    public function autologin($userid,$password)
    {
        $this->session->set_userdata('autologinuserid',$userid);
        $this->session->set_userdata('autologinpassword',$password);
        redirect('Auth/login');
    }
    
    public function login()
    {
        $this->cek_session();
        foreach ($_SESSION as $key => $val) {
            if ($key !== "errormsg" && $key !== "successmsg" && $key !== "autologinuserid" && $key !== "autologinpassword" && $key !== "__ci_vars") {
                unset($_SESSION[$key]);
            }
        }
        $this->load->view('auth/templates/header');
        $this->load->view('auth/login');
        $this->load->view('auth/templates/footer');
    }

    public function login_post()
    {
        $post = $this->input->post();
        $userid = $post['userid'];
        $password = $post['password'];
        $is_user = $this->db->get_where('muser',['userid' => $userid])->row();
        if ($is_user) {
            if (strtolower($is_user->password) == strtolower($password)) {
                if(strtolower($password) == strtolower($userid)){
                    $this->session->set_userdata('gantipassword',$userid);
                    redirect('Auth/gantipassword/'.$userid);
                }
                // remember me
                if($post['remember'])
                {
                    $token = $is_user->userid.bin2hex(random_bytes(50));
                    $this->db->update("muser",['usertoken' => $token],['userid' => $is_user->userid]);
                    set_cookie('kbps_usertoken',$token,3600 * 24 * 30);
                }
                // urlfile
                $mconfig = $this->db->get('mconfig')->row();
                $data=[
                    'userid'=>$is_user->userid,
                    'username'=>$is_user->username,
                    'userlevel'=>$is_user->userlevel,
                    'userimage'=>$is_user->userimage,
                    'urlfile' => $mconfig->urlfile,
                    'is_login' => '1'
                ];
                $this->session->set_userdata($data);
                $this->session->set_userdata('successmsg','BERHASIL LOGIN');
                redirect('Dashboard');
            }else {
                $this->session->set_userdata('errormsg','PASSWORD SALAH');
                redirect('Auth/login');
            }
        }else{
            $this->session->set_userdata('errormsg','NOMOR HP TIDAK DITEMUKAN');
            redirect('Auth/login');
        }
    }

    public function gantipassword($userid)
    {
        if(strtolower($this->session->userdata('gantipassword')) !== strtolower($userid)){
            redirect('Auth/login');
        }
        $this->db->where('userid',$userid);
        $data['muser'] = $this->db->get('muser')->row();
        $this->load->view('auth/templates/header',$data);
        $this->load->view('auth/gantipassword');
        $this->load->view('auth/templates/footer');
    }

    public function gantipassword_post()
    {
        $post = $this->input->post();

        $this->db->where('userid',$post['userid']);
        $muser = $this->db->get('muser')->row();

        if(strtolower($muser->password) !== strtolower($post['password'])){
            if(strtolower($post['password']) == strtolower($post['password2'])){
                $this->db->update('muser',['password' => $post['password']],['userid'=>$post['userid']]);
                $this->session->set_userdata('successmsg','BERHASIL GANTI PASSWORD');
                $this->session->set_userdata('autologinuserid',$post['userid']);
                redirect('Auth/login');
            } else {
                $this->session->set_userdata('errormsg','MASUKAN KEMBALI PASSWORD TIDAK SAMA');
                redirect('Auth/gantipassword/'.$post['userid']);    
            }
        } else {
            $this->session->set_userdata('errormsg','PASSWORD BARU TIDAK BOLEH SAMA DENGAN PASSWORD LAMA');
            redirect('Auth/gantipassword/'.$post['userid']);
        }
    }

    public function logout()
    {
        delete_cookie('kbps_usertoken');
        $this->session->set_userdata('successmsg', 'BERHASIL LOGOUT');
        foreach ($_SESSION as $key => $val) {
            if ($key !== "errormsg" && $key !== "successmsg" && $key !== "autologinuserid" && $key !== "autologinpassword" && $key !== "__ci_vars") {
                unset($_SESSION[$key]);
            }
        }
        redirect('Beranda');
    }
}
