<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['transaksis'] = $this->transaksi_model->getAll();
        $data['title'] = 'Transaksi | List';
        $this->load->view('transaksi/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Transaksi | Create';
        $data['kasir'] = $this->transaksi_model->getKasir();
        $this->load->view('transaksi/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('total', 'Total', 'trim|required');

        if ($this->form_validation->run() == true) {
            $data['tanggal'] = $this->input->post('tanggal');
            $data['total'] = $this->input->post('total');
            $data['kasir_id'] = $this->input->post('kasir_id');
            $this->transaksi_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('transaksi');
        } else {
            $data['kasir'] = $this->transaksi_model->getKasir();
            $this->load->view('transaksi/create', $data);
        }
    }

    public function edit($id_transaksi)
    {
        $data['title'] = 'Transaksi | Edit';
        $data['transaksi'] = $this->transaksi_model->getById($id_transaksi);
        $data['kasir'] = $this->transaksi_model->getKasir();
        return $this->load->view('transaksi/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('total', 'Total', 'trim|required');

        if ($this->form_validation->run() == true) {
            $id_transaksi = $this->input->post('id_transaksi');
            $data['tanggal'] = $this->input->post('tanggal');
            $data['total'] = $this->input->post('total');
            $data['kasir_id'] = $this->input->post('kasir_id');
            $this->transaksi_model->update($data, $id_transaksi);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('transaksi');
        } else {
            $id_transaksi = $this->input->post('id_transaksi');
            $data['transaksi'] = $this->transaksi_model->getById($id_transaksi);
            $data['kasir'] = $this->transaksi_model->getKasir();
            return $this->load->view('transaksi/edit', $data);
        }
    }

    public function delete($id_transaksi)
    {
        $this->transaksi_model->delete($id_transaksi);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('transaksi');
    }
}
