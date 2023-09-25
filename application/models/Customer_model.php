<?php 

class Customer_model extends CI_Model {

	function get_all_customers()
	{
		
		$query = $this->db->get('customer'); 
		$result = $query->result();

		return $result;
	}


 function account_no()
	{
		$year = date('Y');

		$prefix = "C-";

		$query =  $this->db->query("SELECT max(account_no) as max_account_no FROM customer where account_no LIKE '{$prefix}%'");
		$result = $query->row();


		if($result->max_account_no)
		{
			$next_account_no = ++$result->max_account_no;
		}else{
			$next_account_no = $prefix. '0001';
		}
		return $next_account_no;
	}

	


	
}

// application/models/OrderModel.php

class OrderModel extends CI_Model {
    public function insertCustomer($data) {
        $this->db->insert('customer_table', $data); // Replace 'customer_table' with your actual table name
        return $this->db->insert_id();
    }

    public function insertOrder($data) {
        $this->db->insert('order_table', $data); // Replace 'order_table' with your actual table name
        return $this->db->insert_id();
    }

    public function insertOrderItem($data) {
        $this->db->insert('order_item_table', $data); // Replace 'order_item_table' with your actual table name
    }
}
