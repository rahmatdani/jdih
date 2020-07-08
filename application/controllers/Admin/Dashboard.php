<?php

    class Dashboard extends CI_controller{
        public function index()
        {
            $data = array(
                'title'     => 'Dashboard',
                'produk'    => $this->M_produk->get_all_produk()
            );
            $this->load->view('Template_Admin/header',$data);
            $this->load->view('Template_Admin/sidebar');
            $this->load->view('Admin/dashboard');
            $this->load->view('Template_Admin/footer');
        }
    }


?>