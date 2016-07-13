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
        
        //get how many not yet filed
        $main = array();
        $count = 0;
        
        if($has_deadline){
            foreach($has_deadline as $deadline){
                $query = $this->db->query('SELECT clients.business_name, clients.client_id, clients.tin '
                    . 'FROM clients RIGHT JOIN taxes ON taxes.client_id = clients.client_id'
                    . ' WHERE clients.client_id NOT IN(SELECT clients.client_id '
                    . '                                             FROM tax_payments '
                    . '                                             LEFT JOIN taxes ON taxes.tax_id = tax_payments.tax_id '
                    . '                                             LEFT JOIN clients on clients.client_id = taxes.client_id '
                    . '                                             WHERE taxes.tax_type_id = '.$deadline->tax_type_id.' AND tax_payments.period = "'. date('F Y', strtotime('- 1 month')).'")'
                    . ' AND taxes.tax_type_id = '.$deadline->tax_type_id.'');


                if($query->num_rows() > 0){
                    $count += $query->num_rows();

                    $clients[$deadline->tax_type_form] = array();
                    $row = $query->result_array();  
                    $clients[$deadline->tax_type_form ]= $row;
                    
                    $main['count'] = $count;
                    $main['clients'] = $clients;
                } 

                


            } 
            
        } else {
            $main = FALSE;
        }
        
        return $main;
        
    }
    
    private function todayhas_deadline(){
        //get date today, check if has deadline
        $date_today = date('d');
        $date_todayM = date('F d');
        //minus 3 days to check for weekends purposes
        $date_today3 = date('d', strtotime(' - 10 days'));
        $date_todayM3 = date('F d', strtotime(' - 10 days'));
        
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