<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kasir_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['kasirs'] = $this->kasir_model->getAll();
        $data['title'] = 'Kasir | List';
        $this->load->view('kasir/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Kasir | Create';
        // $data['kelamin'] = $this->kasir_model->getJenisKelamin();
        $this->load->view('kasir/create', $data);
    }

    public function save()
    {
        
        $this->form_validation->set_rules('nama', 'Nama Kasir', 'required');

        if ($this->form_validation->run() == true) {

            $data['nama'] = $this->input->post('nama');
            $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
            $this->kasir_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('kasir');
        } else {
            $this->load->view('kasir/create');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Kasir | Edit';
        $data['kasir'] = $this->kasir_model->getById($id);
        return $this->load->view('kasir/edit', $data);
    }

    public function update()
    {
        
        $this->form_validation->set_rules('nama', 'Nama Kasir', 'required');

        if ($this->form_validation->run() == true) {
            $id = $this->input->post('id_kasir');
            $data['id_kasir'] = $this->input->post('id_kasir');
            $data['nama'] = $this->input->post('nama');
            $data['jenis_kelamin'] = $this->input->post('jenis_kelamin');
            $this->kasir_model->update($data, $id);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('kasir');
        } else {
            $id = $this->input->post('id');
            $data['kasir'] = $this->siswa_model->getById($id);
            return $this->load->view('kasir/edit', $data);
        }
    }

    public function delete($id)
    {
        $this->kasir_model->delete($id);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('kasir');
    }
}
