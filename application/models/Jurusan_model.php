<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{
    private $table = 'jurusan';

    public function getAll()
    {
        $sql = "SELECT kd_jurusan, nama_jurusan, nama_dosen FROM jurusan INNER JOIN dosen ON dosen.kd_dosen = jurusan.kd_dosen WHERE jurusan.kd_jurusan != 'j000' ORDER BY jurusan.kd_jurusan ASC";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kd_jurusan" => $id])->row();
    }

    public function getDosen()
    {
        $sql = "SELECT * FROM dosen";
        return $this->db->query($sql)->result();
    }

    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $id)
    {
        return $this->db->update($this->table, $data, array('kd_jurusan' => $id));
    }

    public function delete($id)
    {
        $sql = "UPDATE siswa SET kd_jurusan = 'j000' WHERE siswa.kd_jurusan = ?";
        $this->db->query($sql, array($id));
        return $this->db->delete($this->table, array('kd_jurusan' => $id));
    }
}
