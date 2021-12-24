<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("produk_model");
        $this->load->model("kasir_model");
        $this->load->model("penjualan_model");
        $this->load->model("transaksi_model");
    }

    public function index()
    {
        $data_produk = $this->produk_model->getJumlah();
        $data_kasir = $this->kasir_model->getJumlah();
        $data_penjualan = $this->penjualan_model->getJumlah();
        $data_transaksi = $this->transaksi_model->getJumlah();

        $data['title'] = 'Dashboard';
        $data['j_produk'] = $data_produk;
        $data['j_kasir'] = $data_kasir;
        $data['j_transaksi'] = $data_transaksi;
        $data['j_penjualan'] = $data_penjualan;
        $this->load->view('dashboard', $data);
    }
}
