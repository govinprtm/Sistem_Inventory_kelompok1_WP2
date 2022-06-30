<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Penjualan';

		$this->load->model('model_sales');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	function Ribuan($angka)
	{
		$hasil_rupiah = number_format($angka, 0, ',', '.');
		return $hasil_rupiah;
	}

	/* 
	* It only redirects to the manage sales page
	*/
	public function index()
	{
		if (!in_array('viewSales', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Penjualan';
		$this->render_template('sales/index', $this->data);
	}

	/*
	* Fetches the sales data from the sales table 
	* this function is called from the datatable ajax function
	*/
	public function fetchSalesData()
	{
		$result = array('data' => array());

		$data = $this->model_sales->getSalesData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_sales->countSalesItem($value['id']);

			$date_time = date('d/m/Y', strtotime($value['date_time']));
			$due_date = date('d/m/Y', strtotime($value['due_date']));

			$inv_number = '<a href="' . base_url('sales/update/' . $value['id']) . '">'.$value['bill_no'].'</a>';
			// button
			$buttons = '';

			if (in_array('viewSales', $this->permission)) {
				$buttons .= '<a target="__blank" href="' . base_url('sales/printDiv/' . $value['id']) . '" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>';
			}

			//if (in_array('updateSales', $this->permission)) {
				//$buttons .= ' <a href="' . base_url('sales/update/' . $value['id']) . '" class="btn //btn-default btn-sm"><i class="fa fa-edit"></i></a>';
			//}

			if (in_array('deleteSales', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(' . $value['id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if ($value['paid_status'] == 1) {
				$paid_status = '<small class="text-success">Lunas</small>';
			} else if ($value['paid_status'] == 2) {
				$paid_status = '<small class="text-danger">Belum Dibayar</small>';
			} else {
				$paid_status = '<small class="text-warning">Dibayar Sebagian</small>';
			}

			$result['data'][$key] = array(
				$inv_number,
				$value['customer_name'] . '/' . $value['customer_address'] . '<br/>' . $value['customer_phone'],
				$date_time,
				//$count_total_item,
				$due_date,
				$paid_status,
				$this->Ribuan($value['unpaid_amount']),
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
		if (!in_array('createSales', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Penjualan Baru';

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		$this->form_validation->set_rules('qty[]', 'Qty', 'trim|required');

		if ($this->form_validation->run() == TRUE) {

			$sales_id = $this->model_sales->create();

			if ($sales_id) {
				$this->session->set_flashdata('success', '<i class="fas fa-check-circle"></i> Berhasil dibuat');
				redirect('sales/update/' . $sales_id, 'refresh');
			} else {
				$this->session->set_flashdata('errors', '<i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!!');
				redirect('sales/create/', 'refresh');
			}
		} else {
			// false case
			$company = $this->model_company->getCompanyData(1);
			$this->data['company_data'] = $company;
			$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
			$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

			$this->data['products'] = $this->model_products->getActiveProductData();

			$this->render_template('sales/create', $this->data);
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
	* This function is used in the sales page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit sales page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if (!in_array('updateSales', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		if (!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Edit Penjualan';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');


		if ($this->form_validation->run() == TRUE) {

			$update = $this->model_sales->update($id);

			if ($update == true) {
				$this->session->set_flashdata('success', '<i class="fas fa-check-circle"></i> Berhasil diubah');
				redirect('sales/update/' . $id, 'refresh');
			} else {
				$this->session->set_flashdata('errors', '<i class="fas fa-exclamation-circle"></i> Terjadi kesalahan!!');
				redirect('sales/update/' . $id, 'refresh');
			}
		} else {
			// false case
			$company = $this->model_company->getCompanyData(1);
			$this->data['company_data'] = $company;
			$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
			$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

			$result = array();
			$sales_data = $this->model_sales->getSalesData($id);

			$result['sales'] = $sales_data;
			$sales_item = $this->model_sales->getSalesItemData($sales_data['id']);

			foreach ($sales_item as $k => $v) {
				$result['sales_item'][] = $v;
			}

			$this->data['sales_data'] = $result;

			$this->data['products'] = $this->model_products->getActiveProductData();

			$this->render_template('sales/edit', $this->data);
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
				$status =  "Lunas" ;
			} else if ($sales_data['paid_status'] == 2) { 
				$status = "Belum Dibayar" ;
			} else { 
				$status = "Bayar Sebagian" ;
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
