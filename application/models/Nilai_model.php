<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    private $table = 'nilai';

    public function getAll()
    {
        $sql = "SELECT id_nilai, nilai, nama_siswa, nama_dosen FROM nilai INNER JOIN siswa ON nilai.nis = siswa.nis INNER JOIN dosen ON nilai.kd_dosen = dosen.kd_dosen ORDER BY id_nilai ASC";
        return $this->db->query($sql)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["id_nilai" => $id])->row();
    }

    public function getSiswa()
    {
        $sql = "SELECT * FROM siswa";
        return $this->db->query($sql)->result();
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
        return $this->db->update($this->table, $data, array('id_nilai' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_nilai' => $id));
    }
}
