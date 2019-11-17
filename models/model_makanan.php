<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_makanan extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tb_makanan');
    }
}
