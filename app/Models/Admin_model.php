<?php namespace App\Models;
use CodeIgniter\Model;

class Admin_model extends Model{
    public function get_CountUser(){
        return $this->db->table('users')
        ->countAllResults();
    }
}
