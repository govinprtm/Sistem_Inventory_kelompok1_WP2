<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('model_products');
		$this->load->model('model_sales');
		$this->load->model('model_users');
		$this->load->model('model_stores');
		$this->load->model('model_reports');
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid sales, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
		$this->data['total_products'] = $this->model_products->countTotalProducts();
		$this->data['total_paid_sales'] = $this->model_sales->countTotalPaidSales();
		$this->data['total_users'] = $this->model_users->countTotalUsers();
		$this->data['total_stores'] = $this->model_stores->countTotalStores();

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;
		$this->data['is_admin'] = $is_admin;
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}
		
		//Sales Total Year
		$parking_data = $this->model_reports->getSalesData($today_year, 1);
		$final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['gross_amount'];						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
		}

		//Unpaid Sales
		$sales_data = $this->model_reports->getSalesData($today_year, 2);
		$unpaid_sales_data = array();
		foreach ($sales_data as $k => $v) {
			if(count($v) > 1) {
				$total_unpaid_amount = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_unpaid_amount[] = $v2['unpaid_amount'];						
					}
				}
				$unpaid_sales_data[$k] = array_sum($total_unpaid_amount);	
			}
			else {
				$unpaid_sales_data[$k] = 0;	
			}
		}

		//Unpaid Purchases
		$unpaid_purchase = $this->model_reports->getPurchasesData($today_year, 2);
		$unpaid_purchases_data = array();
		foreach ($unpaid_purchase as $k => $v) {
			if(count($v) > 1) {
				$total_amount = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_unpaid_amount[] = $v2['unpaid_amount'];						
					}
				}
				$unpaid_purchases_data[$k] = array_sum($total_unpaid_amount);	
			}
			else {
				$unpaid_purchases_data[$k] = 0;	
			}
		}

		$this->data['report_years'] = $this->model_reports->getSalesYear();
		$this->data['selected_year'] = $today_year;
		$this->data['company_currency'] = $this->company_currency();
		$this->data['results'] = $final_parking_data;
		$this->data['unpaid_sales'] = $unpaid_sales_data;
		$this->data['unpaid_purchases'] = $unpaid_purchases_data;
		$this->render_template('dashboard', $this->data);
	}
}