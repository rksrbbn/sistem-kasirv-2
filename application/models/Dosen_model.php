<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_model extends CI_Model
{
    private $table = 'dosen';

    public function getAll()
    {
        $sql = "SELECT kd_dosen, nama_dosen, alamat_dosen, nama_mapel FROM dosen INNER JOIN mapel ON mapel.kd_mapel = dosen.kd_mapel WHERE dosen.kd_dosen != 'd000' ORDER BY dosen.kd_dosen ASC";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kd_dosen" => $id])->row();
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
        return $this->db->update($this->table, $data, array('kd_dosen' => $id));
    }

    public function delete($id)
    {
        // $sql = "DELETE mapel , dosen FROM mapel , dosen WHERE mapel.kd_mapel = dosen.kd_mapel AND mapel.kd_mapel = ?";
        // return $this->db->query($sql, array($id));
        $sql = "UPDATE jurusan SET kd_dosen = 'd000' WHERE jurusan.kd_dosen = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('kd_dosen' => $id));
    }
}
