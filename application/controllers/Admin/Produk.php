<?php

    class Produk extends CI_controller{
        public function index()
        {
            $data = array(
                'title'     => 'Kelola Produk',
                'produk'    => $this->M_produk->get_all_produk()
            );
            $this->load->view('Template_Admin/header',$data);
            $this->load->view('Template_Admin/sidebar');
            $this->load->view('Admin/kelola_produk',$data);
            $this->load->view('Template_Admin/footer');
        }

        public function tambah_produk()
        {
            $data = array(
                'title'     => 'Tambah Produk'
            );
            $this->load->view('Template_Admin/header',$data);
            $this->load->view('Template_Admin/sidebar');
            $this->load->view('Admin/tambah_produk');
            $this->load->view('Template_Admin/footer');
        }

        public function tambah_produk_aksi()
        {
            $this->form_validation->set_rules('nomor', 'Nomor', 'required|numeric');
            $this->form_validation->set_rules('tahun', 'tahun', 'required|numeric');
            $this->form_validation->set_rules('tentang', 'tentang', 'required');
            $this->form_validation->set_rules('konten', 'konten', 'required');

            if($this->form_validation->run() == FALSE) {
                $this->tambah_produk();
            } else {
                $nomor          = $this->input->post('nomor');
                $tahun          = $this->input->post('tahun');
                $tentang          = $this->input->post('tentang');
                $konten          = $this->input->post('konten');
                $filepdf        = $_FILES['filepdf']['name'];
                if($filepdf=''){}else{
                    $config['upload_path']      ='./assets/upload';
                    $config['allowed_types']    ='pdf';
                    $config['max_size']         = 10240;

                    $this->load->library('upload', $config);
                    if(!$this->upload->do_upload('filepdf')){
                        echo "File PDF gagal di Upload";
                    } else {
                        $filepdf = $this->upload->data('file_name');
                    }
                }
                $data = array(
                    'nomor'	    	    => $nomor,
                    'tahun'		    	=> $tahun,
                    'tentang'			=> $tentang,
                    'filepdf'	    	=> $filepdf,
                    'konten'			=> $konten
                );

                $this->M_produk->insert_data($data,'tbl_produk');
                $this->session->set_flashdata('pesan', '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Data Produk </strong>Sukses DItambahkan.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    ');
                redirect('Admin/Produk');
            }
        }

        public function update($id)
        {
            $where = array('
                id' => $id,
                'title'     => 'Edit Produk'
            );
            $data['tbl_produk'] = $this->db->query("SELECT * FROM tbl_produk WHERE id='$id'")->result();
            $this->load->view('Template_Admin/header',$where);
            $this->load->view('Template_Admin/sidebar');
            $this->load->view('Admin/edit_produk',$data);
            $this->load->view('Template_Admin/footer');
        }

        public function update_produk_aksi()
        {
            $this->form_validation->set_rules('nomor', 'Nomor', 'required|numeric');
            $this->form_validation->set_rules('tahun', 'tahun', 'required|numeric');
            $this->form_validation->set_rules('tentang', 'tentang', 'required');
            $this->form_validation->set_rules('konten', 'konten', 'required');

            if($this->form_validation->run() == FALSE) {
                $this->update();
            } else {
                $id             = $this->input->post('id');
                $nomor          = $this->input->post('nomor');
                $tahun          = $this->input->post('tahun');
                $tentang          = $this->input->post('tentang');
                $konten          = $this->input->post('konten');
                $filepdf        = $_FILES['filepdf']['name'];
                if($filepdf){
                    $config['upload_path']      ='./assets/upload';
                    $config['allowed_types']    ='pdf';

                    $this->load->library('upload', $config);
                    
                    if($this->upload->do_upload('filepdf')){
                        $filepdf = $this->upload->data('file_name');
                        $this->db->set('filepdf', $filepdf);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }
                $data = array(
                    'nomor'	    	    => $nomor,
                    'tahun'		    	=> $tahun,
                    'tentang'			=> $tentang,
                    'konten'			=> $konten
                );

                $where = array(
                    'id' => $id
                );

                $this->M_produk->update_data('tbl_produk',$data,$where);
                $this->session->set_flashdata('pesan', '
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <strong>Data Produk </strong>Sukses Di Update.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    ');
                redirect('Admin/Produk');
            }    
        }

        public function hapus($id)
        {
            $where = array('id' => $id);
            $this->M_produk->delete_data($where,'tbl_produk');
            $this->session->set_flashdata('pesan', '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data Produk </strong>Sukses Di Hapus.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				');
		    redirect('Admin/Produk');
        }

      
    }

