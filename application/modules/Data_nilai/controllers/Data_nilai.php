<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_nilai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_nilai_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_nilai/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_nilai/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_nilai/index.html';
            $config['first_url'] = base_url() . 'data_nilai/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_nilai_model->total_rows($q);
        $data_nilai = $this->Data_nilai_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_nilai_data' => $data_nilai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('data_nilai/data_nilai_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_nilai_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nim' => $row->nim,
		'id_mata_kuliah' => $row->id_mata_kuliah,
		'id_dosen' => $row->id_dosen,
		'nilai' => $row->nilai,
	    );
            $this->load->view('data_nilai/data_nilai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_nilai'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_nilai/create_action'),
	    'id' => set_value('id'),
	    'nim' => set_value('nim'),
	    'id_mata_kuliah' => set_value('id_mata_kuliah'),
	    'id_dosen' => set_value('id_dosen'),
	    'nilai' => set_value('nilai'),
	);
        $this->load->view('data_nilai/data_nilai_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'id_mata_kuliah' => $this->input->post('id_mata_kuliah',TRUE),
		'id_dosen' => $this->input->post('id_dosen',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Data_nilai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_nilai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_nilai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_nilai/update_action'),
		'id' => set_value('id', $row->id),
		'nim' => set_value('nim', $row->nim),
		'id_mata_kuliah' => set_value('id_mata_kuliah', $row->id_mata_kuliah),
		'id_dosen' => set_value('id_dosen', $row->id_dosen),
		'nilai' => set_value('nilai', $row->nilai),
	    );
            $this->load->view('data_nilai/data_nilai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_nilai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'id_mata_kuliah' => $this->input->post('id_mata_kuliah',TRUE),
		'id_dosen' => $this->input->post('id_dosen',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
	    );

            $this->Data_nilai_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_nilai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_nilai_model->get_by_id($id);

        if ($row) {
            $this->Data_nilai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_nilai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_nilai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('id_mata_kuliah', 'id mata kuliah', 'trim|required');
	$this->form_validation->set_rules('id_dosen', 'id dosen', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_nilai.php */
/* Location: ./application/controllers/Data_nilai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-23 16:54:28 */
/* http://harviacode.com */