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

    public function getDetail($id)
    {   
        $sql = "SELECT * FROM transaksi_detail WHERE id_transaksi = $id";
        return $this->db->query($sql)->result();
    }

    public function save($data,$data2,$data_p)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        $data2['id_transaksi'] = $last_id;
        $this->db->insert('transaksi_detail', $data2);
        $data_p['id_transaksi'] = $last_id;
        $this->db->insert('penjualan', $data_p);
        $this->db->trans_complete();
        $this->db->trans_status();
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
