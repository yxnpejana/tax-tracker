<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
                        
            if($this->session->userdata('logged_in') === TRUE){
                //start working, View Dashboard
                
                //get upcoming events
                $this->load->model('calendar_model');
                $today = date('Y-m-d');
                $week2 = date('Y-m-d', strtotime(' + 2 weeks'));
                $events = $this->calendar_model->get_events($today, $week2);
                
                //get tax deadlines
                $this->load->model('taxtype_model');                
                $get_taxes_toBeFiled = $this->taxtype_model->get_deadlines();
                
                //get not yet filed
                $this->load->model('tax_model');
                $not_yet_filed = $this->tax_model->not_yet_filed();
                    
                $data['not_filed_yet'] = $not_yet_filed;
                $data['upDeadline_count'] = count($get_taxes_toBeFiled);
                $data['to_be_filed'] = $get_taxes_toBeFiled;
                $data['events'] = $events;
                $data['title'] = 'Dashboard';
                $this->load->view('dashboard', $data);
                
            } else {
                $this->load->view('login');
            }		
	}
	
	public function login(){            
            $account = $this->input->post();

            //verify account
            $this->load->model('login_model');
            $user = $this->login_model->verify($account);

            if($user){                    
                    $newdata = array(
                            'username'  => $user->user_name,
                            'user_id'	=> $user->user_id,
                            'name'		=> $user->name,
                            'position'	=> $user->position,
                            'started'	=> $user->started,
                            'id_token'      => session_id(),
                            'logged_in' => TRUE
                    );

                    $this->session->set_userdata($newdata);

                    //start working, View Dashboard

            } 
            redirect('welcome');
	}
	
	public function logout(){
            $this->session->sess_destroy();
            redirect('welcome');
	}
}
