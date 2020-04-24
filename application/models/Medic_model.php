<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Medic_model extends CI_Model
{
    private $_table = "medicines";

    public $medic_id;
    public $medic_name;
    public $description;
    public $amount;
    public $cost;

    public function rules()
    {
        return [
            ['field' => 'medic_name',
            'label' => 'Medic Name',
            'rules' => 'required'],

            ['field' => 'description',
            'label' => 'Description',
            'rules' => 'required'],
            
            ['field' => 'amount',
            'label' => 'Amount',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["medic_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->medic_name = $post["medic_name"];
        $this->description = $post["description"];
        $this->category = $post["category"];
        $this->amount = $post["amount"];
        $this->cost = $post["cost"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $medic = $this->getById($post["id"]);

        $this->medic_id = $post["id"];
        $this->medic_name = $post["medic_name"];
        $this->description = $post["description"];
        $this->category = $post["category"];
        $this->amount = $post["amount"];
        $this->cost = $post["cost"];

        return $this->db->update($this->_table, $this, array('medic_id' => $post['id']));
    }

    public function update_stock() 
    {
        $post = $this->input->post();

        $stock = $this->getById($post['medic_id']);

        if ($post['amount'] > $stock->amount) {
            return false;
        }

        $this->medic_id = $stock->medic_id;
        $this->medic_name = $stock->medic_name;
        $this->description = $stock->description;
        $this->category = $stock->category;
        $this->amount = $stock->amount - $post["amount"];
        $this->cost = $stock->cost;

        return $this->db->update($this->_table, $this, array('medic_id' => $stock->medic_id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("medic_id" => $id));
    }
}