<?php

class Taxtype_model extends CI_Model {

        public function __construct(){
                // Call the CI_Model constructor
                parent::__construct();
        }
        
        public function get_taxtypes($status, $id=0){
                //switch according to status
                switch($status){
                        case 'all': $query = $this->db->get('tax_types');
                                                break;
                        case 'unique': $query = $this->db->get_where('tax_types', array('tax_type_id' => $id), 0, 1);
                            break;
                        case 'tax_clients': $query = $this->db->query('SELECT clients.client_id, clients.business_name, clients.tin, taxes.tax_id '
                                . 'FROM clients RIGHT JOIN taxes on taxes.client_id = clients.client_id '
                                . 'RIGHT JOIN tax_types on tax_types.tax_type_id = taxes.tax_type_id '
                                . 'WHERE tax_types.tax_type_id = '.$id);
                            break;
                        case 'payments': $query = $this->db->get_where('tax_payments', array('tax_id' => $id), 0, 1);
                            break;
                            
                }

                if($query->num_rows() > 0){
                        return $query->result();
                } else { return FALSE; }
        }
        
        public function add_taxtype($data){           
            $data2 = array(
                    'tax_type_form' => $data['tax_type_form'],
                    'classification' => $data['classification'],
                    'frequency' => $data['frequency'],
                    'due_date' => $data['due_date']
            );

            $this->db->insert('tax_types', $data2);
            
            return $this->db->insert_id();
        }
        
        public function get_deadlines(){
            //date only
            $today = date('d');
            $weeks2 = date('d', strtotime(' + 2 weeks'));
            //with month
            $today_M = date('F d');
            $weeks2_M = date('F d', strtotime(' + 2 weeks'));
            //query now
            $sql = $this->db->query('SELECT tax_types.tax_type_id, tax_types.tax_type_form '
                . 'FROM tax_types '
                . 'WHERE (tax_types.due_date > "'.$today.'" AND tax_types.due_date < "'.$weeks2.'")'
                . ' OR (tax_types.due_date > "'.$today_M.'" AND tax_types.due_date < "'.$weeks2_M.'")');
        
        if($sql->num_rows() > 0){
           $row = $sql->result();
            
           return $row;
            
        } else { return FALSE;}
    }
}