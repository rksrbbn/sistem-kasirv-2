<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $table = 'produk';

    public function getAll()
    {
        $sql = "SELECT * FROM produk WHERE kd_produk != 'CF000'";
        return $this->db->query($sql)->result();
    }

    public function de_stock($kd,$qty)
    {
        $sql = "UPDATE produk SET stok = stok - $qty WHERE kd_produk = '$kd'";
        $this->db->query($sql);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kd_produk" => $id])->row();
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

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('kd_produk' => $id));
    }

    public function delete($id)
    {
        $sql = "UPDATE transaksi_detail SET kd_produk = 'CF000' WHERE produk.kd_produk = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('kd_produk' => $id));
    }
}
