<?php namespace App\Models;
use CodeIgniter\Model;

class Login_model extends Model{
    public function cek_login($username, $password){
        return $this->db->table('users')
        ->where(array('username'=>$username, 'password'=>$password));
    }

    public function update_lastlogin($id){
        return $this->db->table('users')
        ->where('id_user', $id)
        ->update(array('last_login'=>date('Y-m-d H:i:sa am/pm')));
    }

    // public function checkUser($username,$password){
    //     $query = $this->db->get_where('user',array('username'=> $username , 'password'=> $password));
    //     return $query;
    // }
}