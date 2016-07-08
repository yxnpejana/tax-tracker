<?php

class Tax_model extends CI_Model {

    public function __construct(){
            // Call the CI_Model constructor
            parent::__construct();
    }
    
    public function file_tax($data){
        $to_save = array(
                'tax_id' => $data['tax_id'],
                'amount' => $data['amount'],
                'date_filed' => $data['date_filed'],
                'bank'  => $data['bank'],
                'period' => $data['period'],
                'form_copy' => $data['form_copy']
        );

        $this->db->insert('tax_payments', $to_save);

        return $this->db->insert_id();
    }
    
    public function not_yet_filed(){      
        $has_deadline = $this->todayhas_deadline();
        
        return $has_deadline;
    }
    
    private function todayhas_deadline(){
        //get date today, check if has deadline
        $date_today = date('d');
        $date_todayM = date('F d');
        //minus 3 days to check for weekends purposes
        $date_today3 = date('d', strtotime(' - 3 days'));
        $date_todayM3 = date('F d', strtotime(' - 3 days'));
        
        $query = $this->db->query('SELECT tax_types.tax_type_id, tax_types.tax_type_form '
                . 'FROM tax_types '
                . 'WHERE (tax_types.due_date < "'.$date_today.'" AND tax_types.due_date > "'.$date_today3.'")'
                . ' OR (tax_types.due_date < "'.$date_todayM.'" AND tax_types.due_date > "'.$date_todayM3.'")');
        
        if($query->num_rows() > 0){
           $row = $query->result();
            
           return $row;           
            
        } else { return FALSE;}
    }
}