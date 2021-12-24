<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('produk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['transaksis'] = $this->transaksi_model->getAll();
        $data['title'] = 'Transaksi | List';
        $this->load->view('transaksi/list', $data);
    }

    public function detail($id)
    {
        $kd_produk = $this->transaksi_model->getIdDetail($id)->kd_produk;
        $data['nm_produk'] = $this->produk_model->getByID($kd_produk)->nama;
        
        $data['detail'] = $this->transaksi_model->getDetail($id);
        $data['title'] = 'Detail Transaksi';
        $this->load->view('transaksi/detail', $data);
    }

    public function create()
    {
        $data['title'] = 'Transaksi | Create';
        $data['kasir'] = $this->transaksi_model->getKasir();
        $data['produk'] = $this->produk_model->getAll();
        $this->load->view('transaksi/create', $data);
    }

    public function save()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal Transaksi', 'trim|required');
        $this->form_validation->set_rules('qty', 'QTY', 'trim|required');

        if ($this->form_validation->run() == true) {
            $kd_produk = $this->input->post('kd_produk');
            $harga = $this->produk_model->getById($kd_produk)->harga;
            $stok = $this->produk_model->getById($kd_produk)->stok;
            $qty = $this->input->post('qty');
            $total = $harga * $qty;
            
            if($stok >= $qty){

                $data_p['tanggal'] = $this->input->post('tanggal');
                $data_p['total'] = $total;

                $data2['kd_produk'] = $kd_produk;
                $data2['harga'] = $harga;
                $data2['qty'] = $qty;

                $data['tanggal'] = $this->input->post('tanggal');
                $data['total'] = $total;
                $data['kasir_id'] = $this->input->post('kasir_id');

                $this->produk_model->de_stock($kd_produk,$qty);
                $this->transaksi_model->save($data,$data2,$data_p);
                $this->session->set_flashdata('pesan', 'Data berhasil di simpan');
                redirect('transaksi');
            } else {
                $data['produk'] = $this->produk_model->getAll();
                $data['kasir'] = $this->transaksi_model->getKasir();
                $this->load->view('transaksi/create', $data);
            }
        } else {
            $data['produk'] = $this->produk_model->getAll();
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
