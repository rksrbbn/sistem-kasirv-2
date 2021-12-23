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

    public function getHarga($kd)
    {
        $sql = "SELECT harga FROM produk WHERE kd_produk = '$kd'";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kd_produk" => $id])->row();
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
        // $sql = "DELETE mapel , dosen FROM mapel , dosen WHERE mapel.kd_mapel = dosen.kd_mapel AND mapel.kd_mapel = ?";
        // return $this->db->query($sql, array($id));
        $sql = "UPDATE transaksi_detail SET kd_produk = 'CF000' WHERE produk.kd_produk = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('kd_produk' => $id));
    }
}
