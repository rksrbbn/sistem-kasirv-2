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

    public function getJumlah()
    {
       $query = $this->db->get($this->table);
       if($query->num_rows() > 0) {
           return $query->num_rows();
       } else {
            return 0;
       } 
    }
}