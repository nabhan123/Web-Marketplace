<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        // membuat session
        parent::__construct();
        //cek user 
        is_logged_in();
    }
    public function index()
    {
        // membuat nama user yang input data
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        // membuat nama user yang input data
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }
    public function roleAccess($role_id)
    {

        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])
            ->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        // siapkan datanya buat dimasukkan di query
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);


        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        // dikasih pesan
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed!
         </div>');
    }
    public function data_barang()
    {
        $data['title'] = 'Data Barang';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->model_barang->tampil_data()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/data_barang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $nama_brg = $this->input->post('nama_brg');
        $keterangan = $this->input->post('keterangan');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $gambar = $_FILES['gambar']['name'];

        if ($gambar = '') { } else {
            // menentukan path dir untuk save gbr
            $config['upload_path'] = './uploads';
            // mengubah tipe file yang bisa diuploud
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
               Failed to upload image!
                 </div>');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }
        $data = [
            'nama_brg' => $nama_brg,
            'keterangan' => $keterangan,
            'kategori' => $kategori,
            'harga' => $harga,
            'stok' => $stok,
            'gambar' => $gambar
        ];

        $this->model_barang->tambah_barang($data, 'tb_barang');
        redirect('Admin/data_barang');
    }

    public function edit($id)
    {
        $where = [
            'id' => $id
        ];
        $data['title'] = 'Edit Produk';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['barang'] = $this->model_barang->edit_barang($where, 'tb_barang')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('admin/edit_barang', $data);
        $this->load->view('templates/footer');
    }
    public function update()
    {
        $id = $this->input->post('id');
        $nama_brg = $this->input->post('nama_brg');
        $keterangan = $this->input->post('keterangan');
        $kategori = $this->input->post('kategori');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');

        $data = [
            'nama_brg' => $nama_brg,
            'keterangan' => $keterangan,
            'kategori' => $kategori,
            'harga' => $harga,
            'stok' => $stok,
        ];

        $where = [
            'id' => $id
        ];

        $this->model_barang->update_data($where, $data, 'tb_barang');
        redirect('Admin/data_barang');
    }
    public function hapus($id)
    {

        $where = [
            'id' => $id
        ];
        $this->model_barang->hapus_data($where, 'tb_barang');
        redirect('Admin/data_barang');
    }

    public function hapus_keranjang()
    { }
    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates-admin/topbar', $data);
        $this->load->view('user/pembayaran', $data);
        $this->load->view('templates/footer');
    }
}
