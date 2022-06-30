<?php

class Model_purchases extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the purchases data */
	public function getPurchasesData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM `purchases` WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `purchases` ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the purchases item data
	public function getPurchasesItemData($order_id = null)
	{
		if (!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM `orders_item` WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{
		$sql = "SELECT `code_purchases` FROM `company`";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$code_purchases = $result['code_purchases'];

		$user_id = $this->session->userdata('id');
		$purchase_no = $code_purchases . '-' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

		$id_order = $this->input->post('id_order');
		$paid_status = $this->input->post('paid_status');
		$net_amount = $this->input->post('net_amount_value');
		$amount_paid_value = $this->input->post('amount_paid');
		if ($paid_status == 1) {
			if ($amount_paid_value == $net_amount) {
				$amount_paid = $amount_paid_value;
				$unpaid_amount = 0;
			} else {
				$amount_paid = $amount_paid_value;
				$unpaid_amount = $net_amount - $amount_paid_value;
				$paid_status = 3;
			}
		} else {
			$amount_paid = 0;
			$unpaid_amount = $this->input->post('net_amount_value');
		}

		$data = array(
			'purchase_no' => $purchase_no,
			'order_id' => $id_order,
			'purchase_date' => $this->input->post('purchase_date'),
			'due_date' => $this->input->post('due_date'),
			'net_amount' => $net_amount,
			'paid_status' => $paid_status,
			'user_id' => $user_id,
			'amount_paid' => $amount_paid,
			'unpaid_amount' => $unpaid_amount,
			'created_at' => date('Y-m-d H:i:s')
		);

		$insert = $this->db->insert('purchases', $data);
		$purchase_id = $this->db->insert_id();

		// now the sales item 
		// first we will replace the product qty to original and subtract the qty again
		$this->load->model('model_products');
		$get_order_item = $this->getPurchasesItemData($id_order);
		foreach ($get_order_item as $k => $v) {
			$product_id = $v['product_id'];
			$qty = $v['qty'];
			// get the product 
			$product_data = $this->model_products->getProductData($product_id);
			$update_qty = $qty + $product_data['qty'];
			$update_product_data = array('qty' => $update_qty);

			// update the product qty
			$this->model_products->update($update_product_data, $product_id);
		}

		// now the change the order status 
		$this->load->model('model_orders');
		$orders = array(
			'order_status' => 1,
		);

		$this->model_orders->updateStatus($orders, $id_order);

		return ($purchase_id) ? $purchase_id : false;
	}

	public function countOrdersItem($order_id)
	{
		if ($order_id) {
			$sql = "SELECT * FROM `orders_item` WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if ($id) {
			$user_id = $this->session->userdata('id');
			// fetch the purchases data 
			$id_order = $this->input->post('id_order');
			$paid_status = $this->input->post('paid_status');
			$net_amount = $this->input->post('net_amount_value');
			$amount_paid_value = $this->input->post('amount_paid');
			if ($paid_status == 1) {
				if ($amount_paid_value == $net_amount) {
					$amount_paid = $amount_paid_value;
					$unpaid_amount = 0;
				} else {
					$amount_paid = $amount_paid_value;
					$unpaid_amount = $net_amount - $amount_paid_value;
					$paid_status = 3;
				}
			} else {
				$amount_paid = 0;
				$unpaid_amount = $this->input->post('net_amount_value');
			}

			$data = array(
				'purchase_date' => $this->input->post('purchase_date'),
				'due_date' => $this->input->post('due_date'),
				'paid_status' => $paid_status,
				'amount_paid' => $amount_paid,
				'unpaid_amount' => $unpaid_amount,
				'updated_at' => date('Y-m-d H:i:s')
			);

			$this->db->where('id', $id);
			$update = $this->db->update('purchases', $data);

			// now the change the order status 
			$this->load->model('model_orders');
			$orders = array(
				'order_status' => 2,
			);

			$this->model_orders->updateStatus($orders, $id_order);


			return true;
		}
	}

	public function remove($id)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('orders_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM `orders` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
}
