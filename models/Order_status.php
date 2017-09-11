<?php

class Order_status extends CI_model {

    function __construct() {
        parent::__construct();
    }

    public function fetch_all($id) {
        $query = $this->db->get_where("order_status",array("order_id"=>$id));
        $data = $query->result();
        return $data;
    }

    public function fetch_one($id) {
        $query = $this->db->get_where("order_status", array('id' => $id));
        $data = $query->result();
        return $data;
    }

    public function update($id, $data) {

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('order_status', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        }
        return 1;
    }

    public function delete($id) {
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->delete('order_status');
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        }
        return 1;
    }

    public function insert($data) {
        $this->db->trans_start();
        $this->db->insert('order_status', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 0;
        }
        return 1;
    }

}
