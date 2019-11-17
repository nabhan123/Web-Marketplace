<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Elektronik';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->model_barang->tampil_data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function makanan()
    {
        $data['title'] = 'Makanan';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['makanan'] = $this->model_makanan->tampil_data()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('kategori/makanan', $data);
        $this->load->view('templates/footer');
    }

    public function hot()
    {
        $data['title'] = 'Hot Drink';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // $data['makanan'] = $this->model_makanan->tampil_data()->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('kategori/hot', $data);
        $this->load->view('templates/footer');
    }
}
