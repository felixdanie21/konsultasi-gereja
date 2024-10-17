<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('MenuModel');
        $this->RyuModel->is_login();
        $this->MenuModel->userlevel($this->session->userdata('userlevel'),0);
    }

	public function importcsv()
	{
		// ambil list csv
        $folder = 'D:/AAKBPS/CSV/';
        $file_array = array();
        if (!($buka_folder = opendir($folder))) die('Erorr... Tidak bisa membuka Folder');
        while ($baca_folder = readdir($buka_folder)) {
            $file_array[] = $baca_folder;
        }
        $data['file'] = $file_array;
		// ambil list table
        $data['table'] = $this->db->list_tables();

		$data['idtable'] = '';
        $data['submenu'] = '';
        $data['indukmenu'] = '';
        $data['controller'] = 'SuperAdmin/importcsv';
        $data['dbmenu'] = $this->MenuModel->listmenu('D');
		$this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('superadmin/importcsv');
        $this->load->view('templates/footer');
	}

    public function importcsv_post()
    {
        $f = $this->input->post();
        $folder = 'D:/AAKBPS/CSV/';
        $foldername = $folder . $f['file'];
        $table = $f['table'];
        $conn = mysqli_connect('localhost', 'root', '', 'kgpm_ppmg');
        $sql = "load data infile '$foldername'
				replace into table $table
				fields terminated by '~'
				enclosed by '\"'
				lines terminated by '\n'
				ignore 0 rows";

        $hasil = mysqli_query($conn, $sql);
        if (!$hasil) {
            $this->session->set_userdata('errormsg', mysqli_errno($conn) . mysqli_error($conn));
            redirect($_SERVER['HTTP_REFERER']);
        }
        unlink($foldername);
        $this->session->set_userdata('successmsg', 'BERHASIL IMPORT CSV');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
