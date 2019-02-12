<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    private $_table = "customer";

    public $customer_id;
    public $name;
    public $address;
    public $image = "default.jpg";

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'address',
            'label' => 'Address'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["customer_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->customer_id = uniqid();
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->customer_id = $post["id"];
        $this->name = $post["name"];
        $this->address = $post["address"];
        $this->db->update($this->_table, $this, array('customer_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("customer_id" => $id));
    }
}
