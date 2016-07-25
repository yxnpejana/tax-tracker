<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {
    
     public function __construct(){
         parent::__construct();
        
     }
    
    public function index(){
        
//        if($this->session->userdata('logged_in') === TRUE){
            $data['title'] = 'Calendar';
            $this->load->view('calendar', $data);
 
//        } else {
//            redirect('welcome');
//        }		
    }
    

    public function add_event(){
        $event = $this->input->post();
        //print_r($event); die();
        $this->load->model('calendar_model');
            
        $added = $this->calendar_model->add_event($event);

        if($added){
            redirect('calendar');
        } else {
            $_SESSION['error'] = TRUE;
            $_SESSION['error_message'] = 'Client was not added, please contact Web Admin for assistance';
            $this->session->mark_as_flash(array('error', 'error_message'));
             redirect('client/view_all');
        }
    }
    
    public function get_events(){
        $dates = $this->input->get();
        
        $this->load->model('calendar_model');        
        $events = $this->calendar_model->get_events($dates['start'], $dates['end']);
        
        if($events){
             $event_list = array();
            
            foreach($events as $each){
                $eventArray['id'] = $each->event_id;
                $eventArray['parent_id'] = $each->parent_id;
                $eventArray['title'] = $each->title;
                $eventArray['start'] = $each->start;
                $eventArray['end'] = $each->end;
                $eventArray['allDay'] = $each->allday == 1? TRUE: FALSE;
                $eventArray['color'] = $each->color;
                $event_list[] = $eventArray;
            }
            
            echo json_encode($event_list);
        }
    }
}