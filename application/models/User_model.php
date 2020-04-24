<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "users";

    public $user_id;
    public $user_name;
    public $email;
    public $password;

    public function rules()
    {
        return [
            ['field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'required'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required'],
            
            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $check = $this->db->get_where($this->_table, ["email" => $post['email']])->row();

        if ($check) {
          return false;
        }
        
        $this->user_name = $post["user_name"];
        $this->email = $post["email"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $user = $this->getById($post["id"]);

        $this->user_id = $post["id"];
        $this->user_name = $post["user_name"];
        $this->email = $post["email"];
        if ($post["password"]) {
          $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        } else {
          $this->password = $user->password;
        }
        return $this->db->update($this->_table, $this, array('user_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("user_id" => $id));
    }

    public function doLogin(){
      $post = $this->input->post();
  
      // cari user berdasarkan email dan username
      $this->db->where('email', $post["email"])
              ->or_where('user_name', $post["email"]);
      $user = $this->db->get($this->_table)->row();

      // jika user terdaftar
      if($user){
        // periksa password-nya
        $isPasswordTrue = password_verify($post["password"], $user->password);
        // periksa role-nya
        $isAdmin = $user->is_admin == 1;

        // jika password benar dan dia admin
        if($isPasswordTrue){ 
          // login sukses yay!  
          $this->session->set_userdata(['user_logged' => $user]);
          // $this->_updateLastLogin($user->user_id);
          return true;
        }
      }
    
    // login gagal
    return false;
    }

    public function isNotLogin(){
      return $this->session->userdata('user_logged') === null;
    }
}