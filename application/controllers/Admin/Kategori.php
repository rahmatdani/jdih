<?php
    class Kategori extends CI_controller{


        // index fungsi
        public function index()
        {
            $data['tbl_kategori'] = $this->M_kategori->get_data('tbl_kategori')->result();
            $data['title'] = "Kelola Kategori";

            $this->load->view('Template_Admin/header',$data);
            $this->load->view('Template_Admin/sidebar');
            $this->load->view('Admin/kelola_kategori',$data);
            $this->load->view('Template_Admin/footer');
        }

        // tambah kategori
        public function Tambah_kategori_aksi()
        {
            $this->form_validation->set_rules('nama_kategori','Kategori','required');
            if($this->form_validation->run() == FALSE ){
                $this->index();
            } else {
                $nama_kategori = $this->input->post('nama_kategori');

                $data['nama_kategori'] = $nama_kategori;

                $this->M_kategori->insert_data($data,'tbl_kategori');
                $this->session->set_flashdata('pesan', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Kategori </strong>Sukses DItambahkan.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				');
			    redirect('Admin/Kategori');
            }
        }

        // hapus kategori
        public function delete_kategori($id_kategori)
        {
            // $where = array('id_kategori' => $id_kategori);
            $data['id_kategori'] = $id_kategori;
            $this->M_kategori->delete_data($data,'tbl_kategori');
            $this->session->set_flashdata('pesan', '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Data Produk </strong>Sukses Di Hapus.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				');
		    redirect('Admin/Kategori');
        }
    }