<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    private $table = 'penjualan';

    public function getAll()
    {
        $sql = "SELECT * FROM penjualan";
        return $this->db->query($sql)->result();
    }
}