<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller {

	function index()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/dashboard',$this->data);
		$this->load->view('main/footer');
	}
	
	function user()
	{
		$this->load->model('user_model');
		$this->data['result'] = $this->user_model->get_all_users();
		$this->load->view('main/header');
		$this->load->view('main/user',$this->data);
		$this->load->view('main/footer');
	}

	function add_user()
	{

		$this->add_user_submit();
		$this->load->view('main/header');
		$this->load->view('main/add_user');
		$this->load->view('main/footer');
	}
	function add_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD']=='POST') 
		{
			$this->form_validation->set_rules('username','username','trim|required|is_unique[user.username]');
			$this->form_validation->set_rules('first_name', 'first_name', 'trim|required|is_unique[user.first_name]', array('is_unique' => 'The username is already taken.'));
			$this->form_validation->set_rules('last_name','last_name','trim|required|is_unique[user.last_name]');
			$this->form_validation->set_rules('password','password','trim|required');
			$this->form_validation->set_rules('role','role','trim|required');

			if($this->form_validation->run()!=FALSE)
			{
				$this->load->model('user_model');
				$response = $this->user_model->insert1();
				if ($response)
				{
					$success_message = 'User added successfully.';
					$this->session->set_flashdata('success', $success_message);
				}
				else
				{
					$error_message = 'User was not added.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}

	}

	function edit_user($user_id)
	{ 	
		$this->edit_user_submit();
		$this->load->model('user_model');
		$this->data['user'] = $this->user_model->get_users($user_id);

		$this->load->view('main/header');
		$this->load->view('main/edituser',$this->data);
		$this->load->view('main/footer');
	}
	function edit_user_submit()
	{
		if ($_SERVER['REQUEST_METHOD']=='POST') 
		{
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			$this->form_validation->set_rules('password1', 'Confirm New Password', 'required|matches[password]');
			$this->form_validation->set_rules('role','role','trim|required');

			if($this->form_validation->run()!=FALSE)
			{
				$this->load->model('user_model');

				$response = $this->user_model->update_user();

				if ($response) 
				{
					$success_message = 'User updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				}
				else
				{
					$error_message = 'User was not updated successfully.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/user');
			}
		}

	}
	function delete_user($user_id)
	{
		$this->load->model('user_model');
		$response = $this->user_model->delete_user($user_id);

		if ($response) 
		{
			$success_message = 'User deleted successfully.';
			$this->session->set_flashdata('success', $success_message);

		}
		else
		{
			$error_message = 'User was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/user');
	}

	function product()
	{
		$this->load->model('product_model');
		$this->data['result'] = $this->product_model->get_all_product();
		$this->load->view('main/header');
		$this->load->view('main/product' ,$this->data);
		$this->load->view('main/footer');
	}

	function add_product()
	{
		$this->add_product_submit();
		$this->load->model('product_model');
		$this->data['product_code'] = $this->product_model->product_code();
		$this->load->view('main/header');
		$this->load->view('main/add_product',$this->data);
		$this->load->view('main/footer');
	}
	function add_product_submit()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $this->form_validation->set_rules('product_code', 'Product Code', 'trim|required|is_unique[product.product_code]');
        $this->form_validation->set_rules('product_name', 'Product Name', 'trim|required|is_unique[product.product_name]', array('is_unique' => 'The Product Name is already taken.'));
        
        if ($this->form_validation->run() != FALSE)
        {
            $config['upload_path']   = './assets/images/';  // Set the upload directory
            $config['allowed_types'] = 'jpg|jpeg|png|gif';  // Allowed file types
            $config['max_size']      = 2048;  // Maximum file size in kilobytes
            $config['encrypt_name']  = TRUE;  // Encrypt the file name for security

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('product_image')) 
            {
                $image_data = $this->upload->data();

                // Generate a unique filename based on the product name
                $product_name = $this->input->post('product_name');
                $product_code = $this->input->post('product_code');
                $unique_filename = strtolower(str_replace(' ', '_', $product_name)) . '_' . $product_code . '_' . time() . $image_data['file_ext'];

                // Rename the uploaded file to the unique filename
                $new_path = './assets/images/' . $unique_filename;
                rename($image_data['full_path'], $new_path);

                // Now, you can save $unique_filename into your database.
                // Make sure you have a column in your database table to store the file name.

                $this->load->model('product_model');
                $response = $this->product_model->insert_product($unique_filename);  // Pass the unique filename to the model

                if ($response)
                {
                    $success_message = 'Product added successfully.';
                    $this->session->set_flashdata('success', $success_message);
                }
                else
                {
                    $error_message = 'Product was not added.';
                    $this->session->set_flashdata('error', $error_message);
                }
            }
            else
            {
                $error_message = 'Image upload failed: ' . $this->upload->display_errors();
                $this->session->set_flashdata('error', $error_message);
            }

            redirect('main/product');
        }
    }
}
	


	function edit_product($product_id)
	{ 	
		$this->edit_product_submit();
		$this->load->model('product_model');
		$this->data['product'] = $this->product_model->get_product($product_id);

		$this->load->view('main/header');
		$this->load->view('main/editproduct',$this->data);
		$this->load->view('main/footer');
	}
	function edit_product_submit()
	{
		if ($_SERVER['REQUEST_METHOD']=='POST') 
		{
			$this->form_validation->set_rules('product_code','Product Code','trim|required');
			$this->form_validation->set_rules('product_name','Product Name','trim|required');

			if($this->form_validation->run()!=FALSE)
			{
				$this->load->model('product_model');

				$response = $this->product_model->update_product();

				if ($response) 
				{
					$success_message = 'Product updated successfully.';
					$this->session->set_flashdata('success', $success_message);
				}
				else
				{
					$error_message = 'Product was not updated successfully.';
					$this->session->set_flashdata('error', $error_message);
				}
				redirect('main/product');
			}
		}

	}
	function delete_product($product_id)
	{
		$this->load->model('product_model');
		$response = $this->product_model->delete_product($product_id);

		if ($response) 
		{
			$success_message = 'Product deleted successfully.';
			$this->session->set_flashdata('success', $success_message);

		}
		else
		{
			$error_message = 'Product was not deleted successfully.';
			$this->session->set_flashdata('error', $error_message);
		}

		redirect('main/product');
	}

	function customer()
	{
		$this->load->model('customer_model');
		$this->data['result'] = $this->customer_model->get_all_customers();
		$this->load->view('main/header');
		$this->load->view('main/dashboard', $this->data);
		$this->load->view('main/footer');
	}

	function dashbaord()
	{

		$this->submit_walkin_order();
		$this->load->view('main/header');
		$this->load->view('main/dashbaord');
		$this->load->view('main/footer');
	}


    public function submit_walkin_order() {
        // Retrieve form data from POST request
        $customer_fname = $this->input->post('customer_fname');
        $customer_lname = $this->input->post('customer_lname');
        $contact_no = $this->input->post('contact_no');
        $payment_method = $this->input->post('payment_method');

        // Insert the form data into the 'customer' table
        $data = array(
            'customer_fname' => $customer_fname,
            'customer_lname' => $customer_lname,
            'contact_no' => $contact_no,
            'payment_method' => $payment_method,
        );

        $this->db->insert('customer', $data);

        // You can also add additional logic here, such as sending a response or redirecting.

        // Example response (you can customize this):
        $response = array(
            'status' => 'success',
            'message' => 'Order placed successfully.',
        );

        echo json_encode($response);
    }



	
}


