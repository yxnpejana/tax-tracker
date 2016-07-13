<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function index(){
            if($this->session->userdata('logged_in') === TRUE){
                redirect('client/view_all');
            } else {
                redirect('welcome');
            }		
	}
	
	public function view_all(){
            if($this->session->userdata('logged_in') !== TRUE){
                $logs = array('current' => site_url(), 'go_bak' => TRUE);
                $this->session->flashdata($logs);
                redirect('welcome');
            } 
            
            $this->load->model('client_model');

            $clients = $this->client_model->get_clients('all',0,10);	
            $data['clients'] = $clients;            
            $data['lines'] = $this->client_model->client_get_something('business_line');	            
            $data['rdos'] = $this->client_model->client_get_something('rdo');
            $data['status'] = 'All Clients';

            //start working, View Dashboard
            $data['title'] = 'Clients';
            $this->load->view('clients', $data);
	}
	
	public function view_client($client_id){
            if($this->session->userdata('logged_in') !== TRUE){
                $logs = array('current' => site_url(), 'go_bak' => TRUE);
                $this->session->flashdata($logs);
                redirect('welcome');
            } 
            
            $this->load->model('client_model');
            
            $data['client'] = $this->client_model->client_info($client_id);	            
            $data['lines'] = $this->client_model->client_get_something('business_line');	            
            $data['rdos'] = $this->client_model->client_get_something('rdo');	            
            $data['tax_types'] = $this->client_model->client_get_something('tax_types');
            $data['taxes'] = $this->client_model->client_get_taxes($client_id);
                      
            //start working, View Dashboard
            $data['title'] = 'Clients';
            $this->load->view('client_info', $data);
        }
        
        public function print_this($status){
            if($this->session->userdata('logged_in') !== TRUE){
                $logs = array('current' => site_url(), 'go_bak' => TRUE);
                $this->session->flashdata($logs);
                redirect('welcome');
            } 
            
            $this->load->model('client_model');
            
            $clients = $this->client_model->get_clients($status,0,80);
            $data['clients'] = $clients;
            $data['status'] = 'All Clients';
            $data['title'] = 'Clients';
            
            $this->load->view('print_client_all', $data);
        }
        
        public function update(){
            $data = $this->input->post();
            
            $this->load->model('client_model');
            $saved = $this->client_model->update_client($data);
            
            if($saved){
                redirect('client/view_client/'.$data['client_id']);
            }
        }
        
        public function delete_client($client_id){
            $this->load->model('client_model');
            
            $deleted = $this->client_model->delete_client($client_id);
            
            if($deleted){
                redirect('client/view_all');
            } else {
                $_SESSION['error'] = TRUE;
                $_SESSION['error_message'] = 'Client was not deleted, please contact Web Admin';
                $this->session->mark_as_flash(array('error', 'error_message'));
                 redirect('client/view_all');
            }
        }
        
        public function add_new(){
            $data = $this->input->post();
            
            $this->load->model('client_model');
            
            $added = $this->client_model->add_client($data);
            
            if($added){
                redirect('client/view_all');
            } else {
                $_SESSION['error'] = TRUE;
                $_SESSION['error_message'] = 'Client was not added, please contact Web Admin for assistance';
                $this->session->mark_as_flash(array('error', 'error_message'));
                 redirect('client/view_all');
            }
        }
        
        public function add_taxes(){
            $taxes = $this->input->post();
            
            $this->load->model('client_model');
            
            $added = $this->client_model->add_client_tax($taxes);
            
            if($added){
                redirect('client/view_client/'.$taxes['client_id']);
            } else {
                $_SESSION['error'] = TRUE;
                $_SESSION['error_message'] = 'Taxes not added, please contact Web Admin for assistance';
                $this->session->mark_as_flash(array('error', 'error_message'));
                redirect('client/view_client/'.$taxes['client_id']);
            }
        }
}