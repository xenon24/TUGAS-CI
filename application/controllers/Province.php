<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Province extends CI_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('province_model');
    }

    public function index(){
        $data = $this->province_model->select();
        $this->load->view('province/index', ['data' => $data]);
    }

    public function insert(){
        $this->form_validation->set_rules('name_province', 'Nama', 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">','</span>');
        if ($this->form_validation->run()) {
            $data = ['name_province'=>$this->input->post('name_province')];
            if ($this->province_model->entry($data) == false) {
                $this->session->set_flashdata('pesan', 'Data yang di inputkan sudah tersimpan!');
                // $this->load->view('province/index');
                redirect('province/index', 'refresh');
            } else {
                $this->index();
            }
            
        } else {
            $this->session->set_flashdata('pesan', 'Data yang di inputkan gagal disimpan!');
            $this->index();
        }
        
    }


    // public function edit($id){
    //     $data['province'] = $this->province_model->get_province($id);
    //     $this->load->view('province/index', ['data' => $data]);
    // }

    public function edit($id) {
        
        $data = ['name_province'=>$this->input->post('name_province')];
        if ($this->province_model->update($data,$id) == false) {
                $this->session->set_flashdata('pesan', 'Data berhasil diupdate!');
                // $this->load->view('province/index');
                redirect('province/index', 'refresh');
            } else {
                $this->index();
            }
    }

    public function delete($id) {
        if ($this->province_model->delete_entry($id) == false) {
            $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus!');
            redirect('province/index', 'refresh');
        } 
    }

}
