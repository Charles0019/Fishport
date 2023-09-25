<?php 

class Product_model extends CI_Model {

 function product_code()
	{
		$year = date('Y');

		$prefix = "P-";

		$query =  $this->db->query("SELECT max(product_code) as max_product_code FROM product where product_code LIKE '{$prefix}%'");
		$result = $query->row();


		if($result->max_product_code)
		{
			$next_product_code = ++$result->max_product_code;
		}else{
			$next_product_code = $prefix. '0001';
		}
		return $next_product_code;
	}

function insert_product($image_file_name)
{
    $product_code = (string) $this->input->post('product_code');
    $product_name = (string) $this->input->post('product_name');

    $data = array(
        'product_code' => $product_code,
        'product_name' => $product_name,
        'product_image' => $image_file_name,  // Add the image file name to the data array
    );

    $response = $this->db->insert('product', $data);

    if ($response) {
        return $this->db->insert_id();
    } else {
        return FALSE;
    }
}

	function get_all_product()
	{
		$this->db->where('isDelete','no');
		$query = $this->db->get('product'); 
		$result = $query->result();

		return $result;
	}
	
	function get_product($product_id)
	{
		$this->db->where('product_id' , $product_id);
		$query = $this->db->get('product');
		$row = $query->row();

		return $row;
	}
	function update_product()
	{
		$product_id = (int) $this->input->post('product_id');

		$product_code = (string) $this->input->post('product_code');
		$product_name = (string) $this->input->post('product_name');


		$data = array(
			'product_code' => $product_code,
			'product_name' => $product_name,
			'product_image' => $image_file_name,
			
    );

		$this->db->where('product_id', $product_id);

		$response = $this->db->update('product', $data);

		if ($response) {
			return $product_id;
		} else {
			return FALSE;
		}
	}
	 function delete_product($product_id)
	{
		$data = array(
			'isDelete'=>'yes');
		$this->db->where('product_id',$product_id);
		$response =$this->db->update('product',$data);
		if ($response) {
			return $product_id;
		}else{
			return false;
		}
	}	
}