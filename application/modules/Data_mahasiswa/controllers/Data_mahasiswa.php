<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_mahasiswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_mahasiswa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_mahasiswa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_mahasiswa/index.html';
            $config['first_url'] = base_url() . 'data_mahasiswa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_mahasiswa_model->total_rows($q);
        $data_mahasiswa = $this->Data_mahasiswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'data_mahasiswa_data' => $data_mahasiswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('data_mahasiswa/data_mahasiswa_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Data_mahasiswa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nim' => $row->nim,
		'nama' => $row->nama,
		'jurusan' => $row->jurusan,
	    );
            $this->load->view('data_mahasiswa/data_mahasiswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mahasiswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_mahasiswa/create_action'),
	    'id' => set_value('id'),
	    'nim' => set_value('nim'),
	    'nama' => set_value('nama'),
	    'jurusan' => set_value('jurusan'),
	);
        $this->load->view('data_mahasiswa/data_mahasiswa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nim' => $this->input->post('nim',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'jurusan' => $this->input->post('jurusan',TRUE),
	    );

            $this->Data_mahasiswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_mahasiswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_mahasiswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_mahasiswa/update_action'),
		'id' => set_value('id', $row->id),
		'nim' => set_value('nim', $row->nim),
		'nama' => set_value('nama', $row->nama),
		'jurusan' => set_value('jurusan', $row->jurusan),
	    );
            $this->load->view('data_mahasiswa/data_mahasiswa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mahasiswa'));
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
		'nama' => $this->input->post('nama',TRUE),
		'jurusan' => $this->input->post('jurusan',TRUE),
	    );

            $this->Data_mahasiswa_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_mahasiswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_mahasiswa_model->get_by_id($id);

        if ($row) {
            $this->Data_mahasiswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_mahasiswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_mahasiswa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nim', 'nim', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Data_mahasiswa.php */
/* Location: ./application/controllers/Data_mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-04-23 16:52:29 */
/* http://harviacode.com */