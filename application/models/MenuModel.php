<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("RyuModel");
    }

    function hakaksesmodul($kodemodul)
    {
        if ($this->session->userdata('userlevel')  > 1){
         $this->db->where('kodemodul',$kodemodul);
         $this->db->where('userid',$this->session->userdata('userid'));
         $this->db->join('mmenu','mmenu.kodemenu=musmenu.kodemenu');
         $this->db->group_by('kodemodul');
         $musmenu = $this->db->get('musmenu')->row();
         if (!$musmenu) {
            $this->session->set_userdata('errormsg', 'ANDA TIDAK MEMILIKI HAK AKSES PADA MODUL INI');
            redirect('Dashboard');
         } else {
            return 'true';
         }
        } else {
            return 'true';
        }
    }

    function listmenu($kodemodul)
    {
        if ($this->session->userdata('userlevel')  > 1){
            $menu = [];
            return $menu;
        } else if($this->session->userdata('userlevel') == 1){
            $this->db->where('kodemodul',$kodemodul);
            $this->db->where('userid',$this->session->userdata('userid'));
            $this->db->join('mmenu','mmenu.kodemenu=musmenu.kodemenu');
            $this->db->order_by("mmenu.kodemenu",'ASC');
            $menu = $this->db->get('musmenu')->result_array();
            return $menu;
        }else {
            $this->db->where('kodemodul', $kodemodul);
            $menu = $this->db->get('mmenu')->result_array();
            return $menu;
        }
    }

    function listsubmenu($indukmenu)
    {
        if ($this->session->userdata('userlevel') > 0){
            $this->db->where('indukmenu',$indukmenu);
            $this->db->where('userid',$this->session->userdata('userid'));
            $this->db->join('mmenu','mmenu.kodemenu=musmenu.kodemenu');
            $this->db->order_by("mmenu.kodemenu",'ASC');
            $submenu = $this->db->get('musmenu')->result_array();
            return $submenu;
        } else {
            $this->db->where('indukmenu', $indukmenu);
            $submenu = $this->db->get('mmenu')->result_array();
            return $submenu;
        }
    }

    function cekmenu($kodemenu,$kodemenu2='',$kodemenu3='')
    {
        if ($this->session->userdata('userlevel')  > 0){
            $this->db->where('kodemenu',$kodemenu);
            if($kodemenu2){
                $this->db->or_where('kodemenu',$kodemenu2);
            }
            if($kodemenu3){
                $this->db->or_where('kodemenu',$kodemenu3);
            }
            $this->db->where('userid',$this->session->userdata('userid'));
            $musmenu = $this->db->get('musmenu')->row();
            if($musmenu){
                return 'true';
            } else {
                $this->session->set_userdata('errormsg', 'ANDA TIDAK MEMILIKI HAK AKSES PADA MENU INI');
			    redirect('Dashboard');
            }
        } else {
            return 'true';
        }
    }

    function userlevel($userlevel,$userlevel_boleh)
    {
        if($userlevel > $userlevel_boleh){
            $this->session->set_userdata('errormsg','ANDA TIDAK MEMILIKI HAK AKSES PADA MENU INI');
            redirect('Dashboard');
        }
    }
}
