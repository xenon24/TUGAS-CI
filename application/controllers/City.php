<?php

defined('BASEPATH') or exit('No direct script access allowed');

class City extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('city_model');
	}

	public function index(){
		$data = $this->city_model->select();
		$this->load->view('city/index', ['data' => $data]);
        // $this->load->view('city/index');
	}

	public function insert(){
		$this->form_validation->set_rules('name', 'Nama', 'required');
		$this->form_validation->set_rules('province_id', 'Kode Provinsi', 'required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
		if ($this->form_validation->run()) {
			$data = ['name'=>$this->input->post('name'),
			'province_id'=>$this->input->post('province_id')];
			if ($this->city_model->entry($data) == false) {
				$this->session->set_flashdata('pesan', 'Data yang di inputkan sudah tersimpan!');
                // $this->load->view('province/index');
				redirect('city/index', 'refresh');
			} else {
				$this->index();
			}

		} else {
			$this->session->set_flashdata('pesan', 'Data yang di inputkan gagal disimpan!');
			$this->index();
		} 
	}


	public function edit($id) {
		$data = ['name'=>$this->input->post('name'),
				'province_id'=>$this->input->post('province_id')];
		if ($this->city_model->update($data,$id) == false) {
			$this->session->set_flashdata('pesan', 'Data berhasil diupdate!');
                // $this->load->view('province/index');
			redirect('city/index', 'refresh');
		} else {
			$this->index();
		}
	}

	public function delete($id) {
		if ($this->city_model->delete_entry($id) == false) {
			$this->session->set_flashdata('pesan', 'Data Berhasil di Hapus!');
			redirect('city/index', 'refresh');
		} 
	}

}
