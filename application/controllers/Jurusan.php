<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['jurusans'] = $this->jurusan_model->getAll();
        $data['title'] = 'Jurusan | List';
        $this->load->view('jurusan/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Jurusan | Create';
        $data['dosens'] = $this->jurusan_model->getDosen();
        $this->load->view('jurusan/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('kd_jurusan', 'Kode jurusan', 'trim|required|is_unique[jurusan.kd_jurusan]|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'trim|required');
        $this->form_validation->set_rules('kd_dosen', 'Kode dosen', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['kd_jurusan'] = $this->input->post('kd_jurusan');
            $data['nama_jurusan'] = $this->input->post('nama_jurusan');
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $this->jurusan_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('jurusan');
        } else {
            $this->load->view('jurusan/create');
        }
    }

    public function edit($kd_jurusan)
    {
        $data['title'] = 'Jurusan | Edit';
        $data['dosens'] = $this->jurusan_model->getDosen();
        $data['jurusan'] = $this->jurusan_model->getById($kd_jurusan);
        return $this->load->view('jurusan/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('kd_jurusan', 'Kode jurusan', 'trim|required|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_jurusan', 'Nama jurusan', 'trim|required');
        $this->form_validation->set_rules('kd_dosen', 'Kode dosen', 'trim|required');

        if ($this->form_validation->run() == true) {
            $kd_jurusan = $this->input->post('kode');
            $data['kd_jurusan'] = $this->input->post('kd_jurusan');
            $data['nama_jurusan'] = $this->input->post('nama_jurusan');
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $this->jurusan_model->update($data, $kd_jurusan);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('jurusan');
        } else {
            $kd_jurusan = $this->input->post('kode');
            $data['jurusan'] = $this->jurusan_model->getById($kd_jurusan);
            return $this->load->view('jurusan/edit', $data);
        }
    }

    public function delete($kd_jurusan)
    {
        $this->jurusan_model->delete($kd_jurusan);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('jurusan');
    }
}
