<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('penjualan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['penjualan'] = $this->penjualan_model->getAll();
        $data['title'] = 'Penjualan | List';
        $this->load->view('penjualan/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Penjualan | Create';
        $data['mapels'] = $this->Penjualan_model->getMapel();
        $this->load->view('Penjualan/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('kd_Penjualan', 'Kode Penjualan', 'trim|required|is_unique[Penjualan.kd_Penjualan]|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_Penjualan', 'Nama Penjualan', 'trim|required');
        $this->form_validation->set_rules('alamat_Penjualan', 'Alamat Penjualan', 'trim|required');
        $this->form_validation->set_rules('kd_mapel', 'kode mapel', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['kd_Penjualan'] = $this->input->post('kd_Penjualan');
            $data['nama_Penjualan'] = $this->input->post('nama_Penjualan');
            $data['alamat_Penjualan'] = $this->input->post('alamat_Penjualan');
            $data['kd_mapel'] = $this->input->post('kd_mapel');
            $this->Penjualan_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('Penjualan');
        } else {
            $this->load->view('Penjualan/create');
        }
    }

    public function edit($kd_Penjualan)
    {
        $data['title'] = 'Penjualan | Edit';
        $data['mapels'] = $this->Penjualan_model->getMapel();
        $data['Penjualan'] = $this->Penjualan_model->getById($kd_Penjualan);
        return $this->load->view('Penjualan/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('kd_Penjualan', 'Kode Penjualan', 'trim|required|max_length[4]|min_length[4]');
        $this->form_validation->set_rules('nama_Penjualan', 'Nama Penjualan', 'trim|required');
        $this->form_validation->set_rules('alamat_Penjualan', 'Alamat Penjualan', 'trim|required');
        $this->form_validation->set_rules('kd_mapel', 'kode mapel', 'trim|required');

        if ($this->form_validation->run() == true) {
            $kd_Penjualan = $this->input->post('kode');
            $data['kd_Penjualan'] = $this->input->post('kd_Penjualan');
            $data['nama_Penjualan'] = $this->input->post('nama_Penjualan');
            $data['alamat_Penjualan'] = $this->input->post('alamat_Penjualan');
            $data['kd_mapel'] = $this->input->post('kd_mapel');
            $this->Penjualan_model->update($data, $kd_Penjualan);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('Penjualan');
        } else {
            $kd_Penjualan = $this->input->post('kode');
            $data['Penjualan'] = $this->Penjualan_model->getById($kd_Penjualan);
            $this->load->view('Penjualan/edit', $data);
        }
    }

    public function delete($kd_Penjualan)
    {
        $this->Penjualan_model->delete($kd_Penjualan);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('Penjualan');
    }
}
