<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function check_credential(){
        $db2 = $this->load->database('dbsqlsrv', TRUE);

        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $hasil=$db2->where('username',$username)
                        ->where('password',$password)
                        ->limit(1)
                        ->get('users');  

        if ($hasil->num_rows()>0) {
            return $hasil->row();
        }else{
            return array();
        }
    }
    
    function all($table){
        $db2 = $this->load->database('dbsqlsrv', TRUE);

        return $db2->get($table);
    }

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */ ?>