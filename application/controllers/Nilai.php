<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('nilai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['nilais'] = $this->nilai_model->getAll();
        $data['title'] = 'Nilai | List';
        $this->load->view('nilai/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Nilai | Create';
        $data['siswas'] = $this->nilai_model->getSiswa();
        $data['dosens'] = $this->nilai_model->getDosen();
        $this->load->view('nilai/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('nis', 'Nama siswa', 'trim|required');
        $this->form_validation->set_rules('kd_dosen', 'Nama dosen', 'trim|required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|numeric|max_length[3]');

        if ($this->form_validation->run() == true) {
            $data['nis'] = $this->input->post('nis');
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $data['nilai'] = $this->input->post('nilai');
            $this->nilai_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('nilai');
        } else {
            $this->load->view('nilai/create');
        }
    }

    public function edit($id_nilai)
    {
        $data['title'] = 'Nilai | Edit';
        $data['siswas'] = $this->nilai_model->getSiswa();
        $data['dosens'] = $this->nilai_model->getDosen();
        $data['nilai'] = $this->nilai_model->getById($id_nilai);
        return $this->load->view('nilai/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('nis', 'Nama siswa', 'trim|required');
        $this->form_validation->set_rules('kd_dosen', 'Nama dosen', 'trim|required');
        $this->form_validation->set_rules('nilai', 'Nilai', 'trim|required|numeric|max_length[3]');

        if ($this->form_validation->run() == true) {
            $id_nilai = $this->input->post('id');
            $data['nis'] = $this->input->post('nis');
            $data['kd_dosen'] = $this->input->post('kd_dosen');
            $data['nilai'] = $this->input->post('nilai');
            $this->nilai_model->update($data, $id_nilai);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('nilai');
        } else {
            $id_nilai = $this->input->post('id');
            $data['nilai'] = $this->nilai_model->getById($id_nilai);
            return $this->load->view('nilai/edit', $data);
        }
    }

    public function delete($id_nilai)
    {
        $this->nilai_model->delete($id_nilai);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('nilai');
    }
}
