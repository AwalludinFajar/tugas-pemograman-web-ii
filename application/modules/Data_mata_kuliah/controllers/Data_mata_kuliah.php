<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_mata_kuliah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_mata_kuliah_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_mata_kuliah/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_mata_kuliah/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_mata_kuliah/index.html';
            $config['first_url'] = base_url() . 'data_mata_kuliah/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_mata_kuliah_model->total_rows($q);
        $data_mata_kuliah = $this->Data_mata_kuliah_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_mata_kuliah_data' => $data_mata_kuliah,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('data_mata_kuliah/data_mata_kuliah_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_mata_kuliah_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_mata_kuliah' => $row->nama_mata_kuliah,
		'sks' => $row->sks,
		'semester' => $row->semester,
	    );
            $this->load->view('data_mata_kuliah/data_mata_kuliah_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mata_kuliah'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_mata_kuliah/create_action'),
	    'id' => set_value('id'),
	    'nama_mata_kuliah' => set_value('nama_mata_kuliah'),
	    'sks' => set_value('sks'),
	    'semester' => set_value('semester'),
	);
        $this->load->view('data_mata_kuliah/data_mata_kuliah_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
		'semester' => $this->input->post('semester',TRUE),
	    );

            $this->Data_mata_kuliah_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_mata_kuliah'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_mata_kuliah_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_mata_kuliah/update_action'),
		'id' => set_value('id', $row->id),
		'nama_mata_kuliah' => set_value('nama_mata_kuliah', $row->nama_mata_kuliah),
		'sks' => set_value('sks', $row->sks),
		'semester' => set_value('semester', $row->semester),
	    );
            $this->load->view('data_mata_kuliah/data_mata_kuliah_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mata_kuliah'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_mata_kuliah' => $this->input->post('nama_mata_kuliah',TRUE),
		'sks' => $this->input->post('sks',TRUE),
		'semester' => $this->input->post('semester',TRUE),
	    );

            $this->Data_mata_kuliah_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_mata_kuliah'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_mata_kuliah_model->get_by_id($id);

        if ($row) {
            $this->Data_mata_kuliah_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_mata_kuliah'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mata_kuliah'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_mata_kuliah', 'nama mata kuliah', 'trim|required');
	$this->form_validation->set_rules('sks', 'sks', 'trim|required');
	$this->form_validation->set_rules('semester', 'semester', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_mata_kuliah.php */
/* Location: ./application/controllers/Data_mata_kuliah.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-23 16:53:35 */
/* http://harviacode.com */