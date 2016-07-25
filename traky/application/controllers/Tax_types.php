<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax_types extends CI_Controller {

	public function index(){
//            if($this->session->userdata('logged_in') === TRUE){
                redirect('tax_types/view_all');
//            } else {
//                redirect('welcome');
//            }		
	}
        
        public function view_all(){
//            if($this->session->userdata('logged_in') !== TRUE){
//                $logs = array('current' => site_url(), 'go_bak' => TRUE);
//                $this->session->flashdata($logs);
//                redirect('welcome');
//            } 
            
            $this->load->model('taxtype_model');

            $taxtypes = $this->taxtype_model->get_taxtypes('all');	
            $data['taxtypes'] = $taxtypes;        
            $data['status'] = 'All Tax Types';
            
            //start working, Manage Tax Types
            $data['title'] = 'Tax Types';
            $this->load->view('tax_types', $data);
	}
        
        public function add_new(){
            $data = $this->input->post();
            
            $this->load->model('taxtype_model');
            
            $added = $this->taxtype_model->add_taxtype($data);
            
            if($added){
                redirect('tax_types/view_all');
            } else {
                $_SESSION['error'] = TRUE;
                $_SESSION['error_message'] = 'Tax Type was not added, please contact Web Admin for assistance';
                $this->session->mark_as_flash(array('error', 'error_message'));
                 redirect('tax_types/view_all');
            }
        }
        
        public function view_all_clients($tax_type_id){
//            if($this->session->userdata('logged_in') !== TRUE){
//                $logs = array('current' => site_url(), 'go_bak' => TRUE);
//                $this->session->flashdata($logs);
//                redirect('welcome');
//            } 
            
            $this->load->model('taxtype_model');

            $taxtypes = $this->taxtype_model->get_taxtypes('unique', $tax_type_id);	
            
            //get next due date
            switch ($taxtypes[0]->frequency){
                case 'monthly': 
                                if(date('j') > $taxtypes[0]->due_date){
                                    //lapas na
                                    $data['due'] = 'Next Due on '.date('F '.$taxtypes[0]->due_date.', Y', strtotime('+ 1 month'));
                                } else if(date('j') < $taxtypes[0]->due_date){
                                    //layo layo pa
                                    $data['due'] = 'Will be due on '.date('F '.$taxtypes[0]->due_date.', Y');
                                } else if(date('j') == $taxtypes[0]->due_date){
                                    //karon na
                                    $data['due'] = 'Today';
                                }
                    break;
                case 'annually': 
                                if(date('j') > $taxtypes[0]->due_date){
                                    //lapas na
                                    $data['due'] = 'Next Due on '.date('F '.$taxtypes[0]->due_date.', Y', strtotime('+ 1 year'));
                                } else if(date('j') < $taxtypes[0]->due_date){
                                    //layo layo pa
                                    $data['due'] = 'Will be due on '.date('F '.$taxtypes[0]->due_date.', Y');
                                } else if(date('j') == $taxtypes[0]->due_date){
                                    //karon na
                                    $data['due'] = 'Today';
                                }
                    break;
                case 'quarterly': 
                                if(date('j') > $taxtypes[0]->due_date){
                                    //lapas na
                                    $data['due'] = 'Next Due on '.date('F '.$taxtypes[0]->due_date.', Y', strtotime('+ 4 months'));
                                } else if(date('j') < $taxtypes[0]->due_date){
                                    //layo layo pa
                                    $data['due'] = 'Will be due on '.date('F '.$taxtypes[0]->due_date.', Y');
                                } else if(date('j') == $taxtypes[0]->due_date){
                                    //karon na
                                    $data['due'] = 'Today';
                                }
                    break;
            }
            
            //get clients with this tax type
            $clients = $this->taxtype_model->get_taxtypes('tax_clients', $tax_type_id);
            
            //get payments per client per tax type per period
            $count = 0;
            foreach ($clients as $client){
                $payments = $this->taxtype_model->get_taxtypes('payments', $client->tax_id);
                $client->payments = $payments;
                
                $clients[$count] = $client;
                
                $count++;
            }
            
            //start working, Manage Tax Types per client   
            $data['taxtypes'] = $taxtypes[0];        
            $data['status'] = $taxtypes[0]->tax_type_form;
            $data['due'] = 'Today';
            $data['clients'] = $clients;            
            $data['title'] = 'Tax Types';
            $this->load->view('tax_unique', $data);
        }
}