<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_loged_in();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            //cek gambar
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|png|jpg';
                $config['max_size'] = '2040';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data[user]['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">data berhasil update</div>');
            redirect('user');
        }
    }

    public function changepassword()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('curentpassword', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'Password Baru', 'required|trim|min_length[3]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Konfirmasi Password', 'required|trim|min_length[3]|matches[newpassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $curentpassword = $this->input->post('curentpassword');
            $newpassword = $this->input->post('newpassword1');
            if (!password_verify($curentpassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Salah Password Lama!</div>');
                redirect('user/changepassword');
            } else {
                if ($curentpassword == $newpassword) {
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert">Password Baru tidak boleh sama dengan Password Lama!</div>');
                    redirect('user/changepassword');
                } else {
                    //password ok
                    $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert">Password Berhasil diubah!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
