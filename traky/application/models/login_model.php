<?php

class Login_model extends CI_Model {

        public function __construct(){
                // Call the CI_Model constructor
                parent::__construct();
        }
		
        public function verify($account){

                $query = $this->db->query('SELECT * FROM users WHERE user_name = "'.$account['username'].'" AND password = "'.$account['password'].'"');
                $row = $query->row(); 

                if (isset($row)){
                    return $row;
                } else {
                    return FALSE;
                }
        }
}