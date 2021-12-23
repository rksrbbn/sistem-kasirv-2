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
}