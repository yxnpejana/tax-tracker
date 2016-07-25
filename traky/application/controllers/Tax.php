<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tax extends CI_Controller {

    public function index(){
//        if($this->session->userdata('logged_in') === TRUE){
            redirect('tax');
//        } else {
//            redirect('welcome');
//        }		
    }
    
    public function filing(){
       $data = $this->input->post();
       
        $this->load->model('tax_model');

        $added = $this->tax_model->file_tax($data);

        if($added){
            redirect($data['from']);
        } else {
            $_SESSION['error'] = TRUE;
            $_SESSION['error_message'] = 'Tax filed was not recorded, please contact admin';
            $this->session->mark_as_flash(array('error', 'error_message'));
             redirect($data['from']);
        }
    }
}