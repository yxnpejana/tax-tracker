<?php

class Client_model extends CI_Model {

        public function __construct(){
                // Call the CI_Model constructor
                parent::__construct();
        }
        
        public function client_get_something($table){
            $query = $this->db->get($table);
            
            if($query->num_rows() > 0){
                        return $query->result();
            } else { FALSE;}
        }
		
        public function get_clients($status, $start_limit, $limit){
                //switch according to status
                switch($status){
                        case 'all': $query = $this->db->get_where('clients', array('deleted' => 0), $start_limit, $limit);
                                                break;
                        case 'corps': break;
                        case 'single': break;
                }

                if($query->num_rows() > 0){
                        return $query->result();
                } else { FALSE;}
        }
        
        public function client_info($client_id){
            $query = $this->db->query("SELECT client_id, client_name, business_name, date_started, address, tin, rdo_number, "
                    . "rdo_location, business_line, contact_number, signatory, corp, has_stock FROM clients left join rdo on rdo.rdo_id = clients.rdo "
                    . "left join business_line on business_line.line_id = clients.line_id WHERE client_id =".$client_id);
            
             if($query->num_rows() > 0){
                        return $query->row();
                } else { FALSE;}
        }
        
        public function update_client($data) {            print_r($data); die();
            $to_insert = array('client_name' => $data['client_name'],
                                'business_name' => $data['business_name'],
                                'line_id' => $data['business_line'],
                                'signatory' => $data['client_signatory'],
                                'tin' => $data['tin'],
                                'address' => $data['client_address'],
                                'rdo' => $data['rdo'],
                                'corp' => $data['client_status'],
                                'contact_number' => $data['contact_number'],
                                'has_stock' => $data['stock'],
                                'date_started' => $data['date_started']);
            
            $to_insert['has_stock'] = $to_insert['corp'] === FALSE ? FALSE: TRUE;
            $this->db->set($to_insert);
            $this->db->where('client_id', $data['client_id']);
            $this->db->update('clients');
            
            if($this->db->affected_rows() > 0){
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        public function delete_client($client_id){
            $this->db->set('deleted', 1);
            $this->db->where('client_id', $client_id);
            $this->db->update('clients');
            
            $deleted = $this->db->affected_rows();
            
            if($deleted){
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        public function add_client($data){
            $data2 = array(
                    'client_name' => $data['client_name'],
                    'business_name' => $data['business_name'],
                    'line_id' => $data['business_line'],
                    'signatory' => $data['client_signatory'],
                    'tin' => $data['tin'],
                    'address' => $data['client_address'],
                    'rdo' => $data['rdo'],
                    'corp' => $data['client_status'],
                    'has_stock' => isset($data['stock'])? $data['stock']: false,
                    'date_started' => $data['date_started']
            );

            $this->db->insert('clients', $data2);
            
            return $this->db->insert_id();
        }
        
        public function add_client_tax($taxes){
            $sql = 'INSERT INTO taxes (client_id, tax_type_id) VALUES';
            
            $max = sizeof($taxes['tax_type']);
            $count_this = $max - 1;
            for($i = 0; $i < $count_this;$i++){
                $sql .= '('.$taxes['client_id'].', '.$taxes['tax_type'][$i].'),';
            }
            
                $sql .= '('.$taxes['client_id'].', '.$taxes['tax_type'][$count_this].')';
                
                $this->db->query($sql);
                
                return $this->db->insert_id();
        }
        
        public function client_get_taxes($client_id){
            $sql = 'SELECT taxes.tax_id, tax_types.tax_type_form, tax_types.frequency, tax_types.due_date '
                    . 'FROM tax_types '
                    . 'RIGHT JOIN taxes ON taxes.tax_type_id = tax_types.tax_type_id '
                    . 'LEFT JOIN clients on clients.client_id = taxes.client_id '
                    . 'WHERE clients.client_id ='.$client_id;            
            $result = $this->db->query($sql);
            
            if($result->num_rows() > 0){
                $data = $result->result_array();
            } else {
                $data = FALSE;
            }
            
            $count = 0;
            
            //get payments
            if(!$data){
                return FALSE;
            } else {
                foreach ($data as $tax){              
                    $fetch = 'SELECT tax_payments.* FROM tax_payments WHERE tax_payments.tax_id = '.$tax['tax_id'].' ';
                    $fetch_result = $this->db->query($fetch);
                    $data[$count]['payments'] = $fetch_result->result();

                    $count++;
                }
                
                
                return $data;
            }
            
        }
        
       
}