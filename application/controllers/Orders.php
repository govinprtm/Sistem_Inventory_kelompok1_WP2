<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Order Barang';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_stores');
	}

	function Ribuan($angka)
	{
		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	/* 
	* It only redirects to the manage orders page
	*/
	public function index()
	{
		if (!in_array('viewOrders', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Order Barang';
		$this->render_template('orders/index', $this->data);
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrdersItem($value['id']);

			$order_date = date('d/m/Y', strtotime($value['order_date']));

			$order_no = '<a href="' . base_url('orders/update/' . $value['id']) . '">' . $value['order_no'] . '</a>';
			// button
			$buttons = '';

			/* if (in_array('viewOrders', $this->permission)) {
				$buttons .= '<a target="__blank" href="' . base_url('orders/printDiv/' . $value['id']) . '" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>';
			} */

			/* if (in_array('updateOrders', $this->permission)) {
				$buttons .= ' <a href="' . base_url('orders/update/' . $value['id']) . '" class="btn //btn-default btn-sm"><i class="fa fa-edit"></i></a>';
			} */

			if (in_array('deleteOrders', $this->permission)) {
				if ($value['order_status'] != 1) {
					$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
				} else {
					$buttons .= ' <button type="button" class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>';
				}
			}

			if ($value['order_status'] == 1) {
				$order_status = '<small class="text-success">Selesai</small>';
			} else {
				$order_status = '<small class="text-danger">Belum Pembelian</small>';
			}

			$result['data'][$key] = array(
				$order_no,
				$value['supplier'],
				$order_date,
				$count_total_item,
				$order_status,
				$this->Ribuan($value['net_amount']),
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if (!in_array('createOrders', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Order Barang Baru';

		$this->form_validation->set_rules('store_id', 'Supplier', 'trim|required');
		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		$this->form_validation->set_rules('qty[]', 'Qty', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

			$order_id = $this->model_orders->create();

			if ($order_id) {
				$this->session->set_flashdata('success', '<i class="fas fa-check-circle"></i> Berhasil dibuat');
				redirect('orders/update/' . $order_id, 'refresh');
			} else {
				$this->session->set_flashdata('errors', '<i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!!');
				redirect('orders/create/', 'refresh');
			}
		} else {
			// false case
			$company = $this->model_company->getCompanyData(1);
			$this->data['company_data'] = $company;
			$this->data['products'] = $this->model_products->getActiveProductData();
			$this->data['suppliers'] = $this->model_stores->getActiveStore();
			$this->render_template('orders/create', $this->data);
		}
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if ($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the orders page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if (!in_array('updateOrders', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if (!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Edit Order Barang';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');


		if ($this->form_validation->run() == TRUE) {

			$update = $this->model_orders->update($id);

			if ($update == true) {
				$this->session->set_flashdata('success', '<i class="fas fa-check-circle"></i> Berhasil diubah');
				redirect('orders/update/' . $id, 'refresh');
			} else {
				$this->session->set_flashdata('errors', '<i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!!');
				redirect('orders/update/' . $id, 'refresh');
			}
		} else {
			// false case
			$company = $this->model_company->getCompanyData(1);
			$this->data['company_data'] = $company;

			$result = array();
			$orders_data = $this->model_orders->getOrdersData($id);

			$result['orders'] = $orders_data;
			$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

			foreach ($orders_item as $k => $v) {
				$result['orders_item'][] = $v;
			}

			$this->data['orders_data'] = $result;

			$this->data['products'] = $this->model_products->getActiveProductData();
			$this->data['suppliers'] = $this->model_stores->getActiveStore();

			$this->render_template('orders/edit', $this->data);
		}
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if (!in_array('deleteSales', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$sales_id = $this->input->post('sales_id');

		$response = array();
		if ($sales_id) {
			$delete = $this->model_saless->remove($sales_id);
			if ($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Berhasil dihapus";
			} else {
				$response['success'] = false;
				$response['messages'] = "Kesalahan dalam database saat menghapus informasi produk";
			}
		} else {
			$response['success'] = false;
			$response['messages'] = "Segarkan halaman lagi !!";
		}

		echo json_encode($response);
	}

	/*
	* It gets the product id and fetch the sales data. 
	* The sales print logic is done here 
	*/
	public function printDiv($id)
	{
		if (!in_array('viewSales', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if ($id) {
			$sales_data = $this->model_sales->getSalesData($id);
			$sales_items = $this->model_sales->getSalesItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$sales_date = date('d/m/Y', strtotime($sales_data['date_time']));
			if ($sales_data['paid_status'] == 1) {
				$status =  "Lunas";
			} else if ($sales_data['paid_status'] == 2) {
				$status = "Belum Dibayar";
			} else {
				$status = "Bayar Sebagian";
			};

			$paid_status = $status;

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta name="viewport" content="width=device-width, initial-scale=1">
			  
			<!-- Google Font: Source Sans Pro -->
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="' . base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') . '">
			  <link rel="stylesheet" href="' . base_url('assets/adminlte/dist/css/adminlte.min.css') . '">
			</head>
			<body onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-12">
			        <h3 class="page-header">
			          ' . $company_info['company_name'] . '
					</h3>
				  </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info mb-2">
				  <div class="col-9 invoice-col">
				  <h6 class="page-header">
					' . $company_info['address'] . '<br/>
					No. Telepon: ' . $company_info['phone'] . '<br/><br/>
					Mata Uang: ' . $company_info['currency'] . '
					</h6>
				  </div>
			      <div class="col-3 invoice-col">
				  	<b>Tanggal:</b> ' . $sales_date . '<br/>
			        <b>No. Invoice:</b> ' . $sales_data['bill_no'] . '<br/>
			        <b>Nama:</b> ' . $sales_data['customer_name'] . ' / ' . $sales_data['customer_address'] . ' <br />
			        <b>Telepon:</b> ' . $sales_data['customer_phone'] . '
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <!-- Table row -->
			    <div class="row">
			      <div class="col-12 table-responsive">
			        <table class="table table-striped table-bordered">
			          <thead>
			          <tr>
			            <th>Nama Produk</th>
			            <th>Harga</th>
			            <th>Qty</th>
			            <th>Total</th>
			          </tr>
			          </thead>
			          <tbody>';

			foreach ($sales_items as $k => $v) {

				$product_data = $this->model_products->getProductData($v['product_id']);

				$html .= '<tr>
				            <td>' . $product_data['name'] . '</td>
				            <td>' . $v['rate'] . '</td>
				            <td>' . $v['qty'] . '</td>
				            <td>' . $v['amount'] . '</td>
			          	</tr>';
			}

			$html .= '</tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-5 ml-auto">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:40%">Jumlah:</th>
			              <td>' . $sales_data['gross_amount'] . '</td>
			            </tr>';

			if ($sales_data['service_charge'] > 0) {
				$html .= '<tr>
				              <th>Biaya Layanan (' . $sales_data['service_charge_rate'] . '%)</th>
				              <td>' . $sales_data['service_charge'] . '</td>
				            </tr>';
			}

			if ($sales_data['vat_charge'] > 0) {
				$html .= '<tr>
				              <th>PPN (' . $sales_data['vat_charge_rate'] . '%)</th>
				              <td>' . $sales_data['vat_charge'] . '</td>
				            </tr>';
			}


			$html .= ' <tr>
			              <th>Diskon:</th>
			              <td>' . $sales_data['discount'] . '</td>
			            </tr>
			            <tr>
			              <th>Total Harga:</th>
			              <td>' . $sales_data['net_amount'] . '</td>
			            </tr>
			            <tr>
			              <th>Status Bayar:</th>
			              <td>' . $paid_status . '</td>
			            </tr>
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			echo $html;
		}
	}
}
