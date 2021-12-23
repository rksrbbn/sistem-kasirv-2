<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dosen_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['dosens'] = $this->dosen_model->getAll();
        $data['title'] = 'Dosen | List';
        $this->load->view('dosen/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Dosen | Create';
        $data['mapels'] = $this->dosen_model->getMapel();
        $this->load->view('dosen/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('kd_dosen', 'Kode dosen', 'trim|required|is_unique[dosen.kd_dosen]|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_dosen', 'Nama dosen', 'trim|required');
        $this->form_validation->set_rules('alamat_dosen', 'Alamat dosen', 'trim|required');
        $this->form_validation->set_rules('kd_mapel', 'kode mapel', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $data['nama_dosen'] = $this->input->post('nama_dosen');
            $data['alamat_dosen'] = $this->input->post('alamat_dosen');
            $data['kd_mapel'] = $this->input->post('kd_mapel');
            $this->dosen_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('dosen');
        } else {
            $this->load->view('dosen/create');
        }
    }

    public function edit($kd_dosen)
    {
        $data['title'] = 'Dosen | Edit';
        $data['mapels'] = $this->dosen_model->getMapel();
        $data['dosen'] = $this->dosen_model->getById($kd_dosen);
        return $this->load->view('dosen/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('kd_dosen', 'Kode dosen', 'trim|required|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_dosen', 'Nama dosen', 'trim|required');
        $this->form_validation->set_rules('alamat_dosen', 'Alamat dosen', 'trim|required');
        $this->form_validation->set_rules('kd_mapel', 'kode mapel', 'trim|required');

        if ($this->form_validation->run() == true) {
            $kd_dosen = $this->input->post('kode');
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $data['nama_dosen'] = $this->input->post('nama_dosen');
            $data['alamat_dosen'] = $this->input->post('alamat_dosen');
            $data['kd_mapel'] = $this->input->post('kd_mapel');
            $this->dosen_model->update($data, $kd_dosen);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('dosen');
        } else {
            $kd_dosen = $this->input->post('kode');
            $data['dosen'] = $this->dosen_model->getById($kd_dosen);
            $this->load->view('dosen/edit', $data);
        }
    }

    public function delete($kd_dosen)
    {
        $this->dosen_model->delete($kd_dosen);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('dosen');
    }
}
