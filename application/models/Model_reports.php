<?php 

class Model_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*getting the total months*/
	private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}

	/* getting the year of the sales */
	public function getSalesYear()
	{
		$sql = "SELECT * FROM `sales` WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		$result = $query->result_array();
		
		$return_data = array();
		foreach ($result as $k => $v) {
			$date = date('Y', strtotime($v['date_time']));
			$return_data[] = $date;
		}

		$return_data = array_unique($return_data);

		return $return_data;
	}

	// getting the Sales reports based on the year and moths
	public function getSalesData($year, $status)
	{	
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `sales` WHERE paid_status = ?";
			$query = $this->db->query($sql, array($status));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['date_time']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	

			return $final_data;
		}
	}

	// getting the Purchases reports based on the year and moths
	public function getPurchasesData($year, $status)
	{	
		if($year) {
			$months = $this->months();
			
			$sql = "SELECT * FROM `purchases` WHERE paid_status = ?";
			$query = $this->db->query($sql, array($status));
			$result = $query->result_array();

			$final_data = array();
			foreach ($months as $month_k => $month_y) {
				$get_mon_year = $year.'-'.$month_y;	

				$final_data[$get_mon_year][] = '';
				foreach ($result as $k => $v) {
					$month_year = date('Y-m', strtotime($v['purchase_date']));

					if($get_mon_year == $month_year) {
						$final_data[$get_mon_year][] = $v;
					}
				}
			}	

			return $final_data;
		}
	}
}