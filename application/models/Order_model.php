<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model
{
    private $_table = "orders";

    public $order_id;
    public $medic_id;
    public $user_id;
    public $order_amount;
    public $order_cost;

    // public function rules()
    // {
    //     return [
    //         ['field' => 'medic_name',
    //         'label' => 'Medic Name',
    //         'rules' => 'required'],

    //         ['field' => 'description',
    //         'label' => 'Description',
    //         'rules' => 'required'],
            
    //         ['field' => 'amount',
    //         'label' => 'Amount',
    //         'rules' => 'required']
    //     ];
    // }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["order_id" => $id])->row();
    }

    public function getByUserId($id) 
    {
        return $this->db->select("*")->from('orders')->join('users', 'users.user_id = orders.user_id')
                ->join('medicines', 'orders.medic_id = medicines.medic_id')->where('users.user_id', $id)
                ->get()->result_array();
    }

    public function getSumByUserId($id)
    {
        return $this->db->select("SUM(orders.order_cost) as total_costs")->from('orders')->join('users', 'users.user_id = orders.user_id')
          ->join('medicines', 'orders.medic_id = medicines.medic_id')->where('orders.setted=false')->where('users.user_id', $id)->group_by('users.user_id')
          ->get()->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->medic_id = $post["medic_id"];
        $this->user_id = $post["user_id"];
        $this->order_amount = $post["amount"];
        $this->order_cost = $post["cost"] * $post["amount"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        // $medic = $this->getById($post["id"]);
        $this->order_id = $post["id"];
        $this->medic_id = $post["medic_id"];
        $this->user_id = $post["user_id"];
        $this->order_amount = $post["amount"];
        $this->order_cost = $post["cost"] * $post["amount"];

        return $this->db->update($this->_table, $this, array('order_id' => $post['id']));
    }

    public function update_setted()
    {
        return $this->db->update($this->_table, array('setted' => 1), array('user_id' => $_SESSION['user_logged']->user_id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("order_id" => $id));
    }
}