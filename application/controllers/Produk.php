<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data['produks'] = $this->produk_model->getAll();
        $data['title'] = 'Produk | List';
        $this->load->view('produk/list', $data);
    }

    public function create()
    {
        $data['title'] = 'Produk | Create';
        $this->load->view('produk/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('kd_produk', 'Kode Produk', 'required|is_unique[produk.kd_produk]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required');

        if ($this->form_validation->run() == true) {
            $data['nama'] = $this->input->post('nama');
            $data['kd_produk'] = $this->input->post('kd_produk');
            $data['harga'] = $this->input->post('harga');
            $data['stok'] = $this->input->post('stok');
            $this->produk_model->save($data);
            $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
            redirect('produk');
        } else {
            $this->load->view('produk/create');
        }
    }

    public function edit($kd_produk)
    {
        $data['title'] = "Produk | Edit";
        $data['produk'] = $this->produk_model->getById($kd_produk);
        $this->load->view('produk/edit', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('kd_produk', 'Kode Produk', 'required|min_length[4]');
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[4]|max_length[6]');
        $this->form_validation->set_rules('stok', 'Stok', 'required');

        if ($this->form_validation->run() == true) {
            $kd_produk = $this->input->post('kode');
            $data['kd_produk'] = $this->input->post('kd_produk');
            $data['nama'] = $this->input->post('nama');
            $data['harga'] = $this->input->post('harga');
            $data['stok'] = $this->input->post('stok');
            $this->produk_model->update($data, $kd_produk);
            $this->session->set_flashdata('pesan', 'Data berhasil di ubah');
            redirect('produk');
        } else {
            $kd_produk = $this->input->post('kode');
            $data['mapel'] = $this->mapel_model->getById($kd_produk);
            $this->load->view('produk/edit', $data);
        }
    }

    public function delete($kd_produk)
    {
        $this->produk_model->delete($kd_produk);
        $this->session->set_flashdata('pesan', '<span class="text-danger">
        Data berhasil di hapus
        </span>');
        redirect('produk');
    }
}
