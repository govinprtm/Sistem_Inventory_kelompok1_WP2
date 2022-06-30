<?php 

class Model_sales extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the sales data */
	public function getSalesData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM `sales` WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM `sales` ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the sales item data
	public function getSalesItemData($sales_id = null)
	{
		if(!$sales_id) {
			return false;
		}

		$sql = "SELECT * FROM `sales_item` WHERE sales_id = ?";
		$query = $this->db->query($sql, array($sales_id));
		return $query->result_array();
	}

	public function create()
	{
		$sql = "SELECT `code_sales` FROM `company`";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$code_sales = $result['code_sales'];

		$user_id = $this->session->userdata('id');
		$bill_no = $code_sales.'-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_name' => $this->input->post('customer_name'),
    		'customer_address' => $this->input->post('customer_address'),
    		'customer_phone' => $this->input->post('customer_phone'),
    		'date_time' => $this->input->post('date_time'),
			'due_date' => $this->input->post('due_date'),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('service_charge_rate'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
    		'net_amount' => $this->input->post('net_amount_value'),
    		'discount' => $this->input->post('discount'),
    		'paid_status' => 2,
    		'user_id' => $user_id,
			'created_at' => date('Y-m-d H:i:s')
    	);

		$insert = $this->db->insert('sales', $data);
		$sales_id = $this->db->insert_id();

		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
    		$items = array(
    			'sales_id' => $sales_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
    			'amount' => $this->input->post('amount_value')[$x],
    		);

    		$this->db->insert('sales_item', $items);

    		// now decrease the stock FROM `the` product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

    		$update_product = array('qty' => $qty);


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}

		return ($sales_id) ? $sales_id : false;
	}

	public function countSalesItem($sales_id)
	{
		if($sales_id) {
			$sql = "SELECT * FROM `sales_item` WHERE sales_id = ?";
			$query = $this->db->query($sql, array($sales_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the sales data 
			$paid_status = $this->input->post('paid_status');
			$net_amount = $this->input->post('net_amount_value');
			$amount_paid_value = $this->input->post('amount_paid');
			if ($paid_status == 1 ) {
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
				'customer_name' => $this->input->post('customer_name'),
	    		'customer_address' => $this->input->post('customer_address'),
	    		'customer_phone' => $this->input->post('customer_phone'),
				'date_time' => $this->input->post('date_time'),
				'due_date' => $this->input->post('due_date'),
	    		'gross_amount' => $this->input->post('gross_amount_value'),
	    		'service_charge_rate' => $this->input->post('service_charge_rate'),
	    		'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
	    		'vat_charge_rate' => $this->input->post('vat_charge_rate'),
	    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
	    		'net_amount' => $this->input->post('net_amount_value'),
	    		'discount' => $this->input->post('discount'),
	    		'paid_status' => $paid_status,
	    		'user_id' => $user_id,
				'amount_paid' => $amount_paid,
				'unpaid_amount' => $unpaid_amount,
				'updated_at' => date('Y-m-d H:i:s')
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('sales', $data);

			// now the sales item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_sales_item = $this->getSalesItemData($id);
			foreach ($get_sales_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['qty'];
				$update_product_data = array('qty' => $update_qty);
				
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the sales item data 
			$this->db->where('sales_id', $id);
			$this->db->delete('sales_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
	    		$items = array(
	    			'sales_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'rate' => $this->input->post('rate_value')[$x],
	    			'amount' => $this->input->post('amount_value')[$x],
	    		);
	    		$this->db->insert('sales_item', $items);

	    		// now decrease the stock FROM `the` product
	    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
	    		$qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

	    		$update_product = array('qty' => $qty);
	    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}

			return true;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('sales');

			$this->db->where('sales_id', $id);
			$delete_item = $this->db->delete('sales_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidSales()
	{
		$sql = "SELECT * FROM `sales` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

}