// application/controllers/OrderController.php

class OrderController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load the necessary model
        $this->load->model('OrderModel');
    }

    public function placeOrder() {
        // Get data from the form
        $customerData = array(
            'first_name' => $this->input->post('customer_fname'),
            'last_name' => $this->input->post('customer_lname'),
            'contact_number' => $this->input->post('contact_no'),
            'payment_method' => $this->input->post('payment_method')
        );

        // Insert customer data into the database
        $customerId = $this->OrderModel->insertCustomer($customerData);

        if ($customerId) {
            // Insert order data into the database (you will need to adapt this to your data structure)
            $orderData = array(
                'customer_id' => $customerId,
                'total_amount' => $this->input->post('total_amount'),
                // Add other order details here
            );

            $orderId = $this->OrderModel->insertOrder($orderData);

            if ($orderId) {
                // Insert order items into the database (loop through your cart items)
                foreach ($this->input->post('cart_items') as $cartItem) {
                    $orderItemData = array(
                        'order_id' => $orderId,
                        'product_name' => $cartItem['product_name'],
                        'weight' => $cartItem['weight'],
                        'price' => $cartItem['price'],
                        // Add other item details here
                    );

                    $this->OrderModel->insertOrderItem($orderItemData);
                }
            }

            // Redirect to a success page or do something else
        } else {
            // Handle the case where customer insertion failed
        }
    }
}
