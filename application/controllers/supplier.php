<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loged_in();
    }
    public function index()
    {
        $data['title'] = 'Identitas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['identitas'] = $this->db->get('tb_pemda')->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('parameter/supplier', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Identitas';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['identitas'] = $this->db->get('tb_pemda')->row_array();

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim|numeric');
        $this->form_validation->set_rules('nama_pemda', 'Nama Pemda', 'required|trim');
        $this->form_validation->set_rules('ibu_kota', 'Ibu Kota', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('parameter/index', $data);
            $this->load->view('templates/footer');
        } else {
            $tahun = $this->input->post('tahun');
            $nama_pemda = $this->input->post('nama_pemda');
            $ibu_kota = $this->input->post('ibu_kota');
            $alamat = $this->input->post('alamat');

            //cek gambar
            $upload_image = $_FILES['logo']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '2040';
                $config['upload_path'] = './assets/img/logo/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('logo')) {

                    $old_image = $data[user]['logo'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/logo/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('logo', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'tahun' => $tahun,
                'nama_pemda' => $nama_pemda,
                'ibu_kota' => $ibu_kota,
                'alamat' => $alamat
            );

            $this->db->where('id_pemda', 1);
            $this->db->update('tb_pemda', $data);

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data berhasil update</div>');
            redirect('supllier');
        }
    }
}
