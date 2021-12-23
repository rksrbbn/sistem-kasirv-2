<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    private $table = 'transaksi';

    public function getAll()
    {
        $sql = "SELECT * FROM transaksi ORDER BY transaksi.id_transaksi ASC";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_transaksi" => $id])->row();
    }

    public function getKasir()
    {
        $sql = "SELECT * FROM kasir";
        return $this->db->query($sql)->result();
    }

    public function save($data)
    {
        // $sql = "INSERT INTO penjualan (tanggal, total, id_transaksi)  VALUES ($data['tanggal'], $data['total']) WHERE transaksi_detail.id_transaksi = ?";
        // $this->db->query($sql, array($id)); 
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_transaksi' => $id));
    }

    public function delete($id)
    {
        $sql = "DELETE FROM transaksi_detail WHERE transaksi_detail.id_transaksi = ?";
        $this->db->query($sql, array($id));
        $sql = "DELETE FROM penjualan WHERE penjualan.id_transaksi = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('id_transaksi' => $id));
    }
}
