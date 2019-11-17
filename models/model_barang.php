<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_barang extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tb_barang');
    }
    public function tambah_barang($data, $table)
    {
        $this->db->insert($table, $data);
    }
    public function edit_barang($where, $table)
    {
        // menjalankan data yang akan diedit berdasarkan id brg 
        return $this->db->get_where($table, $where);
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_data($where, $table)
    {
        # code...
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function find($id)
    {
        # code...
        $result = $this->db->where('id', $id)->limit(1)->get('tb_barang');

        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return array();
        }
    }
}
