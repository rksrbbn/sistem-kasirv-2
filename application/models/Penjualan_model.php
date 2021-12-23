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

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kd_penjualan" => $id])->row();
    }

    public function getMapel()
    {
        $sql = "SELECT * FROM mapel";
        return $this->db->query($sql)->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('kd_penjualan' => $id));
    }

    public function delete($id)
    {
        // $sql = "DELETE mapel , penjualan FROM mapel , penjualan WHERE mapel.kd_mapel = penjualan.kd_mapel AND mapel.kd_mapel = ?";
        // return $this->db->query($sql, array($id));
        $sql = "UPDATE jurusan SET kd_penjualan = 'd000' WHERE jurusan.kd_penjualan = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('kd_penjualan' => $id));
    }
}
