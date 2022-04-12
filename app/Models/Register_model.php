<?php namespace App\Models;
use CodeIgniter\Model;

class Register_model extends Model{
    public function check_username($username){
        return $this->db->table('users')
        ->where(array('username'=>$username))
        ->countAllResults();
    }

    public function add_account($data){
        return $this->db->table('users')
        ->insert($data);
    }
}