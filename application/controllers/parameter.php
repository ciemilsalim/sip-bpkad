<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parameter extends CI_Controller
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
        $this->load->view('parameter/index', $data);
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
            redirect('parameter');
        }
    }


    public function skpd()
    {
        $data['title'] = 'Identitas SKPD';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $data['skpd'] = $this->db->get('tb_skpd')->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('parameter/skpd', $data);
        $this->load->view('templates/footer');
    }

    public function editskpd()
    {
        $data['title'] = 'Edit Identitas SKPD';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['identitas'] = $this->db->get('tb_skpd')->row_array();

        $this->form_validation->set_rules('tahun', 'Tahun', 'required|trim|numeric');
        $this->form_validation->set_rules('nama_skpd', 'Nama SKPD', 'required|trim');
        $this->form_validation->set_rules('alamat_skpd', 'Alamat SKPD', 'required|trim');
        $this->form_validation->set_rules('id_pimpinan', 'ID Pimpinan', 'required|trim');
        $this->form_validation->set_rules('NIP_pimpinan', 'NIP Pimpinan', 'required|trim');
        $this->form_validation->set_rules('nama_pimpinan', 'Nama Pimpinan', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('parameter/skpd', $data);
            $this->load->view('templates/footer');
        } else {
            $tahun = $this->input->post('tahun');
            $kd_urusan = $this->input->post('kd_urusan');
            $kd_bidang = $this->input->post('kd_bidang');
            $kd_unit = $this->input->post('kd_unit');
            $kd_sub = $this->input->post('kd_sub');
            $nama_skpd = $this->input->post('nama_skpd');
            $alamat_skpd = $this->input->post('alamat_skpd');
            $id_pimpinan = $this->input->post('id_pimpinan');
            $nip_pimpinan = $this->input->post('nip_pimpinan');
            $nama_pimpinan = $this->input->post('nama_pimpinan');
            $jabatan = $this->input->post('jabatan');
            $alamat_pimpinan = $this->input->post('alamat_pimpinan');

            //cek gambar
            $upload_image = $_FILES['foto']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '2040';
                $config['upload_path'] = './assets/img/logo/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {

                    $old_image = $data[user]['foto'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/foto/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('foto', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'tahun' => $tahun,
                'kd_urusan' => $kd_urusan,
                'kd_bidang' => $kd_bidang,
                'kd_unit' => $kd_unit,
                'kd_sub' => $kd_sub,
                'nama_skpd' => $nama_skpd,
                'alamat_skpd' => $alamat_skpd,
                'id_pimpinan' => $id_pimpinan,
                'nama_pimpinan' => $nama_pimpinan,
                'jabatan' => $jabatan,
                'alamat_pimpinan' => $alamat_pimpinan
            );

            $this->db->where('kd_skpd', 1);
            $this->db->update('tb_pemda', $data);

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data berhasil update</div>');
            redirect('parameter/skpd');
        }
    }

    public function Bidang()
    {
        $data['title'] = 'Bidang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bidang'] = $this->db->get('tb_bidang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('parameter/bidang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_bidang()
    {

        $data['title'] = 'Bidang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bidang'] = $this->db->get('tb_bidang')->result_array();

        $this->form_validation->set_rules('nama_bidang', 'Nama Bidang', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('parameter/bidang', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_bidang = $this->input->post('nama_bidang');
            $kd_urusan = $this->session->userdata('kd_urusan');
            $kd_bidang = $this->session->userdata('kd_bidang');
            $kd_unit = $this->session->userdata('kd_unit');
            $kd_sub = $this->session->userdata('kd_sub');
            $data = array(
                'nama_bidang' => $nama_bidang,
                'kd_urusan' => $kd_urusan,
                'kd_bidang' => $kd_bidang,
                'kd_unit' => $kd_unit,
                'kd_sub' => $kd_sub
            );
            $insert = $this->db->insert('tb_bidang', $data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data Bidang berhasil ditambahkan </div>');
                redirect('parameter/bidang');
            } else {
                echo $this->upload->display_errors();
                redirect('parameter/bidang');
            }
        }
    }


    public function edit_bidang()
    {

        $data['title'] = 'Bidang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['bidang'] = $this->db->get('tb_bidang')->result_array();

        $this->form_validation->set_rules('nama_bidang', 'Nama Bidang', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('parameter/bidang', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id_bidang');
            $nama_bidang = $this->input->post('nama_bidang');

            $id_bidang['id_bidang'] = $id;
            $data = array(
                'nama_bidang' => $nama_bidang
            );
            $update = $this->db->update('tb_bidang', $data, $id_bidang);

            if ($update) {
                $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data Bidang berhasil diupdate </div>');
                redirect('parameter/bidang');
            } else {
                echo $this->upload->display_errors();
                redirect('parameter/bidang');
            }
        }
    }


    public function delete_bidang()
    {

        $id['id_bidang'] = $this->uri->segment(3);

        $delete = $this->db->delete('tb_bidang', $id);

        if ($delete) {
            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data Bidang berhasil di hapus </div>');
            redirect('parameter/bidang');
        } else {
            echo $this->upload->display_errors();
            redirect('parameter/bidang');
        }
    }
}
