<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir_model extends CI_Model
{
    private $table = 'kasir';

    public function getAll()
    {
        $sql = "SELECT * FROM kasir ORDER BY id_kasir ASC";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_kasir" => $id])->row();
    }

    public function getJenisKelamin()
    {
        $sql = "SELECT * FROM kasir";
        return $this->db->query($sql)->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('id_kasir' => $id));
    }

    public function delete($id)
    {
        $sql = "UPDATE transaksi SET kasir_id = 0 WHERE kasir.id_kasir = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('id_kasir' => $id));
    }
}
