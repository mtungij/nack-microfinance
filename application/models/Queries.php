<?php
class Queries extends CI_Model {
	public function insert_region($data){
		return $this->db->insert('tbl_region',$data);
	}

	public function get_loan_start_penart($loan_id){
		$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
		 return $data->row();
	}

	public function update_penart($loan_id,$penat_status){
		return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$penat_status);
	}

  public function insert_penalt_reason($data){
  	return $this->db->insert('tbl_penart_leason',$data);
  }
	
	public function get_region(){
		$data = $this->db->query("SELECT * FROM tbl_region");
		  return $data->result();
	}

	public function insert_company_data($data) {
    $this->db->insert('tbl_company', $data);
    return $this->db->insert_id(); // ✅ This returns the correct auto-incremented comp_id
}

public function get_company_info()
{
    return $this->db->limit(1)->get('tbl_company')->row();
}

public function get_company_by_id($comp_id)
{
    return $this->db
        ->where('comp_id', $comp_id)
        ->limit(1)
        ->get('tbl_company')
        ->row();
}

public function get_employee_by_phone($phone)
{
    return $this->db->where('empl_no', $phone)->get('tbl_employee')->row();
}




public function check_region_code($code){
    return $this->db->get_where('tbl_region', ['region_code' => $code])->row();
}

public function get_branches_with_region() {
    $this->db->select('blanch_id as branch_id, b.blanch_name, b.branch_code, b.blanch_no, r.region_name');
    $this->db->from('tbl_blanch b');
    $this->db->join('tbl_region r', 'r.region_id = b.region_id', 'left'); // tumia region_id sahihi
    return $this->db->get()->result();
}


 public function get_branches_by_company($comp_id)
{
    $this->db->where('comp_id', $comp_id);
    $query = $this->db->get('tbl_blanch');
    return $query->result();
}


public function get_disbursed_loans($comp_id, $from_date = null, $to_date = null, $blanch_id = null)
{
    $this->db->select('l.*, b.blanch_name, c.f_name, c.m_name, c.l_name, c.phone_no, e.empl_name');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->where('l.comp_id', $comp_id);

    if (!empty($from_date)) {
        $this->db->where('DATE(l.disburse_day) >=', $from_date);
    }
    if (!empty($to_date)) {
        $this->db->where('DATE(l.disburse_day) <=', $to_date);
    }
    if (!empty($blanch_id)) {
        $this->db->where('l.blanch_id', $blanch_id);
    }

    return $this->db->get()->result();
}



public function count_regions_by_prefix($prefix){
    $this->db->like('region_code', $prefix, 'after');
    return $this->db->count_all_results('tbl_region');
}


	public function insert_blanch($data){
		return $this->db->insert('tbl_blanch',$data);
	}

	public function get_blanch($comp_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch JOIN tbl_region ON tbl_region.region_id = tbl_blanch.region_id WHERE comp_id = '$comp_id'");
		return $blanch->result();
	}


	public function get_blanchMyBlanch($blanch_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch JOIN tbl_region ON tbl_region.region_id = tbl_blanch.region_id WHERE blanch_id = '$blanch_id'");
		return $blanch->result();
	}


public function insert_shareHolder($data){
	return $this->db->insert('tbl_share_holder',$data);
}


public function get_shareHolder($comp_id){
	$share = $this->db->query("SELECT * FROM tbl_share_holder WHERE comp_id = '$comp_id'");
	 return $share->result();
}

public function insert_capital($data){
	return $this->db->insert('tbl_capital',$data);
}


public function get_capital($comp_id){
	$cap = $this->db->query("SELECT * FROM tbl_capital c JOIN tbl_share_holder s ON s.share_id = c.share_id JOIN tbl_account_transaction at ON at.trans_id = c.pay_method  WHERE c.comp_id = '$comp_id'");
	  return $cap->result();
}



public function get_total_capital($comp_id){
	 $total = $this->db->query("SELECT SUM(amount) AS totalCapital FROM tbl_capital WHERE comp_id = '$comp_id'");
	  return $total->row();
}

public function insert_position($data){
	return $this->db->insert('tbl_position',$data);
}

public function get_position(){
	$pos = $this->db->query("SELECT * FROM tbl_position");
	 return $pos->result();
}

public function update_employee_links($employee_id, $link_ids)
{
    // Clear current permissions
    $this->db->where('employee_id', $employee_id);
    $this->db->delete('tbl_permission');

    // Add selected ones
    if (!empty($link_ids)) {
        foreach ($link_ids as $link_id) {
            $this->db->insert('tbl_permission', [
                'employee_id' => $employee_id,
                'link_id'     => $link_id
            ]);
        }
    }
}


public function get_employee_link_ids($employee_id)
{
    $this->db->select('link_id');
    $this->db->from('tbl_permission');
    $this->db->where('employee_id', $employee_id);
    $query = $this->db->get()->result();

    return array_column($query, 'link_id'); // returns array of IDs
}


public function update_position($data,$position_id){
	return $this->db->where('position_id',$position_id)->update('tbl_position',$data);
}

public function remove_position($position_id){
	return $this->db->delete('tbl_position',['position_id'=>$position_id]);
}

public function update_blanch($data, $blanch_id){
    if (!$blanch_id) {
        return false;
    }

    // pata current branch
    $current_branch = $this->db->get_where('tbl_blanch', ['blanch_id' => $blanch_id])->row();
    if (!$current_branch) {
        return false;
    }

    // kama region_id imebadilika, generate branch_code mpya
    if ($current_branch->region_id != $data['region_id']) {
        $region = $this->db->get_where('tbl_region', ['region_id' => $data['region_id']])->row();
        if (!$region) return false;

        $region_code = $region->region_code;

        // hesabu idadi ya matawi ndani ya region hii
        $this->db->where('region_id', $data['region_id']);
        $count = $this->db->count_all_results('tbl_blanch');

        // generate branch_code mpya
        $data['branch_code'] = $region_code . '-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
    }

    return $this->db->where('blanch_id', $blanch_id)->update('tbl_blanch', $data);
}


public function remove_blanch($blanch_id){
	return $this->db->delete('tbl_blanch',['blanch_id'=>$blanch_id]);
}


public function update_shareHolder($data,$share_id){
	return $this->db->where('share_id',$share_id)->update('tbl_share_holder',$data);
}

public function remove_shareHolder($share_id){
	return $this->db->delete('tbl_share_holder',['share_id'=>$share_id]);
}

public function insert_employee($data)
{
    $this->db->insert('tbl_employee', $data);
    return $this->db->insert_id();      // ← returns the new empl_id
}

public function get_employee($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e LEFT JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id LEFT JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC LIMIT 2");
	  return $empl->result();
}

public function employee_data($phone, $password)
{
    $this->db->where('empl_phone', $phone); // Match the phone number
    $this->db->where('password', $password); // Match the password
    $query = $this->db->get('tbl_employee'); // Query the `tbl_employee` table
    return $query->row(); // Return the first matching row as an object
}


public function get_Allemployee($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC");
	  return $empl->result();
}

public function get_AllemployeeBlanch($blanch_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.blanch_id = '$blanch_id' AND e.ac_status = 'empl' ORDER BY e.empl_id DESC");
	  return $empl->result();
}




public function view_employee($empl_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE e.empl_id = '$empl_id'");
	  return $empl->row();
}

public function get_myprivillage($empl_id){
	$data = $this->db->query("SELECT * FROM tbl_privellage pr JOIN tbl_position p ON p.position_id = pr.position_id WHERE pr.empl_id = '$empl_id'");
	return $data->result();
}

public function get_blanchEmployee($blanch_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.blanch_id = '$blanch_id' ORDER BY e.empl_id DESC");
	 return $empl->result();
}

public function insert_leave($data){
	return $this->db->insert('tbl_leave',$data);
}

public function get_all_leave($comp_id){
	$leave = $this->db->query("SELECT * FROM tbl_leave l JOIN tbl_employee e ON e.empl_id = l.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE l.comp_id = '$comp_id'");
	   return $leave->result();
}

public function insert_loanCategory($data){
	return $this->db->insert('tbl_loan_category',$data);
}

public function get_loancategory($comp_id){
	$loan = $this->db->query("SELECT * FROM tbl_loan_category WHERE comp_id = '$comp_id'");
	 return $loan->result();
}

public function get_loancategoryData($category_id){
	$loan = $this->db->query("SELECT * FROM tbl_loan_category WHERE category_id = '$category_id'");
	 return $loan->row();
}

public function insert_customer($data){
	$this->db->insert('tbl_customer',$data);
	 return $this->db->insert_id();
}

public function get_admin_role($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
	 return $data->row();
}


public function get_customer_data($customer_id){
	$customer = $this->db->query("SELECT c.customer_id,c.blanch_id,c.f_name,c.l_name,c.m_name,c.comp_id,c.customer_code,c.empl_id,c.gender,e.empl_id,e.empl_name,c.customer_day,c.phone_no FROM tbl_customer c LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id'");
	  return $customer->row();
}

public function get_customerDataLOANform($customer_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id  WHERE c.customer_id = $customer_id");
	  return $customer->row();
}

public function insert_customerData($data){
	return $this->db->insert('tbl_sub_customer',$data);
}

public function get_allcutomer($comp_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_cutomerBlanchData($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_customer_blanch($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function get_customers_by_officer($empl_id) {
		return $this->db->query("
			SELECT * FROM tbl_customer c
			LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id
			LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id
			LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id
			WHERE c.empl_id = ?
			ORDER BY c.customer_id DESC
		", [$empl_id])->result();
	}
	
	public function count_customers_by_officer($empl_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_customers
			FROM tbl_customer
			WHERE empl_id = ?
		", [$empl_id]);
	
		return $query->row()->total_customers;
	}

	public function count_active_customers_by_officer($empl_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON c.customer_id = l.customer_id
        WHERE c.empl_id = ?
        AND l.loan_status = 'withdrawal'
    ", [$empl_id]);

    return $query->row()->total_customers;
}


	public function count_customers_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_customers
			FROM tbl_customer
			WHERE blanch_id = ?
		", [$blanch_id]);
	
		return $query->row()->total_customers;
	}

	public function count_active_customers_by_branch($blanch_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON c.customer_id = l.customer_id
        WHERE c.blanch_id = ?
        AND l.loan_status = 'withdrawal'
    ", [$blanch_id]);

    return $query->row()->total_customers;
}


public function count_default_customers_by_officer($empl_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON c.customer_id = l.customer_id
        WHERE c.empl_id = ?
        AND l.loan_status = 'out'
    ", [$empl_id]);

    return $query->row()->total_customers;
}


public function count_default_customers_by_branch($blanch_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON c.customer_id = l.customer_id
        WHERE c.blanch_id = ?
        AND l.loan_status = 'out'
    ", [$blanch_id]);

    return $query->row()->total_customers;
}




	public function count_active_by_officer($empl_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_active 
			FROM tbl_customer 
			WHERE empl_id = ? AND customer_status = 'open'
		", [$empl_id]);
		return $query->row()->total_active;
	}
	
	public function count_active_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_active 
			FROM tbl_customer 
			WHERE blanch_id = ? AND customer_status = 'open'
		", [$blanch_id]);
		return $query->row()->total_active;
	}

	public function get_today_registered_customers_count($comp_id) {
		$this->db->where('reg_date', date('Y-m-d'));
		$this->db->where('comp_id', $comp_id);
		return $this->db->count_all_results('tbl_customer'); // Returns count directly
	}

	public function count_by_company($comp_id)
    {
        return $this->db->where('comp_id', $comp_id)
                        ->from('tbl_customer')
                        ->count_all_results();
    }

	public function count_completed_today($comp_id)
    {
        $today = date('Y-m-d'); // Format should match your `date_show` column

        return $this->db
            ->where('loan_status', 'done')
            ->where('comp_id', $comp_id)
            ->where('DATE(date_show)', $today)
            ->from('tbl_loans')
            ->count_all_results();
    }

	public function count_default_loans_today($comp_id)
{
    $today = date('Y-m-d');

    return $this->db
        ->where('loan_status', 'out')
        ->where('comp_id', $comp_id)
        ->where('DATE(date_show)', $today)
        ->from('tbl_loans')
        ->count_all_results();
}

public function fetch_today_deposit_daily_comp($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposit,SUM(double_amont) AS total_double FROM tbl_depost WHERE comp_id = '$comp_id' AND day_id = '1' AND depost_day = '$today'");
	return $data->row();
}
public function get_today_received_loan_total($comp_id)
{
    $date = date("Y-m-d");

    $query = $this->db->query("
        SELECT SUM(p.depost) AS total_amount
        FROM tbl_depost p
        JOIN tbl_loans l ON l.loan_id = p.loan_id
        JOIN tbl_customer c ON c.customer_id = l.customer_id
        JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        JOIN tbl_account_transaction at ON at.trans_id = p.depost_method
        WHERE p.comp_id = '$comp_id'
        AND p.depost_day = '$date'
        AND l.day = 1
    ");

    return $query->row()->total_amount ?? 0;
}




public function get_today_received_from_receivale($comp_id)
{
    $query = $this->db->query("
        SELECT SUM(p.depost) AS total_amount
        FROM tbl_depost p
        JOIN tbl_loans l ON l.loan_id = p.loan_id
        JOIN tbl_customer c ON c.customer_id = l.customer_id
        JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        JOIN tbl_account_transaction at ON at.trans_id = p.depost_method
        WHERE p.comp_id = '$comp_id'
          AND p.depost_day = l.date_show
          AND l.loan_status = 'withdrawal'
    ");

    return $query->row()->total_amount ?? 0;
}



public function get_depositing_out_total_comp($comp_id){
    $date = date("Y-m-d");
    $data = $this->db->query("
        SELECT SUM(d.depost) AS total_default 
        FROM tbl_depost d 
        LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id 
        LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method 
        LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id 
        WHERE d.depost_day = '$date' 
          AND d.comp_id = '$comp_id' 
          AND d.dep_status = 'out'
    ");
    return $data->row();
}


public function get_depositing_out_todayend_comp($comp_id){
    $date = date("Y-m-d");
    $data = $this->db->query("
        SELECT SUM(d.depost) AS total_default 
        FROM tbl_depost d 
        LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id 
        LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method 
        LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id 
        LEFT JOIN tbl_outstand o ON o.loan_id = d.loan_id
        WHERE d.depost_day = '$date' 
          AND o.loan_end_date = '$date'
          AND d.comp_id = '$comp_id' 
          AND d.dep_status = 'out'
    ");
    return $data->row();
}








public function get_weekly_received_loan_total($comp_id)
{
    $date = date("Y-m-d");

    $query = $this->db->query("
        SELECT SUM(p.depost) AS total_amount
        FROM tbl_depost p
        JOIN tbl_loans l ON l.loan_id = p.loan_id
        JOIN tbl_customer c ON c.customer_id = l.customer_id
        JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        JOIN tbl_account_transaction at ON at.trans_id = p.depost_method
        WHERE p.comp_id = '$comp_id'
        AND p.depost_day = '$date'
        AND l.day = 7
    ");

    return $query->row()->total_amount ?? 0;
}

public function get_monthly_received_loan($comp_id)
{
    $date = date("Y-m-d");

    $query = $this->db->query("
        SELECT SUM(p.depost) AS total_amount
        FROM tbl_depost p
        JOIN tbl_loans l ON l.loan_id = p.loan_id
        JOIN tbl_customer c ON c.customer_id = l.customer_id
        JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        JOIN tbl_account_transaction at ON at.trans_id = p.depost_method
        WHERE p.comp_id = '$comp_id'
        AND p.depost_day = '$date'
        AND l.day IN (28, 29, 30, 31)
    ");

    return $query->row()->total_amount ?? 0;
}

	public function count_employee_company($comp_id)
    {
        return $this->db->where('comp_id', $comp_id)
                        ->from('tbl_employee')
                        ->count_all_results();
    }
	
	public function count_open_loans_by_officer($empl_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_open_loans
			FROM tbl_loans
			WHERE empl_id = ? AND loan_status = 'open'
		", [$empl_id]);
		return $query->row()->total_open_loans;
	}

	public function get_approved_loans_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT * 
			FROM tbl_loans 
			WHERE blanch_id = ? AND loan_status = 'aproved'
		", array($blanch_id));
	
		return $query->result(); // returns an array of result objects
	}

	public function get_approved_loans_by_officer($blanch_id, $empl_id) {
		$query = $this->db->query("
			SELECT * 
			FROM tbl_loans 
			WHERE blanch_id = ? AND empl_id = ? AND loan_status = 'aproved'
		", array($blanch_id, $empl_id));
	
		return $query->result(); // returns an array of loan objects
	}
	
	public function count_disbursed_loans_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_disbursed
			FROM tbl_loans 
			WHERE blanch_id = ? AND loan_status = 'disbarsed'
		", array($blanch_id));
	
		return $query->row()->total_disbursed;
	}
	
	public function count_disbursed_loans_by_officer($blanch_id, $empl_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_disbursed
			FROM tbl_loans 
			WHERE blanch_id = ? AND empl_id = ? AND loan_status = 'disbarsed'
		", array($blanch_id, $empl_id));
	
		return $query->row()->total_disbursed;
	}

	public function get_pending_totals_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT * 
			FROM tbl_pending_total 
			WHERE blanch_id = ? AND total_pend IS NOT FALSE
		", array($blanch_id));
	
		return $query->result(); // returns an array of objects
	}

	
	public function get_pending_totals_by_officer($blanch_id, $empl_id) {
		$query = $this->db->query("
			SELECT * 
			FROM tbl_pending_total 
			WHERE blanch_id = ? AND empl_id = ? AND total_pend IS NOT FALSE
		", array($blanch_id, $empl_id));
	
		return $query->result(); // returns an array of objects
	}
	
	
	
	


	public function get_loan_by_loan_id($loan_id) {
		$this->db->select('tbl_customer.f_name, tbl_customer.m_name, tbl_customer.l_name, tbl_customer.phone_no, tbl_employee.empl_name, tbl_blanch.blanch_name');
		$this->db->from('tbl_loans');
		$this->db->join('tbl_customer', 'tbl_customer.customer_id = tbl_loans.customer_id');
		$this->db->join('tbl_employee', 'tbl_employee.empl_id = tbl_loans.empl_id');
		$this->db->join('tbl_blanch', 'tbl_blanch.blanch_id = tbl_loans.blanch_id');
		$this->db->where('tbl_loans.loan_id', $loan_id);
		$query = $this->db->get();
		return $query->row(); // returns a single object
	}
	
	
	public function count_open_loans_by_branch($blanch_id) {
		$query = $this->db->query("
			SELECT COUNT(*) AS total_open_loans
			FROM tbl_loans
			WHERE blanch_id = ? AND loan_status = 'open'
		", [$blanch_id]);
		return $query->row()->total_open_loans;
	}

	public function get_open_loans_by_customer($customer_id)
{
     $this->db->select('tbl_loans.*, tbl_loan_category.loan_name, tbl_employee.empl_name'); 
    $this->db->from('tbl_loans');
    $this->db->join('tbl_loan_category', 'tbl_loans.category_id = tbl_loan_category.category_id', 'left');
    $this->db->join('tbl_employee', 'tbl_loans.empl_id = tbl_employee.empl_id', 'left');
    $this->db->where('tbl_loans.loan_status', 'open');
    $this->db->where('tbl_loans.customer_id', $customer_id);
    
    $query = $this->db->get();
    return $query->result();
}


public function get_loan_by_id($loan_id)
{
    return $this->db
        ->where('loan_id', $loan_id)
        ->where('loan_status', 'open')
        ->get('tbl_loans')
        ->row();
}


	


	public function get_allcutomerblanchData($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC"); 
	return $customer->result(); 
	}

	public function get_allcutomerofficerData($blanch_id, $empl_id)
{
    $customer = $this->db->query("
        SELECT * FROM tbl_customer c  
        LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
        LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id 
        LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id 
        WHERE c.blanch_id = '$blanch_id' AND c.empl_id = '$empl_id' 
        ORDER BY c.customer_id DESC
    "); 

    return $customer->result(); 
}


	public function get_allcutomerblanchData_by_officer($blanch_id, $empl_id){
		$customer = $this->db->query("
			SELECT * 
			FROM tbl_customer c  
			LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
			LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id 
			WHERE c.blanch_id = '$blanch_id' 
			AND c.empl_id = '$empl_id'
			ORDER BY c.customer_id DESC
		"); 
		return $customer->result(); 
	}
	

	public function get_allcustomerData($comp_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.comp_id = '$comp_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}


	   function fetch_loan_list($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
  //$output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->loan_aprove).")"."/"."Date " .$row->loan_stat_date.'</option>';
   
  }
  return $output;
 }




public function get_total_pay_description_acount_statement($loan_id)
{
    $query = $this->db->query("
        SELECT 
            p.*, 
            l.*, 
            at.*, 
            o.*, 
            pen.*
        FROM tbl_pay p
        LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id
        LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method
        LEFT JOIN tbl_outstand o ON o.loan_id = p.loan_id
        LEFT JOIN tbl_penat pen ON pen.comp_id = l.comp_id
        WHERE p.loan_id = '$loan_id'
      
        ORDER BY p.pay_id DESC
    ");
    return $query->result();
}



	

		public function get_allcustomerDatagroup($comp_id) {
    $customer = $this->db->query("
        SELECT 
            c.*, 
            sc.*, 
            at.*, 
            b.*, 
            e.empl_name 
        FROM tbl_customer c  
        LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
        LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id 
        LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id 
        LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id
        WHERE c.comp_id = '$comp_id'  
        ORDER BY c.customer_id DESC
    ");
    return $customer->result();  
}



	public function get_allcutomerBlanch_Data($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC");
	  return $customer->result(); 
	}

	public function update_capital($data,$capital_id){
		return $this->db->where('capital_id',$capital_id)->update('tbl_capital',$data);
	}

	public function remove_capital($capital_id){
		return $this->db->delete('tbl_capital',['capital_id'=>$capital_id]);
	}

	public function get_capital_balance($capital_id){
		$data = $this->db->query("SELECT * FROM tbl_capital WHERE capital_id = '$capital_id'");
		 return $data->row();
	}


	public function get_customer_profileData($customer_id){
		$customer = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_sub_customer sb  ON sb.customer_id = c.customer_id  LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_account_type ac ON ac.account_id = sb.account_id WHERE c.customer_id = '$customer_id'");
		   return $customer->result();
	}


      public function get_customer_profileData_update($customer_id){
		$customer = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_sub_customer sb  ON sb.customer_id = c.customer_id  LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_account_type ac ON ac.account_id = sb.account_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id'");
		   return $customer->row();
	}

	public function edit_customer($customer_id){
		$customer = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
		 return $customer->row();
	}

	public function update_customer($customer_id,$data){
		return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
	}


	public function insert_account($data){
		return $this->db->insert('tbl_account_type',$data);
	}

	public function get_accountTYpe(){
		$account = $this->db->query("SELECT * FROM tbl_account_type");
		  return $account->result();
	}



	        // search-----
    // public function search_CustomerID($customer_id,$comp_id){
    //   $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,sc.id,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.work_status,sc.place_imployment,sc.month_income,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.signature,sc.bussiness_type,sc.passport,sc.signature,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_id,at.account_name,e.empl_name');
    //   $this->db->like('c.customer_code',$customer_code);
    //   $this->db->like('c.comp_id',$comp_id);
    //   $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
    //   $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
    //   $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
    //   $this->db->JOIN('tbl_company ca','ca.comp_id = c.comp_id');
    //   $this->db->JOIN('tbl_employee e','e.empl_id = c.empl_id');
    //   $data = $this->db->get('tbl_customer c');
    //      return $data->row();
    //     }

        public function search_CustomerID($customer_id,$comp_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id LEFT JOIN tbl_company ca ON ca.comp_id = c.comp_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id WHERE c.customer_id = '$customer_id' AND c.comp_id = '$comp_id'");
        	return $data->row();
        }

		public function get_loansms($loan_id) {
			$loan = $this->db->query("
				SELECT * 
				FROM tbl_loans l
				LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id
				LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id
				LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
				LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id
				LEFT JOIN tbl_account_type at ON at.account_id = s.account_id
				LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id
				WHERE l.loan_id = '$loan_id'
				LIMIT 1
			");
			return $loan->row();
		}


	        // search customer blanch-----
    public function search_CustomerID_Blanch($customer_code,$comp_id,$blanch_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,sc.id,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.signature,sc.bussiness_type,sc.passport,sc.signature,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_id,at.account_name');
      $this->db->like('c.customer_code',$customer_code);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->like('c.blanch_id',$blanch_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_company ca','ca.comp_id = c.comp_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }



        public function insert_sponser_data($data){
        	return $this->db->insert('tbl_sponser',$data);
        }


       public function insert_group($data){
       	return $this->db->insert('tbl_group',$data);
       }

       public function get_groupData($comp_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.comp_id = '$comp_id'");
       	 return $group->result();
       }

       

        public function get_groupDataBlanchData($blanch_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.blanch_id = '$blanch_id'");
       	 return $group->result();
       }

        public function get_groupDataBlanch($blanch_id){
       	$group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.blanch_id = '$blanch_id'");
       	 return $group->result();
       }


       public function get_parsonalloan_pending($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.comp_id = '$comp_id' AND l.group_id = 0");
       	   return $data->result();
       }

        public function get_parsonalloan_pendingBlanch($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.blanch_id = '$blanch_id' AND l.group_id = 0");
       	   return $data->result();
       }


       public function insert_loan($data){
       	 $this->db->insert('tbl_loans',$data);
       	 return $this->db->insert_id();
       }

       public function get_loanAttach($loan_id)
{
    $this->db->select('
        tbl_loans.*,
        tbl_customer.*,
        tbl_sponser.*,
    ');

    $this->db->from('tbl_loans');
    $this->db->join('tbl_customer', 'tbl_customer.customer_id = tbl_loans.customer_id', 'left');
    $this->db->join('tbl_sponser', 'tbl_sponser.customer_id = tbl_loans.customer_id', 'left');
    $this->db->where('tbl_loans.loan_id', $loan_id);

    $query = $this->db->get();
    return $query->row();
}


 
	   public function get_loanPending($comp_id){
		// Modify the query to join with the 'employees' table (or the appropriate table that stores user info)
		$loan = $this->db->query("
			SELECT 
				l.*, 
				c.*, 
				lt.*, 
				b.*, 
				s.*, 
				e.empl_name as created_by_name  -- Get the employee's name who created the loan
			FROM 
				tbl_loans l 
				LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
				LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id 
				LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
				LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  
				LEFT JOIN tbl_employee e ON e.empl_id = l.created_by  -- Join with employees table to get the creator's name
			WHERE 
				l.loan_status = 'open' 
				AND l.comp_id = '$comp_id' 
			ORDER BY 
				l.loan_id DESC
		");
		return $loan->result();
	}
	

         public function get_loan_request_Balnch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       //  public function get_loanPendingBlanch($blanch_id){
       // 	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       // 	   return $loan->result();
       // }



        public function get_loanPendingBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

	   public function get_loanPendingByOfficer($empl_id) {
		$loan = $this->db->query("
			SELECT *
			FROM tbl_loans l
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id
			LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
			LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id
			WHERE l.loan_status = 'open' AND c.empl_id = ?
			ORDER BY l.loan_id DESC
		", [$empl_id]);
	
		return $loan->result();
	}
	

        public function get_total_loanPendingBlanch($blanch_id){
       	$loan = $this->db->query("SELECT SUM(how_loan) AS total_loan_request FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' AND l.group_id = '0' ORDER BY l.loan_id DESC ");
       	   return $loan->row();
       }

       


       public function get_loanPendingBlanch_group($group_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'open'  AND l.group_id = '$group_id' AND l.group_id IS TRUE ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

        public function get_loan_group_loan($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE l.loan_status = 'open'  AND l.blanch_id = '$blanch_id' AND l.group_id IS TRUE GROUP BY l.group_id ");
       	   return $loan->result();
       }

       public function get_total_loan_group($blanch_id){
       	$data = $this->db->query("SELECT SUM(how_loan) AS total_loan_request_group FROM tbl_loans WHERE blanch_id = '$blanch_id' AND group_id IS TRUE AND loan_status = 'open'");
       	 return $data->row();
       }




        public function get_loanGroup($group_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  WHERE  l.group_id = '$group_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

        public function get_loanGroupBlanch($group_id,$blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  WHERE  l.group_id = '$group_id' AND l.blanch_id = '$blanch_id' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function get_groupDataone($group_id){
       	$data = $this->db->query("SELECT * FROM tbl_group WHERE group_id = '$group_id'");
       	  return $data->row();
       }


	   public function get_guarator_data($customer_id, $comp_id) {
		$sponser = $this->db->query("
			SELECT * FROM tbl_sponser 
			WHERE customer_id = '$customer_id' 
			AND comp_id = '$comp_id' 
			ORDER BY created_at DESC 
			
		");
		return $sponser->result(); // Inarudisha rekodi moja pekee
	}


	 public function get_aggrement($customer_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  LEFT JOIN tbl_region r ON r.region_id = c.region_id LEFT JOIN tbl_account_type at ON at.account_id = s.account_id LEFT JOIN tbl_employee e ON e.empl_id = c.empl_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	   return $loan->row();
       }




        public function get_loanCustomer($customer_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id   JOIN tbl_account_type at ON at.account_id = s.account_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	   return $loan->result();
       }

        public function get_loanData($customer_id,$comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  JOIN tbl_account_type at ON at.account_id = s.account_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
       	   return $loan->result();
       }


       public function get_sponser_data($customer_id,$comp_id){
       	$sponser = $this->db->query("SELECT * FROM tbl_sponser WHERE customer_id = '$customer_id' AND comp_id = '$comp_id'");
       	  return $sponser->result();
       }


       public function get_loanform($customer_id,$comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_group g ON g.group_id = l.group_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC ");
       	return $data->row();
       }



    //    public function get_formoanData($customer_id,$comp_id){
    //    	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id  WHERE l.customer_id = '$customer_id' AND l.comp_id = '$comp_id' ORDER BY l.loan_id DESC LIMIT 1");
    //    	return $data->row();
    //    }

	public function get_formloanData($customer_id, $comp_id) {
		$data = $this->db->query("
			SELECT 
				l.*,
				lc.*, 
				c.*, 
				b.*, 
				e.*, 
				cb.empl_name AS creator_name,
				cb.empl_email AS creator_email,
				cb.empl_no AS creator_no,
				cb.empl_sex AS creator_sex,
				cb.passport AS creator_passport
			FROM tbl_loans l
			JOIN tbl_loan_category lc ON lc.category_id = l.category_id 
			JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			JOIN tbl_customer c ON c.customer_id = l.customer_id 
			JOIN tbl_employee e ON e.empl_id = l.empl_id
			JOIN tbl_employee cb ON cb.empl_id = l.created_by
			WHERE l.customer_id = '$customer_id' 
			AND l.comp_id = '$comp_id' 
			ORDER BY l.loan_id DESC 
			LIMIT 1
		");
		return $data->row();
	}



       public function get_customergroupdata($group_id,$comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = $group_id AND comp_id = '$comp_id'");
       	  return $data->result();
       }


       public function get_customergroupdataBlanch($group_id,$blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = $group_id AND blanch_id = '$blanch_id'");
       	  return $data->result();
       }

       


       public function update_status($loan_id,$data){
       	return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$data);
       }

	   public function get_loanAproved_customer($comp_id, $customer_id){
		$loan = $this->db->query("
			SELECT * 
			FROM tbl_loans l 
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
			LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  
			WHERE l.comp_id = '$comp_id' 
			AND l.customer_id = '$customer_id'
			AND l.loan_status = 'aproved' 
			ORDER BY l.loan_id DESC
		");
		return $loan->result();
	}
	
       
       public function get_loanAproved($comp_id){
		$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
		   return $loan->result();
	}

       public function get_aproved_loanBlabch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       public function get_loanAprovedBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function insert_loanfee($data){
       	return $this->db->insert('tbl_loan_fee',$data);
       }


       public function get_loanfee($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_loan_fee WHERE comp_id = '$comp_id'");
       	   return $data->result();
       }

       public function get_loanDisbarsed($loan_id){
       	  $data = $this->db->query("SELECT l.loan_id,l.how_loan,l.code,l.blanch_id,l.group_id,l.comp_id,l.customer_id,l.loan_aprove,l.loan_code,l.day,l.session,c.comp_name,c.comp_phone,cs.phone_no FROM tbl_loans l JOIN tbl_company c ON c.comp_id = l.comp_id JOIN tbl_customer cs ON cs.customer_id = l.customer_id WHERE l.loan_id = '$loan_id'");
       	     return $data->row();
       }


       public function get_loanfeedata($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE p.customer_id = '$cucustomer_id = '$customer_id' ORDER BY pay_id DESC");
       	   return $data->result();
       }
       //     public function get($customer_id){
       // 	$data = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE p.custom= '$customer_id' ORDER BY pay_id DESC");
       // 	   return $data->row();
       // }

       public function get_all_dataloan($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id'");
       	    return $data->row();
       }

       public function get_data_notfeeid($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_pay WHERE fee_id IS NULL  AND customer_id = '$customer_id'");
       	    return $data->row();
       }


	   public function get_DisbarsedLoan($comp_id){
		$loan = $this->db->query("
			SELECT 
				l.*, 
				c.*, 
				lt.*, 
				b.*, 
				s.*, 
				e.empl_name AS created_by_name
			FROM 
				tbl_loans l 
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
			LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id 
			LEFT JOIN tbl_employee e ON e.empl_id = l.created_by
			WHERE 
				l.comp_id = '$comp_id' 
				AND l.loan_status = 'disbarsed' 
			ORDER BY l.loan_id DESC
		");
		return $loan->result();
	}
	


	   public function get_comp_withdrawal_Loan($comp_id){
		$date = date("Y-m-d");
		$loan = $this->db->query("
			SELECT 
				SUM(l.loan_aprove) AS total_loan_aprove, 
				SUM(l.loan_int) AS total_loan_int
			FROM tbl_loans l 
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
			LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id 
			LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id 
			LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method  
			WHERE l.comp_id = '$comp_id' 
			AND l.loan_status = 'withdrawal' 
			AND ot.loan_stat_date = '$date'
		");
		return $loan->row(); // return single row with sums
	}


	        public function get_withdrawal_Loan_today($comp_id){
        $date = date("Y-m-d");
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


    //      public function get_today_withdrawal_daily_comp($comp_id){
    //    	$today = date("Y-m-d");
    //    	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today' AND l.day = '1'");
    //    	return $data->row();
    //    }
	



    public function get_withdrawal_Loan($comp_id, $filters = [])
{
    $this->db->select('*');
    $this->db->from('tbl_loans l');

    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_account_transaction at', 'at.trans_id = l.method', 'left');

    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Date logic
    if (!empty($filters['from']) && !empty($filters['to'])) {
        $this->db->where('ot.loan_stat_date >=', $filters['from'] . ' 00:00:00');
        $this->db->where('ot.loan_stat_date <=', $filters['to'] . ' 23:59:59');
    } else {
        $today = date('Y-m-d');
        $this->db->where('ot.loan_stat_date >=', $today . ' 00:00:00');
        $this->db->where('ot.loan_stat_date <=', $today . ' 23:59:59');
    }

    if (!empty($filters['blanch_id'])) {
        $this->db->where('l.blanch_id', $filters['blanch_id']);
    }

    if (!empty($filters['loan_name'])) {
        $this->db->like('l.loan_name', $filters['loan_name']);
    }

    $this->db->order_by('l.loan_id', 'DESC');
    return $this->db->get()->result();
}





public function check_phone_existence_with_loans($phone, $comp_id)
{
    $results = [];

    // ========== CUSTOMER ==========
    $this->db->select("
        'Customer' AS source,
        c.customer_id AS ref_id,
        CONCAT(c.f_name,' ',c.l_name) AS full_name,
        b.blanch_name AS branch_name,
        l.loan_id,
        l.loan_status,
        o.loan_stat_date,
        o.loan_end_date
    ", FALSE);
    $this->db->from('tbl_customer c');
    $this->db->join('tbl_blanch b', 'b.blanch_id = c.blanch_id', 'left');
    $this->db->join('tbl_loans l', 'l.customer_id = c.customer_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->where('c.phone_no', $phone);
    $this->db->where('c.comp_id', $comp_id);
    $results = array_merge($results, $this->db->get()->result());

    // ========== SPONSER ==========
    $this->db->select("
        'Sponsor' AS source,
        s.sp_id AS ref_id,
        CONCAT(s.sp_name,' ',s.sp_lname) AS full_name,
        b.blanch_name AS branch_name,
        l.loan_id,
        l.loan_status,
		c.*,
		l.*,
        o.loan_stat_date,
        o.loan_end_date
    ", FALSE);
    $this->db->from('tbl_sponser s');
    $this->db->join('tbl_customer c', 'c.customer_id = s.customer_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = c.blanch_id', 'left');
    $this->db->join('tbl_loans l', 'l.customer_id = s.customer_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->where('s.sp_phone_no', $phone);
    $this->db->where('s.comp_id', $comp_id);
    $results = array_merge($results, $this->db->get()->result());

    // ========== EMPLOYEE ==========
    $this->db->select("
        'Employee' AS source,
        e.empl_id AS ref_id,
        e.empl_name AS full_name,
        b.blanch_name AS branch_name,
        NULL AS loan_id,
        NULL AS loan_status,
        NULL AS loan_stat_date,
        NULL AS loan_end_date
    ", FALSE);
    $this->db->from('tbl_employee e');
    $this->db->join('tbl_blanch b', 'b.blanch_id = e.blanch_id', 'left');
    $this->db->where('empl_no', $phone);
    $this->db->where('e.comp_id', $comp_id);
    $results = array_merge($results, $this->db->get()->result());

    return $results;
}


public function get_sum_loanwithdrawal_data_filtered($comp_id, $filters = [])
{
    $this->db->select_sum('l.loan_aprove');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id', 'left');
    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Filter by branch
    if (!empty($filters['blanch_id'])) {
        $this->db->where('l.blanch_id', $filters['blanch_id']);
    }

    // Filter by date range
    if (!empty($filters['from']) && !empty($filters['to'])) {
        $this->db->where('ot.loan_stat_date >=', $filters['from']);
        $this->db->where('ot.loan_end_date <=', $filters['to']);
    } else {
        // Default: today
        $today = date("Y-m-d");
        $this->db->where('DATE(ot.loan_stat_date)', $today);
    }

    return $this->db->get()->row()->loan_aprove;
}



public function get_withdrawal_Loan_filtered($comp_id, $filters = [])
{
    $this->db->select('l.*, c.*, lt.*, b.*, s.*, ot.*, at.*');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_account_transaction at', 'at.trans_id = l.method', 'left');

    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Apply filters if provided
    if (!empty($filters['blanch_id'])) {
        $this->db->where('l.blanch_id', $filters['blanch_id']);
    }

    if (!empty($filters['from'])) {
        $this->db->where('ot.loan_stat_date >=', $filters['from']);
    }

    if (!empty($filters['to'])) {
        $this->db->where('ot.loan_stat_date <=', $filters['to']);
    }

    $this->db->order_by('l.loan_id', 'DESC');
    $query = $this->db->get();
    return $query->result();
}



public function get_sum_loanwithdrawal_interest_filtered($comp_id, $filters = [])
{
    $this->db->select_sum('loan_int'); // Sum of interest
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id', 'left');

    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Apply filters if provided
    if (!empty($filters['blanch_id'])) {
        $this->db->where('l.blanch_id', $filters['blanch_id']);
    }
    if (!empty($filters['from'])) {
        $this->db->where('ot.loan_stat_date >=', $filters['from']);
    }
    if (!empty($filters['to'])) {
        $this->db->where('ot.loan_stat_date <=', $filters['to']);
    }

    $query = $this->db->get();
    $result = $query->row();
    return $result->loan_int ?? 0;
}




	//    public function get_grouped_withdrawal_LoanBlanch($blanch_id){
	// 	$this->db->select('l.*, c.*, lt.*, b.*, s.*, ot.*, e.empl_name');
	// 	$this->db->from('tbl_loans l');
	// 	$this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
	// 	$this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id');
	// 	$this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
	// 	$this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id');
	// 	$this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
	// 	$this->db->join('tbl_employee e', 'e.empl_id = l.empl_id');
	// 	$this->db->where('l.blanch_id', $blanch_id);
	// 	$this->db->where('l.loan_status', 'withdrawal');
	// 	$this->db->order_by('e.empl_name');
		
	// 	$query = $this->db->get();
	// 	$results = $query->result();
	
	// 	// Group by empl_name
	// 	$grouped = [];
	// 	foreach ($results as $row) {
	// 		$grouped[$row->empl_name][] = $row;
	// 	}
	
	// 	return $grouped;
	// }


	public function get_grouped_withdrawal_LoanBlanch($blanch_id, $from_date = null, $to_date = null)
{
    $this->db->select('l.*, c.*, lt.*, b.*, s.*, ot.*, e.empl_name');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
    $this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
    $this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id');
    $this->db->where('l.blanch_id', $blanch_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Add date filters if provided
    if ($from_date) {
        $this->db->where('l.disburse_day >=', $from_date);
    }
    if ($to_date) {
        $this->db->where('l.disburse_day <=', $to_date);
    }

    $this->db->order_by('e.empl_name');
    
    $query = $this->db->get();
    $results = $query->result();

    // Group by empl_name
    $grouped = [];
    foreach ($results as $row) {
        $grouped[$row->empl_name][] = $row;
    }

    return $grouped;
}


public function get_grouped_withdrawal_todayBlanch($blanch_id, $from_date = null, $to_date = null)
{
    $this->db->select('l.*, c.*, lt.*, b.*, s.*, ot.*, e.empl_name');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
    $this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
    $this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id');

    $this->db->where('l.blanch_id', $blanch_id);
    $this->db->where('l.loan_status', 'withdrawal');

    // Add this line to filter disburse_day = today
    $this->db->where('DATE(l.disburse_day)', date('Y-m-d'));

    $this->db->order_by('e.empl_name');
    
    $query = $this->db->get();
    $results = $query->result();

    // Group by empl_name
    $grouped = [];
    foreach ($results as $row) {
        $grouped[$row->empl_name][] = $row;
    }

    return $grouped;
}


public function get_grouped_withdrawal_officertodayBlanch($blanch_id, $empl_id = null, $from_date = null, $to_date = null)
{
    $this->db->select('l.*, c.*, lt.*, b.*, s.*, ot.*, e.empl_name');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
    $this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
    $this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id');
    $this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id');

    $this->db->where('l.blanch_id', $blanch_id);
    $this->db->where('l.loan_status', 'withdrawal');
    $this->db->where('DATE(l.disburse_day)', date('Y-m-d'));

    if (!empty($empl_id)) {
        $this->db->where('l.empl_id', $empl_id);
    }

    $this->db->order_by('e.empl_name');

    $query = $this->db->get();
    $results = $query->result();

    // Group by empl_name
    $grouped = [];
    foreach ($results as $row) {
        $grouped[$row->empl_name][] = $row;
    }

    return $grouped;
}




	public function get_grouped_withdrawal_LoanBlanch_by_date($blanch_id, $from_date, $to_date)
{
    $this->db->select('*');  // or your required columns
    $this->db->from('tbl_loans');
    $this->db->where('blanch_id', $blanch_id);
    $this->db->where('disburse_day >=', $from_date);
    $this->db->where('disburse_day <=', $to_date);
    // add grouping if needed here

    $query = $this->db->get();
    return $query->result();
}



	

	   public function get_withdrawal_LoanByOfficer($empl_id) {
		$this->db->select('*');
		$this->db->from('tbl_loans l');
		$this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
		$this->db->join('tbl_loan_category lt', 'lt.category_id = l.category_id');
		$this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
		$this->db->join('tbl_sub_customer s', 's.customer_id = l.customer_id');
		$this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
		$this->db->where('l.loan_status', 'withdrawal');
		$this->db->where('l.empl_id', $empl_id);  // Filter by loan officer
		$this->db->order_by('l.loan_id', 'DESC');
	
		$query = $this->db->get();
		return $query->result();
	}
	

           public function get_DisbarsedLoanBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'disbarsed'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


public function get_DisbarsedLoanBlanch_today($blanch_id) {
    $today = date('Y-m-d'); // today's date

    $loan = $this->db->query("
        SELECT l.*, c.*, lt.*, b.*, s.*, df.deducted_balance
        FROM tbl_loans l
        LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id
        LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id
        LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id
        LEFT JOIN tbl_deducted_fee df ON df.loan_id = l.loan_id
        WHERE l.blanch_id = ?
        AND l.loan_status IN ('disbarsed','withdrawal')
        AND DATE(l.disburse_day) = ?
        ORDER BY l.loan_id DESC
    ", [$blanch_id, $today]);

    return $loan->result();
}




	   public function get_DisbarsedLoanByOfficer($empl_id) {
		$loan = $this->db->query("
			SELECT *
			FROM tbl_loans l
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id
			LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
			LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id
			WHERE l.loan_status = 'disbarsed' AND c.empl_id = ?
			ORDER BY l.loan_id DESC
		", [$empl_id]);
	
		return $loan->result();
	}
	



	        // search-----
			public function search_CustomerLoan($customer_id) {
				$data = $this->db->query("
					SELECT * 
					FROM tbl_customer c 
					LEFT JOIN tbl_sponser s ON s.customer_id = c.customer_id
					LEFT JOIN tbl_sub_customer b ON b.customer_id= c.customer_id
					WHERE c.customer_id = '$customer_id'
				");
				return $data->row();
			}
			


                // search-----customer leport
    public function search_CustomerLoan_report($customer_id,$comp_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.	l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,c.	customer_status,c.customer_day,sc.id AS ids,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.passport,sc.signature,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,at.account_id,at.account_name,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular,cr.rep_id,cr.comp_id,cr.blanch_id,cr.customer_id,cr.loan_id,cr.recevable_amount,cr.pending_amount,cr.penart_amount,rep_date');
 
      $this->db->like('c.customer_id',$customer_id);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_customer_report cr','cr.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loans l','l.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }

public function get_customer_loanReport($customer_id) {
    $data_report = $this->db->query("
        SELECT cr.*, l.*, d.*, o.*, p.*, c.*
        FROM tbl_customer_report cr
        JOIN tbl_loans l ON l.loan_id = cr.loan_id
        LEFT JOIN tbl_depost d ON d.loan_id = cr.loan_id
        LEFT JOIN tbl_outstand o ON o.loan_id = cr.loan_id
        LEFT JOIN tbl_pay p ON p.loan_id = cr.loan_id AND p.description = 'CASH DEPOSIT'
        JOIN tbl_customer c ON c.customer_id = cr.customer_id
        WHERE cr.customer_id = ?
        ORDER BY cr.rep_id DESC
    ", [$customer_id]);

    return $data_report->result();
}









        public function get_sum_receivableAmountCustomer($customer_id){
        	$data = $this->db->query("SELECT SUM(recevable_amount) AS total_recevable FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	return $data->row();
        }

        public function get_sumPending_Amount($customer_id){
        	$data = $this->db->query("SELECT SUM(pending_amount) AS TotalPending FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	return $data->row();
        }

        public function get_penart_amount_total($customer_id){
        	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report WHERE customer_id = '$customer_id'");
        	 return $penart->row();
        }


     //teller dashboard blanch customer

            public function search_CustomerLoanBlanch($fname,$m_name,$comp_id,$blanch_id){
      $this->db->select('c.customer_id,c.comp_id,c.blanch_id,c.empl_id,c.customer_code,c.f_name,c.m_name,c.	l_name,c.gender,c.date_birth,c.phone_no,c.region_id,c.district,c.ward,c.street,c.	customer_status,c.customer_day,sc.id AS ids,sc.customer_id,sc.account_id,sc.famous_area,sc.martial_status,sc.natinal_identity,sc.bussiness_type,sc.number_dependents,sc.place_imployment,sc.month_income,sc.passport,sc.signature,b.blanch_id,b.	comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,at.account_id,at.account_name,p.pay_id,p.comp_id,p.fee_id,p.blanch_id,p.empl_id,p.customer_id,p.loan_id,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.collateral,l.name_oficer,l.oficer_no,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.gov_district,l.gov_ward,l.gov_street,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular');
      $this->db->like('c.f_name',$fname);
      $this->db->like('c.m_name',$m_name);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->like('c.comp_id',$blanch_id);
      $this->db->JOIN('tbl_sub_customer sc','sc.customer_id = c.customer_id');
      $this->db->JOIN('tbl_blanch b','b.blanch_id = c.blanch_id');
      $this->db->JOIN('tbl_account_type at','at.account_id = sc.account_id');
      $this->db->JOIN('tbl_pay p','p.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loans l','l.customer_id = c.customer_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_customer c');
         return $data->row();
        }

public function get_totalLoanDisburese($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'disbarsed' ORDER BY loan_id DESC");
	  return $total_loan->row();
}
public function get_totalLoanALL($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans l  WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanALLDta($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanwithdrawal($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'withdrawal' ORDER BY loan_id DESC");
	  return $total_loan->row();
}

public function get_loan_check($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
	  return $total_loan->row();
}

public function get_totalLoanDone($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'done' ORDER BY loan_id DESC");
	  return $total_loan->row();
}



public function get_totalLoanout($customer_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' AND loan_status = 'out' ORDER BY loan_id DESC");
	  return $total_loan->row();
}


        public function get_sum_withdrow($loan_id){
        	$data = $this->db->query("SELECT SUM(withdrow) AS withdrow_data FROM tbl_pay WHERE loan_id = '$loan_id'");
        	   return $data->row();
        }

        public function get_paydata($loan_id){
        	$data = $this->db->query("SELECT * FROM tbl_pay JOIN tbl_loan_fee ON tbl_loan_fee.fee_id = tbl_pay.fee_id WHERE loan_id = '$loan_id'");
        	  return $data->result();
        }


        public function get_paycustomer($customer_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC");
        	  return $customer_pay->result();
        }
         public function get_paycustomerNotfee($customer_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.customer_id = '$customer_id' ORDER BY p.pay_id DESC LIMIT 5");
        	  return $customer_pay->result();
        }


         public function get_data_searchCustomer($customer_id,$comp_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id JOIN tbl_account_type at ON at.account_id = sc.account_id WHERE c.customer_id = '$customer_id' AND c.comp_id = '$comp_id' ");
        	  return $data->row();
        }

           public function get_data_searchCustomerPay($customer_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_loans l ON l.customer_id = c.customer_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id  WHERE c.customer_id = '$customer_id'");
        	  return $data->row();
        }

        public function get_remainbalance($customer_id){
        	$data = $this->db->query("SELECT p.balance,p.customer_id FROM tbl_pay p WHERE p.customer_id = '$customer_id' ORDER BY pay_id DESC");
        	 return $data->row();
        }

       public function get_customer_Loandata($customer_id)
{
    $data = $this->db->query("
        SELECT *
        FROM tbl_pay p
        JOIN tbl_loans l ON l.loan_id = p.loan_id
        JOIN tbl_loan_category lc ON lc.category_id = l.category_id
        JOIN tbl_outstand o ON o.loan_id = l.loan_id
        WHERE p.customer_id = '$customer_id'
        ORDER BY p.pay_id DESC
    ");
    return $data->row();
}


         public function get_loan_LoandataAutomatic($loan_id){
        $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id LEFT JOIN tbl_penat pe ON pe.comp_id = l.comp_id LEFT JOIN tbl_outstand o ON o.loan_id = l.loan_id  WHERE p.loan_id = '$loan_id' ORDER BY p.pay_id DESC");
        	 return $data->row();
        }


           public function get_customer_LoandataAutomaticALL(){
        $data = $this->db->query("SELECT * FROM tbl_customer");
        	 return $data->result();
        }


        public function get_sumDepost_loan($customer_id){
        	$sum = $this->db->query("SELECT SUM(depost) AS total_deposit FROM tbl_pay WHERE   fee_id  IS NULL AND customer_id = '$customer_id'");
        	 return $sum->row();
        }


        public function get_loan_rejectData($loan_id){
        	$data = $this->db->query("SELECT loan_status FROM tbl_loans WHERE loan_id = '$loan_id'");
        	  return $data->row();
        }

        public function remove_loan($loan_id){
        	return $this->db->delete('tbl_loans',['loan_id'=>$loan_id]);
        }

        public function get_loan_reject($comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'reject'  AND l.comp_id = '$comp_id'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

         public function get_loan_rejectBlanch($blanch_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.loan_status = 'reject'  AND l.blanch_id = '$blanch_id'  ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }


       public function get_sum_loanDisbursed($comp_id){
		    	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = ot.loan_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'disbarsed' AND ot.loan_stat_date = '$date'");
       	  return $total_loan_dis->row();

       }

	   public function get_today_disbursed_loans_sum($comp_id)
{
    $today = date('Y-m-d'); // today's date

    $this->db->select_sum('loan_aprove', 'total_loan_approve');
    $this->db->from('tbl_loans');
    $this->db->where('DATE(disburse_day)', $today); // ignore time
    $this->db->where('comp_id', $comp_id);

    $query = $this->db->get();
    return $query->row()->total_loan_approve ?? 0;
}


public function get_today_disbursed_loans($comp_id)
{
    // $today = date('Y-m-d'); // Optional if you want only today's loans

    $this->db->select('
        l.*, 
        b.blanch_name, 
        c.f_name, c.m_name, c.l_name, c.phone_no, 
        e.empl_name,
        (
            SELECT COUNT(l2.loan_id) 
            FROM tbl_loans l2 
            WHERE l2.customer_id = l.customer_id
        ) AS total_loan
    ');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');

    // Optional: uncomment if you want today's loans only
    $this->db->where('l.loan_status', 'disbarsed');
	// $this->db->where('DATE(l.disburse_day)', $today);
    $this->db->where('l.comp_id', $comp_id);

    return $this->db->get()->result();
}



   public function get_loan_history($customer_id){
		$data = $this->db->query("
			SELECT l.*, c.*, b.*, sc.*, at.*, lc.*, ot.*, d.depost_day
			FROM tbl_loans l 
			LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
			LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id 
			LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id 
			LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id 
			LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
			WHERE l.customer_id = '$customer_id' 
			AND l.loan_status = 'done' 
			AND d.depost_day = (SELECT MAX(depost_day) FROM tbl_depost WHERE loan_id = l.loan_id)
		");
	
		return $data->result();
	}




	    public function get_all_numbers()
    {
        return $this->db->order_by('id', 'DESC')->get('tbl_notification_numbers')->result();
    }

    public function get_numbers_by_position($position)
    {
        return $this->db->where('position', $position)
                        ->where('status', 1)
                        ->get('tbl_notification_numbers')
                        ->result();
    }

    public function insert_number($data)
    {
        return $this->db->insert('tbl_notification_numbers', $data);
    }

    public function get_number($id)
    {
        return $this->db->where('id', $id)->get('tbl_notification_numbers')->row();
    }

    public function update_number($id, $data)
    {
        return $this->db->where('id', $id)->update('tbl_notification_numbers', $data);
    }

    public function delete_number($id)
    {
        return $this->db->where('id', $id)->delete('tbl_notification_numbers');
    }


	


	public function get_admin_numbers() {
    $this->db->select('phone_number');
    $this->db->from('tbl_notification_numbers');
    $this->db->where('position', 'admin');
    $query = $this->db->get();
    return $query->result(); // inarudisha array ya objects
}


	

       public function get_sum_loanwithdrawal_data($comp_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = ot.loan_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
       	  return $total_loan_dis->row();
       }

	   public function get_sum_withdrawal_by_officer($empl_id) {
		$this->db->select('
			SUM(l.loan_aprove) as total_loan,
			SUM(l.loan_int) as total_loan_int,
			
		');
		$this->db->from('tbl_loans l');
		$this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
		$this->db->where('l.loan_status', 'withdrawal');
		$this->db->where('l.empl_id', $empl_id);
	
		return $this->db->get()->row();
	}
	


       public function get_sum_loanwithdrawal_dataBlanch($blanch_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }
	   public function get_sum_withdrawal_by_branch($blanch_id) {
		$this->db->select('
			SUM(l.loan_aprove) as total_loan,
			SUM(l.loan_int) as total_loan_int,
			
		');
		$this->db->from('tbl_loans l');
		$this->db->join('tbl_outstand ot', 'ot.loan_id = l.loan_id');
		$this->db->where('l.loan_status', 'withdrawal');
		$this->db->where('l.blanch_id', $blanch_id);
	
		return $this->db->get()->row();
	}
	
        public function get_sum_loanwithdrawal($comp_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'  AND loan_day >= '$date'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanDisbursedBlanch($blanch_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_aprove) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_sum_loanDisburse_interest($comp_id){
       	
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

        public function get_sum_loanwithdrawal_interest($comp_id){
       	$date = date("Y-m-d");
       	$total_loan_dis = $this->db->query("SELECT SUM(l.loan_int) AS total_loan_int FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND ot.loan_stat_date = '$date'");
       	  return $total_loan_dis->row();
       }

	   public function get_sum_loanwithdrawal_interest_by_officer($empl_id) {
		$date = date("Y-m-d");
		$query = $this->db->query("
			SELECT SUM(l.loan_int) AS total_loan_int 
			FROM tbl_loans l 
			LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id 
			WHERE l.empl_id = '$empl_id' 
			AND l.loan_status = 'withdrawal' 
			AND ot.loan_stat_date = '$date'
		");
		return $query->row();
	}
	

         public function get_sum_loanwithdrawal_interestBlanch($blanch_id){
       	$total_loan_dis = $this->db->query("SELECT SUM(with_amount) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
       	  return $total_loan_dis->row();
       }


        public function get_sum_loanDisburse_interestBlanch($blanch_id){
       
       	$total_loan_dis = $this->db->query("SELECT SUM(loan_int) AS total_loan_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
       	  return $total_loan_dis->row();
       }

       public function get_total_active($comp_id){
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS withdrawal_data FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
       	return $data->row();
       }


       public function get_loanInterest($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans JOIN tbl_loan_category ON tbl_loan_category.category_id = tbl_loans.category_id WHERE loan_id = '$loan_id'");
       	     return $data->row();
       }


       public function insert_amount($data){
       	return $this->db->insert('tbl_transfor',$data);
       }

       public function get_amount_transfor($comp_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT t.trans_id,t.comp_id,t.blanch_id,t.blanch_amount,t.trans_day,b.blanch_id,b.comp_id,b.region_id,b.blanch_name,b.blanch_no,at.account_name AS to_account,t.from_trans_id,t.to_trans_id,at.trans_id,tr.account_name AS from_account,t.charger  FROM tbl_transfor t JOIN tbl_blanch b ON b.blanch_id = t.blanch_id JOIN tbl_account_transaction at ON at.trans_id = t.to_trans_id JOIN tbl_account_transaction tr ON tr.trans_id = t.from_trans_id WHERE t.comp_id = '$comp_id' AND t.trans_day = '$day' ORDER BY t.trans_id DESC");
       	  return $data->result();
       }


       public function update_amount($trans_id,$data){
       	return $this->db->where('trans_id',$trans_id)->update('tbl_transfor',$data);
       }

       public function remove_float($trans_id){
       	return $this->db->delete('tbl_transfor',['trans_id'=>$trans_id]);
       }


       public function get_sumFloat($comp_id){
       	$data = $this->db->query("SELECT SUM(blanch_amount) AS float FROM tbl_transfor WHERE comp_id = '$comp_id'");
       	  return $data->row();
       }

       public function get_today_float($comp_id){
       	$date = date("Y-m-d");
       	$float_today = $this->db->query("SELECT * FROM tbl_transfor WHERE comp_id = '$comp_id'AND trans_day >= '$date'");
       	return $float_today->row();
       }

        public function get_today_floatBlanch($blanch_id){
       	$float_today = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
       	return $float_today->row();
       }

       public function get_sumTodayDepost($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '1' AND pay_day >= '$date'");
       	  return $data->row();
       }

        public function get_sumTodayDepostBlanch($blanch_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_pay WHERE blanch_id = '$blanch_id' AND pay_status = '1' AND pay_day >= '$date'");
       	  return $data->row();
       }

        public function get_sumTodayWithdrawal($comp_id){
       	$date = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdraw FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '2' AND pay_day >= '$date'");
       	  return $data->row();
       }


         public function get_sumTodayWithdrawalBlanch($blanch_id){
       	   $date = date("Y-m-d");
          $data = $this->db->query("SELECT SUM(loan_aprove) AS total_withdraw FROM tbl_loans WHERE blanch_id = '$blanch_id' AND region_id = 'ok' AND disburse_day = '$date'");
         return $data->row();
       }

    


        public function get_sumTodayDepostCustomer($loan_id){
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost_customer FROM tbl_pay WHERE loan_id = '$loan_id' AND pay_status = '1'");
       	  return $data->row();
       }


       public function get_allcutomerBlanch($blanch_id){
	$customer = $this->db->query("SELECT * FROM tbl_customer c  JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' ORDER BY c.customer_id DESC ");
	  return $customer->result(); 
	}
	public function get_allcustomer_by_officer($blanch_id, $empl_id){
		$customer = $this->db->query("
			SELECT * 
			FROM tbl_customer c  
			JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
			JOIN tbl_blanch b ON b.blanch_id = c.blanch_id 
			WHERE c.blanch_id = '$blanch_id' 
			AND c.empl_id = '$empl_id'
			ORDER BY c.customer_id DESC
		");
		return $customer->result(); 
	}
	
	public function view_blanchDetail($blanch_id){
	$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
	   return $blanch->row();

	}

	public function get_blanch_account($blanch_id){
		$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
		 return $data->row();
	}


	public function get_customer($customer_id){
		$data = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
		 return $data->row();
	}

	public function remove_customer($customer_id){
		return $this->db->delete('tbl_customer',['customer_id'=>$customer_id]);
	}


	public function get_cash_transaction($comp_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.comp_id = '$comp_id' AND lecod_day >= '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}

	public function get_top_5_deposit_employees($comp_id) {
		$date = date("Y-m-d");
	
		$query = "
			SELECT e.empl_id, e.empl_name,  SUM(d.depost) AS total_deposit
			FROM tbl_depost d
			JOIN tbl_employee e ON e.empl_id = d.empl_id
			WHERE d.comp_id = ?
			  AND d.depost_day >= ?
			GROUP BY e.empl_id, e.empl_name
			ORDER BY total_deposit DESC
			LIMIT 5
		";
	
		$result = $this->db->query($query, [$comp_id, $date]);
		return $result->result();
	}
	
	
	

	public function get_blanchTransaction($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_prev_lecod p JOIN tbl_customer c ON c.customer_id = p.customer_id JOIN tbl_blanch b ON b.blanch_id = p.blanch_id WHERE p.blanch_id = '$blanch_id' AND p.lecod_day = '$date'");
		return $data->result();
	}

	public function get_sum_blanchCash($blanch_id){
		$date = date("Y-m-d");
		$sum = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
		 return $sum->row();
	}

		public function get_sum_blanchCashWith($blanch_id){
		$date = date("Y-m-d");
		$sum = $this->db->query("SELECT SUM(withdraw) AS total_with FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
		 return $sum->row();
	}

public function get_cash_transactionBlanch($blanch_id){
    $date = date("Y-m-d");

    $sql = "
        SELECT 
            c.*, 
            b.*, 
            l.*, 
            IFNULL(SUM(d.depost), 0) AS total_deposit,
            p.wakala,
            IFNULL(at.account_name, '') AS account_name
        FROM tbl_customer c
        JOIN tbl_blanch b 
            ON b.blanch_id = ?
        JOIN tbl_loans l 
            ON l.customer_id = c.customer_id 
            AND l.blanch_id = b.blanch_id
        LEFT JOIN tbl_depost d 
            ON d.loan_id = l.loan_id
        LEFT JOIN tbl_pay p 
            ON p.loan_id = l.loan_id
        LEFT JOIN tbl_blanch_account ba 
            ON ba.blanch_id = b.blanch_id
        LEFT JOIN tbl_account_transaction at 
            ON at.trans_id = ba.receive_trans_id
        WHERE l.blanch_id = ?
        AND (d.depost_day >= ? OR d.depost_day IS NULL)
        GROUP BY l.loan_id, p.wakala, at.account_name
        ORDER BY l.loan_id DESC
    ";

    $data = $this->db->query($sql, [$blanch_id, $blanch_id, $date]);
    return $data->result();
}





public function get_account_by_transid($trans_id) {
    return $this->db
        ->select('at.account_name, ba.receive_trans_id, ba.blanch_id')
        ->from('tbl_blanch_account ba')
        ->join('tbl_account_transaction at', 'at.trans_id = ba.receive_trans_id')
        ->where('at.trans_id', $trans_id)  // <-- filter on the correct table
        ->get()
        ->row();
}





	// public function get_today_recevable_loanBlanch($blanch_id){
	// 	$today = date("Y-m-d");
	
	// 	$today_recevable = $this->db->query("
	// 		SELECT * 
	// 		FROM tbl_loans l 
	// 		JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	// 		JOIN tbl_customer c ON c.customer_id = l.customer_id
	// 		JOIN tbl_depost p ON p.loan_id = l.loan_id
	// 		WHERE l.loan_status = 'withdrawal' 
	// 		AND l.blanch_id = '$blanch_id' 
	// 		AND l.date_show = '$today'
			
	// 	");
		
	// 	return $today_recevable->result();
	// }

	public function get_today_recevable_loanBlanch($blanch_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer c ON c.customer_id = l.customer_id  WHERE  l.loan_status = 'withdrawal' AND l.blanch_id = '$blanch_id' AND l.date_show ='$today'");
    	return $today_recevable->result();
    }
	




	public function get_sumCashtransDepost($comp_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}



	public function get_sumCashtransDepostBlanch($blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}

	public function get_sumCashtransDepostByOfficer($empl_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost 
								 FROM tbl_prev_lecod 
								 WHERE empl_id = '$empl_id' 
								 AND lecod_day >= '$date'");
		return $cash->row();
	}
	

	public function get_sumCashtransWithdrow($comp_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}


		public function get_sumCashtransWithdrowBlanch($blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day >= '$date'");
		 return $cash->row();
	}

	public function get_sumCashtransWithdrowByOfficer($empl_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrawal 
								 FROM tbl_prev_lecod 
								 WHERE empl_id = '$empl_id' 
								 AND lecod_day >= '$date'");
		return $cash->row();
	}
	



	public function get_companyData($comp_id){
		$comp = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
		   return $comp->row();
	}

		public function get_companyDataProfile($comp_id){
		$comp = $this->db->query("SELECT * FROM tbl_company  WHERE comp_id = '$comp_id'");
		   return $comp->row();
	}

	public function get_blanchData($blanch_id){
		$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
		 return $blanch->row();
	}

	public function get_managerBlanch($blanch_id){
		$blanch = $this->db->query("SELECT blanch_name AS blanchNic_name,blanch_id FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
		 return $blanch->row();
	}

	public function get_employee_data($empl_id)
{
    $query = $this->db->query("
        SELECT e.*, b.*
        FROM tbl_employee e
        JOIN tbl_blanch b ON b.blanch_id = e.blanch_id
        WHERE e.empl_id = ?
    ", array($empl_id));

    return $query->row();
}


	public function update_employee_permissions($employee_id, $new_permissions)
{
    // Delete all old permissions for employee
    $this->db->where('employee_id', $employee_id);
    $this->db->delete('tbl_permission');

    // Insert new permissions
    foreach ($new_permissions as $link_id) {
        $this->db->insert('tbl_permission', [
            'employee_id' => $employee_id,
            'link_id' => $link_id,
        ]);
    }
}



public function get_branches($comp_id)
{
    return $this->db->get_where('tbl_blanch', ['comp_id' => $comp_id])->result();
}

public function getEmployeesBranch($comp_id, $branch_id)
{
    $this->db->select('*');
    $this->db->from('tbl_employee e');
    $this->db->join('tbl_blanch b', 'b.blanch_id = e.blanch_id');
    $this->db->where('e.comp_id', $comp_id);
    $this->db->where('e.blanch_id', $branch_id);
    $this->db->where('e.empl_status', 'open');
    $this->db->where('e.ac_status', 'empl');
    return $this->db->get()->result();
}

public function get_active_customers($comp_id)
{
    $this->db->select('tbl_customer.*');
    $this->db->from('tbl_customer');
    $this->db->join('tbl_loans', 'tbl_loans.customer_id = tbl_customer.customer_id');
    $this->db->where('tbl_customer.comp_id', $comp_id);
    $this->db->where('tbl_loans.loan_status', 'active'); // filter by loan_status
    $this->db->group_by('tbl_customer.customer_id'); // optional, to avoid duplicates if multiple loans
    return $this->db->get()->result();
}


public function get_out_guarantors($comp_id)
{
    $this->db->select('
        s.sp_id,
        s.sp_phone_no,
        s.sp_name,
        s.sp_mname,
        s.sp_lname,
        c.customer_id,
        c.f_name AS cust_fname,
        c.l_name AS cust_lname,
        l.loan_id,
        l.loan_status
    ');
    $this->db->from('tbl_sponser s');
    $this->db->join('tbl_customer c', 'c.customer_id = s.customer_id');
    $this->db->join('tbl_loans l', 'l.customer_id = c.customer_id');
    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'out');
    return $this->db->get()->result();
}


public function get_withdrawal_guarantors($comp_id)
{
    $this->db->select('
        s.sp_id,
        s.sp_phone_no,
        s.sp_name,
        s.sp_mname,
        s.sp_lname,
        c.customer_id,
        c.f_name AS cust_fname,
        c.l_name AS cust_lname,
        l.loan_id,
        l.loan_status
    ');
    $this->db->from('tbl_sponser s');
    $this->db->join('tbl_customer c', 'c.customer_id = s.customer_id');
    $this->db->join('tbl_loans l', 'l.customer_id = c.customer_id');
    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('l.loan_status', 'withdrawal');
    return $this->db->get()->result();
}






	public function get_employee_details($empl_id){
		$empl = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
	   return $empl->row();
	}
	public function get_sponser($customer_id){
		$sponser = $this->db->query("SELECT * FROM tbl_sponser WHERE customer_id = '$customer_id'");
		  return $sponser->row();
	}

	public function get_sponserCustomer($customer_id){
		$sponser = $this->db->query("SELECT * FROM tbl_sponser s  WHERE customer_id = '$customer_id'");
		  return $sponser->result();
	}

	public function get_guarantor_by_id($id)
{
    return $this->db->get_where('tbl_sponser', ['sp_id' => $id])->row();
}

public function update_guarantor($id, $data)
{
    return $this->db->where('sp_id', $id)->update('tbl_sponser', $data);
}




	public function get_sumblanch_wise($comp_id){
		$data = $this->db->query("SELECT SUM(total_loan) AS total_principal_int,b.blanch_id,b.blanch_name,SUM(depost) AS total_dpost FROM tbl_prev_lecod pr JOIN tbl_blanch b  ON b.blanch_id = pr.blanch_id WHERE  pr.comp_id = '$comp_id' GROUP BY b.blanch_id");
		 return $data->result();
	}

	public function get_sumblanch_wiseBlanch($blanch_id){
		$data = $this->db->query("SELECT SUM(pr.total_loan) AS int_loan,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.blanch_id = '$blanch_id'   GROUP BY pr.blanch_id");
		   return $data->result();
	}

	public function has_pending_loans($customer_id)
	{
		return $this->db
			->where('customer_id', $customer_id)
			->where('loan_status !=', 'done')
			->get('tbl_loans')
			->num_rows() > 0;
	}

	 public function get_loan_reminder($customer_id){
 	 	$data = $this->db->query("SELECT c.phone_no,c.f_name,c.m_name,c.l_name FROM tbl_customer c   WHERE c.customer_id = '$customer_id'");
 	 return $data->row();
 	 }

	   public function insert_msamaha($data){
   	return $this->db->insert('tbl_penart_check',$data);
   }
	

	public function get_sum_Depost($comp_id){
		$data = $this->db->query("SELECT SUM(total_loan) AS total_loanData FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
		   return $data->row();
	}

	public function get_sum_DepostBlanch($blanch_id){
		$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' ");
		   return $data->row();
	}

	public function get_sumloanInterest($comp_id){
		$loan_int = $this->db->query("SELECT SUM(depost) AS loan_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
		 return $loan_int->row();
	}

	public function get_sumloanInterestBlanch($blanch_id){
		$loan_int = $this->db->query("SELECT SUM(total_loan) AS loan_interest FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id'");
		 return $loan_int->row();
	}


	 public function search_prev_cashtransaction($from,$to,$comp_id,$blanch_id){
      $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id' AND pr.blanch_id = '$blanch_id'");
      return $previous_cash->result();
     }

      public function search_prev_cashtransaction_empl($from,$to,$comp_id,$blanch_id,$empl_id){
      $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id' AND pr.blanch_id = '$blanch_id' AND pr.empl_id = '$empl_id'");
      return $previous_cash->result();
     }

     // public function search_prev_cashtransaction($from,$to,$comp_id){
     //  $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id'");
     //  return $previous_cash->result();
     // }

      public function search_prev_cashtransactionBlanch($from,$to,$blanch_id){
      $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.blanch_id = '$blanch_id'");
      return $previous_cash->result();
     }

     public function search_previous_cashInHand($from,$to,$blanch_id){
      $previous_cashinhand = $this->db->query("SELECT * FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.blanch_id = '$blanch_id'");
      return $previous_cashinhand->result();
     }

      public function search_previous_cashInHandCompany($from,$to,$comp_id){
      $previous_cashinhand = $this->db->query("SELECT * FROM  tbl_cash_inhand ch JOIN tbl_employee e ON e.empl_id = ch.empl_id JOIN tbl_blanch b ON b.blanch_id = ch.blanch_id WHERE ch.cash_day between  '$from' and '$to'AND ch.comp_id = '$comp_id'");
      return $previous_cashinhand->result();
     }



      public function search_Sum_previous_cashInHand($from,$to,$blanch_id){
      $previous_cashinhand = $this->db->query("SELECT SUM(cash_amount) AS total_cashInHand FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.blanch_id = '$blanch_id'");
      return $previous_cashinhand->row();
     }

     public function search_Sum_previous_cashInHandCompany($from,$to,$comp_id){
      $previous_cashinhand = $this->db->query("SELECT SUM(cash_amount) AS total_cashInHand FROM  tbl_cash_inhand ch  WHERE ch.cash_day between  '$from' and '$to'AND ch.comp_id = '$comp_id'");
      return $previous_cashinhand->row();
     }

     public function get_today_cashCompany($comp_id){
     	$date = date("Y-m-d");
     	$cash_data = $this->db->query("SELECT * FROM tbl_cash_inhand ch JOIN tbl_blanch b ON b.blanch_id = ch.blanch_id JOIN tbl_employee e ON e.empl_id = ch.empl_id WHERE ch.comp_id = '$comp_id' AND ch.cash_day = '$date'");
     	 return $cash_data->result();
     }

     public function get_sumCashCompany($comp_id){
     	$date = date("Y-m-d");
     	$cash = $this->db->query("SELECT SUM(cash_amount) AS total_cashInhand FROM tbl_cash_inhand WHERE comp_id = '$comp_id' AND cash_day = '$date'");
     	  return $cash->row();
     }



     public function get_blanchwise_previous($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_loans,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id' GROUP BY pr.blanch_id");
     	  return $data->result();
     }

     public function get_blanchwise_previousBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_loans,SUM(pr.depost) AS sum_depost,b.blanch_name FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id' GROUP BY pr.blanch_id");
     	  return $data->result();
     }

     public function get_blanchwise_Totalreceivable($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_receivable FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id'");
     	  return $data->row();
     }

     public function get_blanchwise_TotalreceivableBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.total_loan) AS total_receivable FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id'");
     	  return $data->row();
     }

      public function get_blanchwise_Totalreceved($from,$to,$comp_id){
     	$data = $this->db->query("SELECT SUM(pr.depost) AS total_receved FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.comp_id = '$comp_id'");
     	  return $data->row();
     }

       public function get_blanchwise_TotalrecevedBlanch($from,$to,$blanch_id){
     	$data = $this->db->query("SELECT SUM(pr.depost) AS total_receved FROM tbl_prev_lecod pr WHERE pr.lecod_day between '$from' and '$to' AND pr.blanch_id = '$blanch_id'");
     	  return $data->row();
     }


     public function get_sumCashtransDepostPrvious($from,$to,$comp_id,$blanch_id){
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}

	 public function get_sumCashtransDepostPrvious_empl($from,$to,$comp_id,$blanch_id,$empl_id){
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id' AND empl_id = '$empl_id'");
		 return $cash->row();
	}

	    public function get_sumCashtransDepostPrviousBlanch($from,$to,$blanch_id){
		$cash = $this->db->query("SELECT SUM(depost) AS cash_depost FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}


	public function get_sumCashtransWithdrowPrevious($from,$to,$comp_id,$blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}


	public function get_sumCashtransWithdrowPrevious_empl($from,$to,$comp_id,$blanch_id,$empl_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND comp_id = '$comp_id' AND blanch_id = '$blanch_id' AND empl_id = '$empl_id'");
		 return $cash->row();
	}

	public function get_loanWithdrawal_date($blanch_id,$from,$to,$empl_id){
		$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN  tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.disburse_day between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.empl_id = '$empl_id'");
		return $data->result();
	}

	public function get_loanWithdrawal_date_all($blanch_id,$from,$to){
		$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN  tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.disburse_day between '$from' and '$to' AND l.blanch_id = '$blanch_id'");
		return $data->result();
	}


	public function get_sumCashtransWithdrowPreviousBlanch($from,$to,$blanch_id){
		$date = date("Y-m-d");
		$cash = $this->db->query("SELECT SUM(withdraw) AS cash_withdrowal FROM tbl_prev_lecod WHERE lecod_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
		 return $cash->row();
	}

	public function get_pending_reportLoan($comp_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp JOIN tbl_customer c ON c.customer_id = lp.customer_id JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id WHERE lp.comp_id = '$comp_id' AND action_date >='$pend'");
		 return $data->result();
	}

	// public function get_pending_reportLoan($comp_id){
	// 	$pend = date("Y-m-d");
	// 	$data = $this->db->query("SELECT COUNT(lp.pend_id) AS pend,b.blanch_name,c.f_name,c.m_name,c.l_name,c.phone_no,lp.total_loan,lp.return_day,lp.return_total,lp.pend_date FROM tbl_loan_pending lp JOIN tbl_customer c ON c.customer_id = lp.customer_id JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id WHERE lp.comp_id = '$comp_id' AND pend_date >='$pend' GROUP BY c.customer_id");
	// 	 return $data->result();
	// }

	// public function count_pending($com){
	// 	$count_data = $this->db->query("SELECT COUNT(pend_id) AS pend FROM tbl_pending WHERE customer_id = '$customer_id'");
	// 	return $count_data->row();
	// }

	public function get_pending_reportLoanblanch($blanch_id){
		$pend = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_loan_pending lp JOIN tbl_customer c ON c.customer_id = lp.customer_id JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id WHERE lp.blanch_id = '$blanch_id' AND action_date >='$pend'");
		 return $data->result();
	}



	public function get_manager_data($empl_id){
		$data = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_company c ON c.comp_id = e.comp_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE empl_id = '$empl_id'");
		  return $data->row();
	}


	public function get_compan_data($comp_id) {
		$query = $this->db->query("
			SELECT * 
			FROM tbl_employee e 
			JOIN tbl_company c ON c.comp_id = e.comp_id 
			JOIN tbl_blanch b ON b.blanch_id = e.blanch_id 
			WHERE e.comp_id = '$comp_id'
		");
		return $query->row(); // Return a single row
	}
	


	public function update_loanfee($fee_id,$data){
		return $this->db->where('fee_id',$fee_id)->update('tbl_loan_fee',$data);
	}

public function remove_loan_fee($fee_id){
	return $this->db->delete('tbl_loan_fee',['fee_id'=>$fee_id]);
}


public function update_account($account_id,$data){
	return $this->db->where('account_id',$account_id)->update('tbl_account_type',$data);
}


 public function remove_accountType($account_id){
 	return $this->db->delete('tbl_account_type',['account_id'=>$account_id]);
 }

 public function update_group($group_id,$data){
 	return $this->db->where('group_id',$group_id)->update('tbl_group',$data);
 }

 public function remove_group($group_id){
 	return $this->db->delete('tbl_group',['group_id'=>$group_id]);
 }

 public function update_loanCategory($category_id,$data){
 	return $this->db->where('category_id',$category_id)->update('tbl_loan_category',$data);
 }

 public function remove_loacategory($category_id){
 	return $this->db->delete('tbl_loan_category',['category_id'=>$category_id]);
 }

 public function update_employee($empl_id,$data){
 	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
 }

 public function remove_employee($empl_id){
 	return $this->db->delete('tbl_employee',['empl_id'=>$empl_id]);
 }


 public function update_sponser($sp_id,$data){
 	return $this->db->where('sp_id',$sp_id)->update('tbl_sponser',$data);
 }

 public function get_search_dataCustomer($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id  JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.customer_id = '$customer_id'");
 	return $data->result();
 }


  public function get_sum_depostLoan($loan_id){
    	$loan = $this->db->query("SELECT SUM(p.depost) AS depos FROM tbl_prev_lecod p  WHERE p.loan_id = '$loan_id'  GROUP BY p.loan_id ");
    	 return $loan->row();
    }

    //manager position

      public function get_blanch_loanpend($comp_id){
       	$loan_pending = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_company c ON c.comp_id = l.comp_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_customer ca ON ca.customer_id = l.customer_id JOIN tbl_sub_customer sc ON sc.customer_id = l.customer_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'open' ORDER BY l.loan_id DESC ");
       	 return $loan_pending->result();
       }


       public function get_blanch_loanAproved($comp_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_loan_category lt ON lt.category_id = l.category_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer s ON s.customer_id = l.customer_id  WHERE l.comp_id = '$comp_id'AND l.loan_status = 'aproved' ORDER BY l.loan_id DESC ");
       	   return $loan->result();
       }

       public function get_sum_loan_Aproved($comp_id){
         $total_aproved = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'aproved'");
          return $total_aproved->row();
       }

       public function get_loan_customer($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id JOIN tbl_account_type at ON at.account_id = sc.account_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id  WHERE l.customer_id = '$customer_id'");
       	return $data->result();
       }


       public function get_loanExpectation($comp_id){
       	$exp = $this->db->query("SELECT SUM(loan_int) AS loan_interest FROM tbl_loans l  WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
       	  return $exp->row();
       }

        public function get_loanExpectationBlanch($blanch_id){
       	$exp = $this->db->query("SELECT SUM(pr.total_loan) AS loan_interestBlanch FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE pr.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
       	  return $exp->row();
       }


       public function get_sum_Outloan($comp_id){
       	$out = $this->db->query("SELECT SUM(blanch_amount) AS sum_float FROM  tbl_transfor WHERE comp_id = '$comp_id'");
       	 return $out->row();
       }


       public function get_with_done_principal($comp_id){
       	$principal = $this->db->query("SELECT SUM(loan_aprove) AS principal FROM tbl_loans WHERE comp_id = '$comp_id' AND region_id = 'ok'");
       	  return $principal->row();
       }

       public function get_total_loanDepost($comp_id){
       	$loan_receved = $this->db->query("SELECT SUM(depost) AS sum_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
       	  return $loan_receved->row();
       }


public function get_loan_day($loan_id) {
    $this->db->select('
        l.*, 
        c.*, 
        s.*, 
        o.*
    ');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_sponser s', 's.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->where('l.loan_id', $loan_id);

    $query = $this->db->get();
    return $query->row();
}



public function get_upBalance_Data($customer_id){
	$balance = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id' ORDER BY pay_id DESC");
	 return $balance->row();
}

public function get_loan_done($customer_id){
	$loan_done = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
	 return $loan_done->row();
}

public function get_new_customers_for_officer($blanch_id, $empl_id) {
    $query = $this->db->query("
        SELECT c.*, COUNT(l.loan_id) AS total_loans
        FROM tbl_customer c
        LEFT JOIN tbl_loans l ON l.customer_id = c.customer_id
        WHERE c.blanch_id = ? AND c.empl_id = ?
        GROUP BY c.customer_id
        HAVING total_loans <=  1
        ORDER BY c.customer_id DESC
    ", array($blanch_id, $empl_id));

    return $query->result();
}

public function count_customers_with_one_loan_today($blanch_id, $empl_id) {
    $today = date("Y-m-d");
    $query = $this->db->query("
        SELECT COUNT(*) AS total_customers
        FROM (
            SELECT c.customer_id
            FROM tbl_customer c
            LEFT JOIN tbl_loans l ON l.customer_id = c.customer_id AND DATE(l.loan_day) = ?
            WHERE c.blanch_id = ? AND c.empl_id = ?
            GROUP BY c.customer_id
            HAVING COUNT(l.loan_id) = 1
        ) AS subquery
    ", array($today, $blanch_id, $empl_id));

    return $query->row()->total_customers;
}



public function get_new_customers_for_branchmanager($blanch_id) {
    $query = $this->db->query("
        SELECT c.*, COUNT(l.loan_id) AS total_loans
        FROM tbl_customer c
        LEFT JOIN tbl_loans l ON l.customer_id = c.customer_id
        WHERE c.blanch_id = ?
        GROUP BY c.customer_id
        HAVING total_loans <= 1
        ORDER BY c.customer_id DESC
    ", array($blanch_id));

    return $query->result();
}

public function count_customers_completed_loan_today($blanch_id) {
    $today = date("Y-m-d");
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON l.customer_id = c.customer_id
        WHERE c.blanch_id = ?
          AND l.loan_status = 'done'
          AND DATE(l.loan_day) = ?
    ", array($blanch_id, $today));

    return $query->row()->total_customers;
}

public function count_customers_completed_loan_today_officer($blanch_id, $empl_id) {
    $today = date("Y-m-d");
    $query = $this->db->query("
        SELECT COUNT(DISTINCT c.customer_id) AS total_customers
        FROM tbl_customer c
        JOIN tbl_loans l ON l.customer_id = c.customer_id
        WHERE c.blanch_id = ?
          AND c.empl_id = ?
          AND l.loan_status = 'done'
          AND DATE(l.loan_day) = ?
    ", array($blanch_id, $empl_id, $today));

    return $query->row()->total_customers;
}



public function count_new_customers_by_customer_id_today($blanch_id) {
    $today = date("Y-m-d");
    $query = $this->db->query("
        SELECT COUNT(*) AS total_customers
        FROM (
            SELECT c.customer_id
            FROM tbl_customer c
            LEFT JOIN tbl_loans l ON l.customer_id = c.customer_id AND DATE(l.loan_day) = ?
            WHERE c.blanch_id = ?
            GROUP BY c.customer_id
            HAVING COUNT(l.loan_id) = 1
        ) AS new_customers
    ", array($today, $blanch_id));

    return $query->row()->total_customers;
}


public function count_done_loans_with_today_deposit_by_branch($branch_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT l.customer_id) AS total_customers
        FROM tbl_loans l
        JOIN tbl_depost d ON l.customer_id = d.customer_id
        JOIN tbl_customer c ON l.customer_id = c.customer_id
        WHERE l.loan_status = 'done'
        AND DATE(d.depost_day) = CURDATE()
        AND c.blanch_id = ?
    ", [$branch_id]);

    return $query->row()->total_customers;
}


public function count_done_loans_with_today_deposit_by_officer($empl_id) {
    $query = $this->db->query("
        SELECT COUNT(DISTINCT l.customer_id) AS total_customers
        FROM tbl_loans l
        JOIN tbl_depost d ON l.customer_id = d.customer_id
        JOIN tbl_customer c ON l.customer_id = c.customer_id
        WHERE l.loan_status = 'done'
        AND DATE(d.depost_day) = CURDATE()
        AND c.empl_id = ?
    ", [$empl_id]);

    return $query->row()->total_customers;
}



public function get_repayment_data($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.comp_id = '$comp_id' AND l.loan_status = 'done'");
	  return $data->result();
}

public function get_repayment_dataBlanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'done'");
	  return $data->result();
}


public function get_total_loanDone($comp_id){
	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'done'");
	  return $repay->row();
}

public function get_total_loanDoneBlanch($blanch_id){
	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $repay->row();
}


public function get_sum_totalloanInterst($comp_id){
	$total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'done'");
	  return $total_int->row();
}

public function get_sum_totalloanInterstBlanch($blanch_id){
	$total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $total_int->row();
}


 public function get_previous_repayments($from,$to,$comp_id){
     	$prev_rep = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.return_date between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'done'");
     	  return $prev_rep->result();
     }

      public function get_previous_repaymentsBlanch($from,$to,$blanch_id){
     	$prev_rep = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'done'");
     	  return $prev_rep->result();
     }

     public function get_sumprev_loanAprove($from,$to,$comp_id){
     	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE return_date between '$from' and '$to' AND comp_id = '$comp_id' AND loan_status = 'done'");
	  return $repay->row();
     }

      public function get_sumprev_loanAproveBlanch($from,$to,$blanch_id){
     	$repay = $this->db->query("SELECT SUM(loan_aprove) AS aprovedLoan FROM tbl_loans WHERE return_date between '$from' and '$to' AND blanch_id = '$blanch_id' AND loan_status = 'done'");
	  return $repay->row();
     }

     public function get_sum_prevtotalLoansint($from,$to,$comp_id){
     $total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE return_date between '$from' and '$to' AND comp_id = '$comp_id' AND loan_status = 'done'");
	    return $total_int->row();
     }

       public function get_sum_prevtotalLoansintBlanch($from,$to,$blanch_id){
     $total_int = $this->db->query("SELECT SUM(loan_int) AS loan_interestData FROM tbl_loans WHERE return_date between '$from' and '$to' AND blanch_id = '$blanch_id' AND loan_status = 'done'");
	    return $total_int->row();
     }


     public function get_payDatastatement($customer_id){
     	$pay_data = $this->db->query("SELECT * FROM tbl_pay WHERE customer_id = '$customer_id'");
     	return $pay_data->result();
     }


	    public function get_loan_account_statement($loan_id){
     	$data = $this->db->query("SELECT l.loan_id,l.loan_int,l.restration,l.customer_id,ot.loan_stat_date,ot.loan_end_date,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.loan_id = '$loan_id' LIMIT 1");
     	return $data->row();
     }



	 public function get_latest_done_loan($customer_id)
{
    return $this->db
        ->select('*')
        ->from('tbl_loans')
        ->where('customer_id', $customer_id)
        ->where('loan_status', 'done')
        ->order_by('loan_id', 'DESC')
        ->limit(1)
        ->get()
        ->row();
}


	

public function get_paycustomerNotfee_Statement($customer_id, $loan_id)
{
    $this->db->select('p.*, l.*, at.*, pen.*');
    $this->db->from('tbl_pay p');
    $this->db->join('tbl_loans l', 'l.loan_id = p.loan_id');
    $this->db->join('tbl_account_transaction at', 'at.trans_id = p.p_method', 'left');
    $this->db->join('tbl_penat pen', 'pen.comp_id = p.comp_id', 'left');

    $this->db->where('p.customer_id', $customer_id);
    $this->db->where('p.loan_id', $loan_id);

    // 🔹 Skip penalty display for these descriptions
    // $this->db->where_not_in('p.description', [
    //     'CASH WITHDRAWALS',
    //     'SYSTEM WITHDRAWAL',
	// 	'AUTO CRON REMAIN DEBT',
    //     'CASH DEPOST'
    // ]);

    $this->db->group_by(['p.loan_id', 'p.pay_day', 'p.description', 'p.depost', 'p.pay_id']);
    $this->db->order_by('p.pay_id', 'DESC');

    $query = $this->db->get();
    return $query->result();
}




        public function get_customer_datareport($customer_id){
        	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_sub_customer sc ON sc.customer_id =c.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id   WHERE c.customer_id = '$customer_id'");
        	return $data->row();
        }


    //       public function insert($data = array()){ 
    //     $insert = $this->db->insert_batch('tbl_collelateral',$data); 
    //     return $insert?true:false; 
    // } 

        public function insert($data){
        	return $this->db->insert('tbl_collelateral',$data);
        }
    
public function insert_localgov_details($data){
	return $this->db->insert('tbl_attachment',$data);
}

public function get_colateral_data($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_collelateral WHERE loan_id = '$loan_id'");
	  return $data->result();
}


public function update_collateral($data,$col_id){
	return $this->db->where('col_id',$col_id)->update('tbl_collelateral',$data);
}

 public function get_loacagovment_data($loan_id){
 	$local_gov = $this->db->query("SELECT * FROM tbl_attachment JOIN tbl_region ON tbl_region.region_id = tbl_attachment.region_oficer WHERE loan_id = '$loan_id'");
 	  return $local_gov->row();
 }


 public function remove_collateral($col_id){
 	return $this->db->delete('tbl_collelateral',['col_id'=>$col_id]);
 }


 public function remove_loandisbursed($loan_id){
 	return $this->db->delete('tbl_loans',['loan_id'=>$loan_id]);
 }




  	public  function data_download($params = array()){
        $this->db->select('*');
        $this->db->from('tbl_attachment');
        //$this->db->where('status','no');
        //$this->db->order_by('attach_date','desc');
        if(array_key_exists('attach_id',$params) && !empty($params['attach_id'])){
            $this->db->where('attach_id',$params['attach_id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
    }

    public function get_Allemployee_salary($comp_id){
	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b  ON b.blanch_id = e.blanch_id JOIN tbl_position p ON p.position_id = e.position_id WHERE e.comp_id = '$comp_id' AND e.empl_status = 'open' ORDER BY e.empl_id DESC ");
	  return $empl->result();
}

public function get_sum_salary($comp_id){
	$data = $this->db->query("SELECT SUM(salary) AS total_pay FROM tbl_employee WHERE comp_id = '$comp_id'");
	  return $data->row();
}

public function insert_allowance($data){
	return $this->db->insert('tbl_new_allownce',$data);
}

public function get_all_allowance($comp_id){
	$allowance = $this->db->query("SELECT * FROM tbl_new_allownce a JOIN tbl_employee e ON e.empl_id = a.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id  WHERE a.comp_id = '$comp_id' ORDER BY a.alow_id DESC");
	 return $allowance->result();
}

public function insert_deduction($data){
	return $this->db->insert('tbl_deduction',$data);
}

public function get_deduction_empl($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_deduction d JOIN tbl_employee e ON e.empl_id = d.empl_id JOIN tbl_blanch b ON b.blanch_id = e.blanch_id WHERE d.comp_id = '$comp_id'");
	 return $data->result();
}


public function get_sumdeduction($comp_id){
	$sum_deduction = $this->db->query("SELECT SUM(amount) AS total_deduction FROM tbl_deduction WHERE comp_id = '$comp_id'");
	 return $sum_deduction->row();
}

public function insert_expenses($data){
	return $this->db->insert('tbl_expenses',$data);
}

public function get_expenses($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_expenses WHERE comp_id = '$comp_id'");
	 return $data->result();
}


public function update_expenses($data,$ex_id){
	return $this->db->where('ex_id',$ex_id)->update('tbl_expenses',$data);
}

public function remove_expenses($ex_id){
	return $this->db->delete('tbl_expenses',['ex_id'=>$ex_id]);
}


public function get_expences_request($comp_id){
	$date = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$date' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestManager($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.comp_id = '$comp_id' AND re.req_status = 'open' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestAccepted($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestNotDone($comp_id){
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_status = 'open' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_expences_requestBlanch($blanch_id){
	$day = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.blanch_id = '$blanch_id' AND re.req_date >= '$day' ORDER BY re.req_id DESC");
	 return $expences->result();
}


public function get_expences_requestBlanchuniq($blanch_id){
	$day = date("Y-m-d");
	$expences = $this->db->query("SELECT * FROM tbl_request_exp re JOIN tbl_expenses e ON e.ex_id = re.ex_id JOIN tbl_blanch b ON b.blanch_id = re.blanch_id JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date >= '$day' ORDER BY re.req_id DESC");
	 return $expences->result();
}

public function get_recomended_status($req_id){
	$data = $this->db->query("SELECT * FROM tbl_request_exp WHERE req_id = $req_id ");
	 return $data->row();
}

public function update_requet_status($req_id,$data){
	return $this->db->where('req_id',$req_id)->update('tbl_request_exp',$data);
}


public function remove_expences($req_id){
	return $this->db->delete('tbl_request_exp',['req_id'=>$req_id]);
}


public function insert_income($data){
	return $this->db->insert('tbl_income',$data);
}

public function get_income($comp_id){
	$income = $this->db->query("SELECT * FROM tbl_income WHERE comp_id = '$comp_id'");
	 return $income->result();
}


public function update_income($data,$inc_id){
	return $this->db->where('inc_id',$inc_id)->update('tbl_income',$data);
}

public function remove_income($inc_id){
	return $this->db->delete('tbl_income',['inc_id'=>$inc_id]);
}

public function insert_income_detail($data){
	return $this->db->insert('tbl_receve',$data);
}

public function get_blanchAccountremain($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_income_detail($comp_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = r.empl LEFT JOIN tbl_loans l ON l.loan_id = r.loan_id WHERE r.comp_id = '$comp_id' AND r.receve_day = '$date'");
	 return $income->result();
}


public function get_sum_previousIncome_blanch($from,$to,$comp_id,$blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved_blanch FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
	 return $data->row();
}


public function get_sum_previousIncome_COMP($from,$to,$comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved_blanch FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id'");
	 return $data->row();
}

public function get_previous_income_all($from,$to,$comp_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id' GROUP BY r.blanch_id");
	 return $income->result();
}

public function get_income_detailBlanchData($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id  WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date'");
	 return $income->result();
}


public function get_income_detailBlanch($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$date'");
	 return $income->result();
}


public function update_income_detail($data,$receved_id){
	return $this->db->where('receved_id',$receved_id)->update('tbl_receve',$data);
}

public function remove_receved($receved_id){
	return $this->db->delete('tbl_receve',['receved_id'=>$receved_id]);
}

public function get_sum_income($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$date'");
	 return $data->row();
}

public function get_sum_incomeBlanchData($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day ='$date'");
	 return $data->row();
}

public function get_sum_incomeBlanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day >=$date");
	 return $data->row();
}


public function get_sumtotal_interest($comp_id){
	$data = $this->db->query("SELECT SUM(total_int) AS total_interest FROM tbl_prev_lecod  pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE l.loan_status = 'done' AND pr.comp_id = '$comp_id'");
	 return $data->row();
}

public function get_sumtotal_interestBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(total_int) AS total_interest FROM tbl_prev_lecod  pr JOIN tbl_loans l ON l.loan_id = pr.loan_id WHERE l.loan_status = 'done' AND pr.blanch_id = '$blanch_id'");
	 return $data->row();
}


public function get_sum_Comp_income($comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE comp_id = '$comp_id'");
	 return $data->row();
}

public function get_sum_Comp_incomeBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}


public function get_total_loanFee($comp_id){
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE comp_id = '$comp_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

//blanch loanfee open
public function get_total_loanFeeBlanchOpen($blanch_id){
	$date = date("Y-m-d");
   $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$back' AND  fee_id IS NOT NULL");
	 return $data_loan->row();

	}

	//blanch loanfee open
public function blanch_loan_fee($blanch_id){
	$date = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();

	}



public function get_total_loanFeeClose($comp_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdrawclose FROM  tbl_pay  WHERE comp_id = '$comp_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}
//blanch close
public function get_total_loanFeeCloseBlanch($blanch_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdrawclose FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

//blanch close
public function get_total_loanFeeCloseBlanchData($blanch_id){
	$day = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_incomeLoanfee FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND date_data = '$day' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}

public function get_total_loanFeeBlanch($blanch_id){
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND  fee_id IS NOT NULL");
	 return $data_loan->row();
}


public function get_sum_requestExpences($comp_id){
	$exp = $this->db->query("SELECT SUM(req_amount) AS total_request FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
	  return $exp->row();
}


public function get_sum_requestExpencesBlanch($blanch_id){
	$exp = $this->db->query("SELECT SUM(req_amount) AS total_request FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'accept'");
	  return $exp->row();
}



public function get_sum_IncomeData($comp_id){
	$income = $this->db->query("SELECT SUM(r.receve_amount) AS total_income,i.inc_name  FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.comp_id = '$comp_id' GROUP BY r.inc_id");
	 return $income->result();
}

public function get_sum_IncomeDataBlanch($blanch_id){
	$income = $this->db->query("SELECT SUM(r.receve_amount) AS total_income,i.inc_name  FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' GROUP BY r.inc_id");
	 return $income->result();
}

public function get_total_loanFeeData($comp_id){
	$loan_fee = $this->db->query("SELECT SUM(withdrow) AS total_loanFee,lf.description,lf.fee_interest FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.comp_id = '$comp_id' GROUP BY p.fee_id");
	 return $loan_fee->result();
}
public function get_total_loanFeeDataBlanch($blanch_id){
	$loan_fee = $this->db->query("SELECT SUM(withdrow) AS total_loanFee,lf.description,lf.fee_interest FROM tbl_pay p JOIN tbl_loan_fee lf ON lf.fee_id = p.fee_id WHERE p.blanch_id = '$blanch_id' GROUP BY p.fee_id");
	 return $loan_fee->result();
}

public function get_total_ExpencesData($comp_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_exp,ex.ex_name FROM tbl_request_exp rx JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.comp_id = '$comp_id' AND rx.req_status = 'accept' GROUP BY rx.ex_id");
	 return $expences->result();
}

public function get_total_ExpencesDataBlanch($blanch_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_exp,ex.ex_name FROM tbl_request_exp rx JOIN tbl_expenses ex ON ex.ex_id = rx.ex_id WHERE rx.blanch_id = '$blanch_id' AND rx.req_status = 'accept' GROUP BY rx.ex_id");
	 return $expences->result();
}



public function update_company_Data($data,$comp_id){
	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
}


//update password

public function update_password_data($comp_id, $userdata)
    {
        $this->db->where('comp_id', $comp_id);
        $this->db->update('tbl_company', $userdata);
    }

    public function update_password_dataEmployee($empl_id, $userdata)
    {
        $this->db->where('empl_id', $empl_id);
        $this->db->update('tbl_employee', $userdata);
    }


       public function get_user_data($comp_id)
    {
        $this->db->where('comp_id', $comp_id);
        $query = $this->db->get('tbl_company');
        return $query->row();
    }

    public function insert_penarty($data){
    	return $this->db->insert('tbl_penat',$data);
    }

    public function get_penarty($comp_id){
    	$data = $this->db->query("SELECT * FROM tbl_penat WHERE comp_id = '$comp_id'");
    	 return $data->row();
    }

    public function update_penarty($data,$penalt_id){
    	return $this->db->where('penalt_id',$penalt_id)->update('tbl_penat',$data);
    }

    public function remove_penart($penalt_id){
    	return $this->db->delete('tbl_penat',['penalt_id'=>$penalt_id]);
    }


    public function get_sun_loanPending($comp_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >='$pend'");
    	return $pending->row();

    }

    public function get_sun_loanPendingPrev($from,$to,$blanch_id){
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE pend_date between '$from' and '$to' AND blanch_id ='$blanch_id'");
    	return $pending->row();

    }




    public function get_sun_loanPendingBlanch($blanch_id){
    	$pend = date("Y-m-d");
    	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE blanch_id = '$blanch_id' AND action_date >='$pend'");
    	return $pending->row();

    }



public function get_today_recevable_loan($comp_id, $blanch_id = null)
{
    $today = date("Y-m-d");

    $this->db->select('l.*, 
                       b.blanch_name, 
                       c.f_name, c.m_name, c.l_name, c.phone_no, 
                       e.empl_name, 
                       SUM(d.depost) AS total_deposit, 
                       MAX(o.loan_end_date) AS loan_end_date, 
                       MAX(o.loan_stat_date) AS loan_stat_date,
                       DATEDIFF(MAX(o.loan_end_date), CURDATE()) AS remain_days');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_depost d', 'd.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');

    $this->db->where('l.date_show', $today);
    $this->db->where('l.loan_status', 'withdrawal');
    $this->db->where('l.comp_id', $comp_id);

    // Branch-only filter
    if (!empty($blanch_id)) {
        $this->db->where('l.blanch_id', $blanch_id);
    }

    $this->db->group_by('l.loan_id');

    return $this->db->get()->result();
}


public function get_week_ending_loans($comp_id)
{
    $today = date("Y-m-d");
    $next7days = date("Y-m-d", strtotime('+6 days')); // today + 6 days = 7 days total

    $this->db->select('l.*, 
                       b.blanch_name, 
                       c.f_name, c.m_name, c.l_name, c.phone_no, 
                       e.empl_name, 
                       SUM(CASE WHEN DATE(o.loan_end_date) BETWEEN "'.$today.'" AND "'.$next7days.'" THEN d.depost ELSE 0 END) AS total_deposit, 
                       MAX(o.loan_end_date) AS loan_end_date, 
                       MAX(o.loan_stat_date) AS loan_stat_date,
                       DATEDIFF(MAX(o.loan_end_date), CURDATE()) AS remain_days');
                       
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_depost d', 'd.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');

    // Filter loans ending in the next 7 days including today
    $this->db->where('DATE(o.loan_end_date) >=', $today);
    $this->db->where('DATE(o.loan_end_date) <=', $next7days);

    $this->db->where('l.loan_status', 'withdrawal');
    $this->db->where('l.comp_id', $comp_id);

    $this->db->group_by('l.loan_id');

    return $this->db->get()->result();
}






public function get_next7days_ending_loans_restriction($comp_id)
{
    // Get today and 7 days from today
    $today = date('Y-m-d');
    $next7days = date('Y-m-d', strtotime('+6 days'));

    $this->db->select_sum('tbl_loans.restration', 'total_restration');
    $this->db->from('tbl_loans');
    $this->db->join('tbl_outstand', 'tbl_outstand.loan_id = tbl_loans.loan_id', 'left');

    // Filter loans ending in the next 7 days (ignore time)
    $this->db->where('DATE(tbl_outstand.loan_end_date) >=', $today);
    $this->db->where('DATE(tbl_outstand.loan_end_date) <=', $next7days);

    $this->db->where('tbl_loans.loan_status', 'withdrawal');
    $this->db->where('tbl_loans.comp_id', $comp_id);

    $query = $this->db->get();
    return $query->row()->total_restration ?? 0;
}




















   
    public function get_today_recevable_employee_data($empl_id,$comp_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.empl_id = '$empl_id' AND l.comp_id = '$comp_id'");
    	return $today_recevable->result();
    }

    public function get_today_recevable_employee_data_total($empl_id,$comp_id){
    	$today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT SUM(restration) AS total_restration FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.empl_id = '$empl_id' AND l.comp_id = '$comp_id'");
    	return $today_recevable->row();
    }




    public function get_today_recevable_employee($comp_id){
      $today = date("Y-m-d");
    	//$date = $today_data->format("Y-m-d");
    	$today_recevable = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id  WHERE l.date_show ='$today' AND l.loan_status = 'withdrawal' AND l.comp_id = '$comp_id' GROUP BY l.empl_id");
    	return $today_recevable->result();
    }

 
	public function get_today_recevable_loanBlanch_by_officer($blanch_id, $empl_id){
		$today = date("Y-m-d");
		$today_receivable = $this->db->query("
			SELECT * 
			FROM tbl_loans l 
			JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
			JOIN tbl_customer c ON c.customer_id = l.customer_id  
			WHERE l.loan_status = 'withdrawal' 
			AND l.blanch_id = '$blanch_id' 
			AND l.empl_id = '$empl_id'
			AND l.date_show = '$today'
		");
		return $today_receivable->result();
	}
	
	public function get_today_recevable_loan_branchwise($comp_id){
		$today = date("Y-m-d");
	
		$query = $this->db->query("
			SELECT 
				b.blanch_id,
				b.blanch_name,
				SUM(l.restration) AS total_restration
			FROM 
				tbl_loans l
			LEFT JOIN 
				tbl_blanch b ON b.blanch_id = l.blanch_id
			LEFT JOIN 
				tbl_customer c ON c.customer_id = l.customer_id
			LEFT JOIN 
				tbl_employee e ON e.empl_id = l.empl_id
			WHERE 
				l.date_show = '$today' 
				AND l.loan_status = 'withdrawal' 
				AND l.comp_id = '$comp_id'
			GROUP BY 
				b.blanch_id, b.blanch_name
		");
	
		return $query->result();
	}
	


    public function get_total_recevable($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }


    public function get_total_recevableBl($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }




		public function get_depositing_out_total_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(d.depost) AS total_default FROM tbl_depost d LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$date' AND d.dep_status = 'out'");
		return $data->row();
	}

	public function get_depositing_out_total_officer($empl_id){
    $date = date("Y-m-d");

    $data = $this->db->query("
        SELECT SUM(d.depost) AS total_default 
        FROM tbl_depost d 
        LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id 
        LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method 
        LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id 
        WHERE c.empl_id = ? 
        AND d.depost_day = ? 
        AND d.dep_status = 'out'
    ", [$empl_id, $date]);

    return $data->row();
}




public function get_depositing_sugu_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT COUNT(d.dep_id) AS total_sugu FROM tbl_depost d LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id  LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$date' AND d.dep_status = 'out'");
		return $data->row();
	}


  public function get_total_recevableBlanch($blanch_id){
    $date = date("Y-m-d");
    $today_data = $this->db->query("
        SELECT COALESCE(SUM(restration), 0) AS total_rejesho  
        FROM tbl_loans 
        WHERE blanch_id = '$blanch_id' 
        AND loan_status = 'withdrawal' 
        AND date_show = '$date'
    ");
    return $today_data->row(); // this will now return object with total_rejesho = 0 if nothing found
}


	
public function get_total_recevableBlanch_by_officer($blanch_id, $empl_id){
    $date = date("Y-m-d");
    $today_data = $this->db->query("
        SELECT COALESCE(SUM(restration), 0) AS total_rejesho  
        FROM tbl_loans 
        WHERE blanch_id = '$blanch_id' 
        AND empl_id = '$empl_id' 
        AND loan_status = 'withdrawal' 
        AND date_show = '$date'
    ");
    return $today_data->row(); // same here
}

	

	public function get_total_recevableByOfficer($empl_id) {
		$date = date("Y-m-d");
		$query = $this->db->query("
			SELECT SUM(restration) AS total_rejesho
			FROM tbl_loans
			WHERE empl_id = ? AND loan_status = 'withdrawal' AND date_show = ?
		", [$empl_id, $date]);
	
		return $query->row();
	}
	
	
  public function get_total_penart_data($loan_id){
        $data = $this->db->query("SELECT SUM(return_total) AS Total_Penart FROM tbl_loan_pending WHERE loan_id = '$loan_id'");
        return $data->row();
   }





   public function get_total_penart_paid_loan($loan_id){
   	$data = $this->db->query("SELECT SUM(penart_paid) AS total_PaidPenart FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
   	return $data->row();
   }


   public function get_penart_check($loan_id){
   	$data = $this->db->query("SELECT * FROM tbl_penart_check WHERE loan_id = '$loan_id'");
   	return $data->row();
   }


    public function get_today_received_loan($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT * FROM tbl_depost p JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_account_transaction at ON at.trans_id = p.depost_method WHERE p.comp_id = '$comp_id' AND p.depost_day = '$date'");
    	return $data->result();
    }

	public function get_received_loanBlanch($blanch_id, $empl_id = null, $from_date = null, $to_date = null, $loan_status = null)
	{
		$this->db->select('*');
		$this->db->from('tbl_depost p');
		$this->db->join('tbl_loans l', 'l.loan_id = p.loan_id');
		$this->db->join('tbl_customer c', 'c.customer_id = l.customer_id');
		$this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id');
		$this->db->join('tbl_account_transaction at', 'at.trans_id = p.depost_method', 'left');
	
		$this->db->where('p.blanch_id', $blanch_id);
	
		if (!empty($empl_id)) {
			$this->db->where('p.empl_id', $empl_id);
		}
	
		if (!empty($from_date) && !empty($to_date)) {
			$this->db->where('DATE(p.depost_day) >=', $from_date);
			$this->db->where('DATE(p.depost_day) <=', $to_date);
		} else {
			$this->db->where('DATE(p.depost_day)', date('Y-m-d'));
		}
	
		if (!empty($loan_status)) {
			$this->db->where('l.loan_status', $loan_status);
		}
	
		return $this->db->get()->result();
	}
	


    public function get_sumReceived_amount($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
    	 return $data->row();
    }

     public function get_sumReceiveComp($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE comp_id = '$comp_id' AND auto_date = '$date'");
    	 return $data->row();
    }


    public function get_sumReceived_amountbl($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

    public function get_sum_today_recevedBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
    	 return $data->row();
    }


  

     public function get_sumReceived_amountBlanchs($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

      public function get_sumReceived_amountBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(withdrow) AS total_withdrawal FROM tbl_pay WHERE blanch_id = '$blanch_id' AND auto_date = '$date'");
    	 return $data->row();
    }

	// public function get_sumReceived_byOfficer($empl_id) {
	// 	$date = date("Y-m-d");
	// 	$query = $this->db->query("
	// 		SELECT SUM(withdrow) AS total_withdrawal
	// 		FROM tbl_pay
	// 		WHERE empl_id = ? AND auto_date = ?
	// 	", [$empl_id, $date]);
	
	// 	return $query->row();
	// }
	
	// Get all customers assigned to a specific loan officer
public function get_all_customers_by_officer($empl_id)
{
    return $this->db
        ->where('empl_id', $empl_id)
        ->get('tbl_customer')
        ->result();
}

// Get active customers assigned to a specific loan officer
public function get_active_customers_by_officer($empl_id)
{
    return $this->db
        ->where('empl_id', $empl_id)
        ->where('customer_status', 'open')
        ->get('tbl_customer')
        ->result();
}

// Get all customers in a branch
public function get_all_customers_by_branch($blanch_id)
{
    return $this->db
        ->where('blanch_id', $blanch_id)
        ->get('tbl_customer')
        ->result();
}

// Get active customers in a branch
public function get_active_customers_by_branch($blanch_id)
{
    return $this->db
        ->where('blanch_id', $blanch_id)
        ->where('customer_status', 'open')
        ->get('tbl_customer')
        ->result();
}

    //reconselation report

     public function get_total_recevableDaily($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '1' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableDailyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '1' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableweekly($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_wekly FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '7' AND date_show = '$date'");
    	return $today_data->row();
    }

      public function get_total_recevableweeklyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_wekly FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '7' AND date_show = '$date'");
    	return $today_data->row();
    }


     public function get_total_recevableMonthly($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_Monthly FROM tbl_loans  WHERE comp_id = '$comp_id' AND day = '30' AND date_show = '$date'");
    	return $today_data->row();
    }


     public function get_total_recevableMonthlyblanch($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_rejesho_Monthly FROM tbl_loans  WHERE blanch_id = '$blanch_id' AND day = '30' AND date_show = '$date'");
    	return $today_data->row();
    }

    public function get_sumReceived_amountDaily($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalDaily,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '1'");
    	 return $data->row();
    }

     public function get_sumReceived_amountDailyblanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalDaily,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '1'");
    	 return $data->row();
    }

     public function get_sumReceived_amountWeekly($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalWeekly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '7'");
    	 return $data->row();
    }

       public function get_sumReceived_amountWeeklyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalWeekly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '7'");
    	 return $data->row();
    }

    public function get_sumReceived_amountmonthly($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalMonthly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.comp_id = '$comp_id' AND p.auto_date = '$date' AND l.day = '30'");
    	 return $data->row();
    }

     public function get_sumReceived_amountmonthlyBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(p.withdrow) AS total_withdrawalMonthly,l.day FROM tbl_pay p JOIN tbl_loans l ON l.loan_id = p.loan_id WHERE p.blanch_id = '$blanch_id' AND p.auto_date = '$date' AND l.day = '30'");
    	 return $data->row();
    }


    public function prepaid_pay($comp_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(prepaid_amount) AS prepaid_balance FROM tbl_prepaid WHERE comp_id = '$comp_id'  AND prepaid_date = '$date'");
    	 return $data->row();
    }

     public function prepaid_paybla($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(prepaid_amount) AS prepaid_balance FROM tbl_prepaid WHERE blanch_id = '$blanch_id' AND prepaid_date = '$date'");
    	 return $data->row();
    }


     public function prepaid_payBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(balance) AS prepaid_balance FROM tbl_pay WHERE blanch_id = '$blanch_id' AND date_pay = '$date'");
    	 return $data->row();
    }


    public function get_total_loanFeereconce($comp_id){
    	$today = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE comp_id = '$comp_id' AND p_today = '$today' AND  fee_id IS NOT NULL ");
	 return $data_loan->row();
}

   public function get_total_loanFeereconceBlanch($blanch_id){
    	$today = date("Y-m-d");
	$data_loan = $this->db->query("SELECT SUM(withdrow) AS sum_withdraw FROM  tbl_pay  WHERE blanch_id = '$blanch_id' AND p_today = '$today' AND  fee_id IS NOT NULL ");
	 return $data_loan->row();
}

//income

public function get_today_income($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_income FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$today'");
	 return $data->row();
}

public function get_today_incomeBlanch($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_income FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$today'");
	 return $data->row();
}

public function get_today_expences($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(req_amount) AS total_req FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$today' AND req_status = 'accept'");
	 return $data->row();
}

public function get_today_expencesBlanch($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(req_amount) AS total_req FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$today'");
	 return $data->row();
}

public function get_today_withdrawal_loan($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_todayloan FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$date' AND loan_status = 'withdrawal'");
	  return $data->row();
}

public function get_today_withdrawal_loanBlanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_todayloan FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$date' AND loan_status = 'withdrawal'");
	  return $data->row();
}

public function get_cash_transaction_blanch($blanch_id){
		 $date = date("Y-m-d");
		 $data = $this->db->query("SELECT pr.prev_id,pr.pay_id,pr.empl_id,pr.customer_id,pr.loan_id,pr.depost,pr.withdraw,pr.with_trans,pr.lecod_day,pr.day_id,e.empl_name,c.f_name,c.m_name,c.l_name,c.phone_no,b.blanch_name,pr.time_rec,pr.loan_aprov,dat.account_name AS deposit_account,wat.account_name AS withdrawal_account FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id LEFT JOIN tbl_account_transaction dat ON dat.trans_id = pr.trans_id  LEFT JOIN tbl_account_transaction wat ON wat.trans_id = pr.with_trans WHERE pr.blanch_id = '$blanch_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->result();
	}

	public function get_cash_transaction_sum_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(loan_aprov) AS total_aprove,SUM(depost) AS total_deposit FROM tbl_prev_lecod pr LEFT JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND date(pr.time_rec) = '$date' ORDER BY prev_id DESC");
		 return $data->row();
	}

		public function get_deposit_sunnary_account_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT at.account_name,SUM(pr.depost) AS total_deposit_acc FROM tbl_prev_lecod pr LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id  WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$date' AND pr.trans_id IS TRUE GROUP BY pr.trans_id");
		return $data->result();
	}

		public function get_depositing_out_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_depost d LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$date' AND d.dep_status = 'out'");
		return $data->result();
	}


		public function get_withdrawal_summary_account_blanch_data($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT at.account_name,SUM(pr.loan_aprov) AS total_with_acc FROM tbl_prev_lecod pr LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.with_trans  WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$date' AND pr.with_trans IS TRUE GROUP BY pr.with_trans");
		return $data->result();
	}

	public function get_total_code_number_blanch_data($blanch_id)
{
    $date = date("Y-m-d");

    $sql = "
        SELECT SUM(pr.total_int) AS total_interest
        FROM tbl_prev_lecod pr
        JOIN tbl_loans l ON l.loan_id = pr.loan_id
        WHERE pr.blanch_id = ?
          AND pr.lecod_day = ?
          AND l.loan_status = 'withdrawal'
    ";

    $query = $this->db->query($sql, [$blanch_id, $date]);
    return $query->row();
}


	  public function get_total_deducted_income_blanch_data($blanch_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$today'");
 	return $data->row();
 }

 		public function get_total_penart_paid_blanch_data($blanch_id){
		$date = date("Y-m-d");
		$data_penart = $this->db->query("SELECT SUM(penart_paid) AS total_penart FROM tbl_pay_penart WHERE blanch_id = '$blanch_id' AND penart_date = '$date'");
		return $data_penart->row();
	}

		public  function get_miamala_hewa_blanch_data($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_miamala m LEFT JOIN tbl_account_transaction at ON at.trans_id = m.provider LEFT JOIN tbl_blanch b ON b.blanch_id = m.blanch_id WHERE m.blanch_id = '$blanch_id' AND m.date = '$date' AND m.status = 'open'");
		return $data->result();
	}

		public  function get_miamala_hewa_total_blanch_data($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT SUM(m.amount) AS total_miamala FROM tbl_miamala m LEFT JOIN tbl_account_transaction at ON at.trans_id = m.provider LEFT JOIN tbl_blanch b ON b.blanch_id = m.blanch_id WHERE m.blanch_id = '$blanch_id' AND m.date = '$date' AND m.status = 'open'");
		return $data->row();
	}

	public function get_depositing_hai_blanch($blanch_id){
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT COUNT(d.dep_id) AS total_hai FROM tbl_depost d LEFT JOIN tbl_customer c ON c.customer_id = d.customer_id  LEFT JOIN tbl_blanch b ON b.blanch_id = d.blanch_id WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$date' AND d.dep_status = 'withdrawal'");
		return $data->row();
	}

	



public function get_total_penartToday($comp_id){
	$today = date("Y-m-d");
	$penart = $this->db->query("SELECT SUM(total_penart) AS penart FROM tbl_store_penalt WHERE comp_id = '$comp_id' AND penart_day = '$today'");
	 return $penart->row();
}

public function get_total_penartTodayBlanch($blanch_id){
	$today = date("Y-m-d");
	$penart = $this->db->query("SELECT SUM(total_penart) AS penart FROM tbl_store_penalt WHERE blanch_id = '$blanch_id' AND penart_day = '$today'");
	 return $penart->row();
}

public function remove_priv($priv_id){
	return $this->db->delete('tbl_privellage',['priv_id'=>$priv_id]);
}

public function get_privData($priv_id){
	$data = $this->db->query("SELECT * FROM tbl_privellage WHERE priv_id = '$priv_id'");
	 return $data->row();
}

public function insert_todayCash($data){
	return $this->db->insert(' tbl_cash_inhand',$data);
}

public function get_todayCah($blanch_id){
	  $date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM  tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
	  return $data->result();
}

public function get_sum_cashInHand($blanch_id){
	$date = date("Y-m-d");
	$cash = $this->db->query("SELECT SUM(cash_amount) AS totall_cash FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id'  AND 'cash_day' = '$date'");
	  return $cash->row();
}

public function get_sum_cashInHandcomp($comp_id){
	$cash = $this->db->query("SELECT SUM(cash_amount) AS totall_cash FROM tbl_cash_inhand WHERE comp_id = '$comp_id'");
	  return $cash->row();
}


public function get_position_empl($empl_id){
	$data = $this->db->query("SELECT * FROM  tbl_privellage WHERE empl_id = '$empl_id'");
	return $data->result();
}

public function get_position_manager($empl_id){
	$data = $this->db->query("SELECT * FROM  tbl_privellage WHERE empl_id = '$empl_id'");
	return $data->row();
}


public function get_position_emplmanager($empl_id){
	$data = $this->db->query("SELECT * FROM   tbl_privellage WHERE empl_id = '$empl_id'");
	  return $data->row();
}

public function update_employee_profile($data,$empl_id){
	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
}

public function get_restoration_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l WHERE l.loan_id = '$loan_id'");
	 return $data->row();
}

public function get_today_chashData_Blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS today_depost FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	  return $data->row();
}


//comp 
public function get_today_chashData_Comp($comp_id){
	$data = $this->db->query("SELECT SUM(depost) AS today_depost FROM tbl_prev_lecod WHERE comp_id = '$comp_id'");
	  return $data->row();
}



public function get_today_incomeBlanchData($blanch_id){
	$date = date("Y-m-d");
	$income = $this->db->query("SELECT SUM(receve_amount) AS today_income FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$date'");
	 return $income->row();
}

//comp
public function get_today_incomeBlanchDataComp($comp_id){
	$income = $this->db->query("SELECT SUM(receve_amount) AS today_income FROM  tbl_receve WHERE comp_id = '$comp_id'");
	 return $income->row();
}



public function get_today_expencesData($blanch_id){
	$date = date("Y-m-d");
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expnces FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$date'");
	 return $expences->row();
}

//comp
public function get_today_expencesDataComp($comp_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expnces FROM tbl_request_exp WHERE comp_id = '$comp_id'");
	 return $expences->row();
}
//blanch
public function get_today_expencesDataBlanch($blanch_id){
	$expences = $this->db->query("SELECT SUM(req_amount) AS total_expncesBlanch FROM tbl_request_exp WHERE blanch_id = '$blanch_id'");
	 return $expences->row();
}


public function get_toay_Cashinhand($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_cash_inhand WHERE blanch_id = '$blanch_id' AND cash_day = '$date'");
	return $data->result();
}


public function get_today_cash($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_total_walet($comp_id){
	$principal = $this->db->query("SELECT SUM(amount) AS total_capital FROM tbl_capital WHERE comp_id = '$comp_id'");
	  return $principal->row();
}

public function get_total_principal($comp_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status ='withdrawal'");
	  return $data->row();
}

// public function get_total_principal_day($comp_id) {
//     $today = date('Y-m-d'); // Get today's date

//     $query = $this->db->query("
//         SELECT SUM(loan_aprove) AS loan_aproved 
//         FROM tbl_loans 
//         WHERE comp_id = ? 
//         AND loan_status = 'withdrawal' 
//         AND DATE(loan_day) = ?
//     ", [$comp_id, $today]);

//     return $query->row();
// }

public function get_today_withdrawal_daily_comp($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWith_day FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.comp_id = '$comp_id' AND loan_stat_date = '$today'");
	return $data->row();
}

public function get_sun_loanPendingcompany($comp_id){
	$pend = date("Y-m-d");
	$pending = $this->db->query("SELECT SUM(return_total) AS total_pending FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >='$pend'");
	return $pending->row();

}



public function get_pending_reportLoancompany($comp_id){
    $pend = date("Y-m-d");
    
    $data = $this->db->query("
        SELECT 
            lp.*, 
            c.*, 
            b.*, 
            l.*, 
            lt.loan_name 
        FROM tbl_loan_pending lp 
        LEFT JOIN tbl_customer c ON c.customer_id = lp.customer_id 
        LEFT JOIN tbl_blanch b ON b.blanch_id = lp.blanch_id 
        LEFT JOIN tbl_loans l ON l.loan_id = lp.loan_id 
        LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id
        WHERE lp.comp_id = '$comp_id' 
        AND lp.action_date >= '$pend'
    ");

    return $data->result();
}


public function get_total_principal_weekly($comp_id){
    $query = $this->db->query("
        SELECT SUM(loan_aprove) AS loan_aproved 
        FROM tbl_loans 
        WHERE comp_id = '$comp_id' 
        AND loan_status = 'withdrawal' 
        AND day = 7
    ");
    return $query->row();
}

public function get_total_principal_monthly($comp_id){
    $query = $this->db->query("
        SELECT SUM(loan_aprove) AS loan_aproved 
        FROM tbl_loans 
        WHERE comp_id = '$comp_id' 
        AND loan_status = 'withdrawal' 
        AND day IN (28, 29, 30, 31)
    ");
    return $query->row();
}


public function get_top_5_employees_today_loans($comp_id) {
    $today = date("Y-m-d");

    $query = $this->db->query("
        SELECT e.empl_id, e.empl_name, SUM(l.loan_aprove) AS total_loan
        FROM tbl_loans l
        JOIN tbl_employee e ON e.empl_id = l.empl_id
        WHERE l.comp_id = '$comp_id'
          AND l.loan_status = 'withdrawal'
           AND DATE(l.loan_day) = '$today'
        GROUP BY l.empl_id
        ORDER BY total_loan DESC
        LIMIT 5
    ");

    return $query->result();
}




public function get_branchwise_today_deposit($comp_id) {
    $today = date("Y-m-d");

    $query = $this->db->query("
        SELECT b.blanch_id, b.blanch_name, SUM(d.depost) AS total_deposit
        FROM tbl_depost d
        JOIN tbl_blanch b ON b.blanch_id = d.blanch_id
        WHERE d.comp_id = '$comp_id'
          AND DATE(d.depost_day) = '$today'
        GROUP BY b.blanch_id
       
    ");

    return $query->result();
}




public function get_total_principalBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS loan_aproveds FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status ='withdrawal'");
	  return $data->row();
}

public function get_totalLoanRepayment($comp_id){
	$repayment = $this->db->query("SELECT SUM(depost) AS loan_depost FROM tbl_pay WHERE comp_id = '$comp_id' AND pay_status = '1'");
	  return $repayment->row();
}

public function get_totalLoanRepaymentBlanch($blanch_id){
	$repayment = $this->db->query("SELECT SUM(depost) AS loan_depost_blanch FROM tbl_pay WHERE blanch_id = '$blanch_id' AND pay_status = '1'");
	  return $repayment->row();
}

public function get_previous_income($from,$to,$comp_id,$blanch_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id' AND r.blanch_id = '$blanch_id'");
	 return $income->result();
}

public function get_previous_incomeAll($from,$to,$comp_id){
	$income = $this->db->query("SELECT * FROM tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE r.receve_day between '$from' and '$to' AND r.comp_id = '$comp_id'");
	 return $income->result();
}

public function get_sum_previousIncome($from,$to,$comp_id,$blanch_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id' AND blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_sum_previousIncomeAll($from,$to,$comp_id){
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receved FROM  tbl_receve WHERE receve_day between '$from' and '$to' AND  comp_id = '$comp_id'");
	 return $data->row();
}


//group loan

public function get_groupLoanData($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_groupLoan_detail($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_groupMember($group_id){
	$member = $this->db->query("SELECT * FROM tbl_group_member WHERE group_id = '$group_id'");
	 return $member->result();
}


public function get_gropLoan($comp_id){
	$loan_group = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_pay p ON p.group_id = g.group_id JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.comp_id = '$comp_id' GROUP BY p.group_id");
	  return $loan_group->result();
}


      //search-----
    public function search_groupLoan($group_id,$comp_id){
      $this->db->select('b.blanch_id,b.	comp_id,b.region_id,b.blanch_name,b.blanch_no,b.balanch_date,p.pay_id,p.comp_id,p.fee_id,p.blanch_id,p.emply,p.customer_id,p.loan_id,l.loan_id,l.comp_id,l.blanch_id,l.customer_id,l.category_id,l.empl_id,l.loan_code,l.group_id,l.how_loan,l.day,l.session,l.reason,l.loan_status,l.fee_status,l.loan_aprove,l.region_id,l.loan_day,lc.category_id,lc.loan_name,lc.comp_id,lc.interest_formular,c.comp_id,c.comp_name,g.group_id,g.group_name');
      $this->db->like('g.group_id',$group_id);
      $this->db->like('c.comp_id',$comp_id);
      $this->db->JOIN('tbl_blanch b','b.blanch_id = g.blanch_id');
      $this->db->JOIN('tbl_pay p','p.group_id = g.group_id');
      $this->db->JOIN('tbl_loans l','l.group_id = g.group_id');
      $this->db->JOIN('tbl_company c','c.comp_id = p.comp_id');
      $this->db->JOIN('tbl_loan_category lc','lc.category_id = l.category_id');
      $data = $this->db->get('tbl_group g');
         return $data->row();
        }


        public function get_depost_groupData($group_id){
        	$data = $this->db->query("SELECT * FROM tbl_pay WHERE group_id = '$group_id'");
        	return $data->result();
        }
      

      public function get_groupDataMain($group_id){
      	$data = $this->db->query("SELECT * FROM tbl_group g JOIN tbl_blanch b ON b.blanch_id = g.blanch_id WHERE g.group_id = '$group_id'");
      	 return $data->row();
      }


      public function get_ChairManCustomer($customer_id){
      	$data = $this->db->query("SELECT * FROM tbl_customer WHERE customer_id = '$customer_id'");
      	return $data->row();
      }

       public function get_payGroup($group_id){
        	$customer_pay = $this->db->query("SELECT * FROM tbl_pay p  JOIN tbl_loans l ON l.loan_id = p.loan_id  WHERE p.group_id = '$group_id' ORDER BY p.pay_id DESC LIMIT 5");
        	  return $customer_pay->result();
        }


        public function get_totalgroup($group_id){
	  $total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' ORDER BY loan_id DESC");
	  return $total_loan->row();
    }

    public function get_totalLoanDisbureseGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'disbarsed'");
	  return $total_loan->row();
}

public function get_totalLoanwithdrawalGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'withdrawal'");
	  return $total_loan->row();
}

public function get_totalLoanDoneGroup($group_id){
	$total_loan = $this->db->query("SELECT * FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'done'");
	  return $total_loan->row();
}


       // search-----
    public function search_phone($comp_phone){
      $this->db->select('');
      $this->db->like('c.comp_phone',$comp_phone);
      $data = $this->db->get('tbl_company c');
         return $data->row();
        }
    public function view_com($comp_id){
    	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
    	 return $data->row();
    }

    public function update_comppassword($comp_id,$data){
    	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
    }

    public function get_outstand_loan($loan_id){
     $out = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_outstand o ON o.loan_id = l.loan_id WHERE l.loan_id = '$loan_id'");
      return $out->row();
    }

    public function get_blanchIncome($blanch_id,$receve_day){
    	  $this->db->select('r.receved_id,r.comp_id,r.inc_id,r.blanch_id,r.customer_id,r.empl,r.receve_amount,r.receve_day,c.customer_id,c.f_name,c.m_name,c.l_name,i.inc_id,i.comp_id,i.inc_name,b.blanch_id,b.blanch_name');
      $this->db->like('r.blanch_id',$blanch_id);
      $this->db->like('r.receve_day',$receve_day);
      $this->db->JOIN('tbl_blanch b','b.blanch_id = r.blanch_id');
      $this->db->JOIN('tbl_customer c','c.customer_id = r.customer_id');
      $this->db->JOIN('tbl_income i','i.inc_id = r.inc_id');
      $data = $this->db->get('tbl_receve r');
         return $data->result();
    }

    public function get_blanchDataIncome($blanch_id,$receve_day){
    	$data = $this->db->query("SELECT * FROM tbl_receve r  JOIN tbl_customer c ON c.customer_id = r.customer_id JOIN tbl_blanch b ON b.blanch_id = r.blanch_id JOIN tbl_income i ON i.inc_id = r.inc_id WHERE r.blanch_id = '$blanch_id' AND r.receve_day = '$receve_day'");
    	 return $data->result();
    }

    public function get_blanch_data($blanch_id){
    	$data = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
    	return $data->row();
    }

   

     public function get_expences_blanch($blanch_id){
     	$date = date("Y-m-d");
     	$data = $this->db->query("SELECT * FROM tbl_request_exp e LEFT JOIN tbl_company c ON c.comp_id = e.comp_id LEFT JOIN tbl_blanch b ON b.blanch_id = e.blanch_id LEFT JOIN tbl_expenses ex ON ex.ex_id = e.ex_id LEFT JOIN tbl_account_transaction at ON at.trans_id = e.trans_id WHERE e.blanch_id = '$blanch_id'AND e.req_date = '$date'");
     	return $data->result();

     }	

    public function get_sum_expences($comp_id){
    	$today = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_date = '$today'");
    	 return $data->row();
    }

     public function get_sum_expencesnotAccept($comp_id){
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'open'");
    	 return $data->row();
    }

    public function get_sum_expencesBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_expences FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$date'");
    	 return $data->row();
    }

    public function get_blanch_expenses_data($comp_id){
    	$data = $this->db->query("SELECT * FROM tbl_request_exp r LEFT JOIN tbl_blanch b ON b.blanch_id = r.blanch_id WHERE r.comp_id = '$comp_id' GROUP BY r.blanch_id");
    	return $data->result();
    }


    public function get_blanch_expenses_data_request($blanch_id){
    	$data = $this->db->query("SELECT * FROM tbl_request_exp r LEFT JOIN tbl_expenses ex ON ex.ex_id = r.ex_id LEFT JOIN tbl_account_transaction at ON at.trans_id = r.trans_id WHERE r.blanch_id = '$blanch_id'");
    	return $data->result();
    }

    public function get_sumBlanch_data($blanch_id){
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_blanch_exp FROM tbl_request_exp re WHERE re.blanch_id = '$blanch_id' GROUP BY re.blanch_id");
    	return $data->result();
    }

    public function get_total_comp_exp($comp_id){
    	$data = $this->db->query("SELECT SUM(req_amount) AS total_comp_exp FROM tbl_request_exp WHERE comp_id = '$comp_id'");
    	return $data->row();
    }


    public function get_expenses_category_total($comp_id){
    	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_exp_category,e.ex_name FROM tbl_request_exp re LEFT JOIN tbl_expenses e ON e.ex_id = re.ex_id WHERE re.comp_id = '$comp_id' GROUP BY re.ex_id");
    	return $data->result();
    }


  //out data

  public function fetch_eneos($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('customer_id', 'ASC');
  $query = $this->db->get('tbl_customer');
  $output = '<option value="">Search Customer</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->customer_id.'">'.$row->f_name. ' '.$row->m_name. ' '.$row->l_name. '</option>';
  }
  return $output;
 }

 function fetch_vipmios($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
  //$output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->how_loan).")".'</option>';
   
  }
  return $output;
 }

  function fetch_loancustomer($customer_id)
 {
  $this->db->where('customer_id', $customer_id);
  $this->db->order_by('loan_code', 'DESC');
  $query = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC");
  $output = '<option value="">Select Active Loan</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->loan_id.'">'.$row->loan_code. "-" ."(Tsh.".number_format($row->loan_aprove).")".'</option>';
   
  }
  return $output;
 }

 public function get_loanSchedule($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_test_date t LEFT JOIN tbl_loans l ON l.loan_id = t.loan_id WHERE t.loan_id = '$loan_id'");
 	return $data->result();
 }


 public function get_income_data($inc_id){
 	$data = $this->db->query("SELECT * FROM tbl_income WHERE inc_id = '$inc_id'");
 	 return $data->row();
 }


 public function get_blanchd($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_blanch WHERE comp_id = '$comp_id'");
 	 return $data->result();
 }



public function get_blanch_expDetail($from,$to,$blanch_id){
$data = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id' GROUP BY re.blanch_id");
return $data->result();
}

public function get_blanch_Total_expDetail($from,$to,$blanch_id){
$data = $this->db->query("SELECT SUM(re.req_amount) AS total_request_comapany FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.blanch_id = '$blanch_id' GROUP BY re.blanch_id");
return $data->row();
}

public function get_blanch_expDetail_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT * FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.comp_id = '$comp_id' GROUP BY re.blanch_id");
return $data->result();
}

public function get_total_expDetail_company($from,$to,$comp_id){
$data = $this->db->query("SELECT SUM(re.req_amount) AS total_request_comapany FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.req_date between '$from' and '$to' AND re.comp_id = '$comp_id'");
return $data->row();
}

 public function get_prev_expences($from,$to,$blanch_id){
 $previous_cash = $this->db->query("SELECT * FROM  tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id JOIN tbl_expenses e ON e.ex_id = re.ex_id LEFT JOIN tbl_account_transaction at ON at.trans_id = re.trans_id  WHERE re.req_date between  '$from' and '$to'AND re.blanch_id = '$blanch_id'");
      return $previous_cash->result();
 }

 public function get_total_prevExpences($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE req_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
 	return $data->result();
 }

 public function update_customer_profile($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_sub_customer',$data);
 }

 public function get_emplBlock($empl_id){
 	$empl = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
 	  return $empl->row();
 }

 public function block_empl_data($empl_id,$data){
 	return $this->db->where('empl_id',$empl_id)->update('tbl_employee',$data);
 }

 public function block_empl_allData($comp_id,$all_employee){
 	return $this->db->where('comp_id',$comp_id)->update('tbl_employee',$all_employee);
 }



 	 // public function search_prev_cashtransaction($from,$to,$comp_id){
   //    $previous_cash = $this->db->query("SELECT * FROM  tbl_prev_lecod pr JOIN tbl_customer c ON c.customer_id = pr.customer_id  WHERE pr.lecod_day between  '$from' and '$to'AND pr.comp_id = '$comp_id'");
   //    return $previous_cash->result();
   //   }


 public function get_transforFloat($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT t.blanch_amount,t.blanch_id,t.comp_id,t.trans_day,b.blanch_name FROM tbl_transfor t  LEFT JOIN tbl_blanch b ON b.blanch_id = t.blanch_id WHERE t.trans_day between '$from' and '$to' AND t.blanch_id = '$blanch_id'");
 	  return $data->result();
 }

 public function get_sumFloatData($comp_id){
 	$date = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(blanch_amount) AS cashFloat FROM tbl_transfor WHERE comp_id = '$comp_id' AND trans_day = '$date'");
 	return $data->row();
 }

 public function get_toal_Float_date($from,$to,$blanch_id){
 	$float = $this->db->query("SELECT SUM(blanch_amount) AS total_froat FROM tbl_transfor WHERE trans_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
 	return $float->row();
 }

  public function get_blanchReced($from,$to,$blanch_id,$empl_id,$dep_status){
 	$data = $this->db->query("SELECT * FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id JOIN tbl_customer c ON c.customer_id = d.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id  = d.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.depost_day between '$from' and '$to' AND d.blanch_id = '$blanch_id' AND d.empl_id = '$empl_id' AND d.dep_status = '$dep_status'");
 	return $data->result();
 }

   public function get_blanchReced_all($from,$to,$blanch_id,$dep_status){
 	$data = $this->db->query("SELECT * FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id JOIN tbl_customer c ON c.customer_id = d.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id  = d.blanch_id LEFT JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.depost_day between '$from' and '$to' AND d.blanch_id = '$blanch_id' AND d.dep_status = '$dep_status'");
 	return $data->result();
 }

 public function get_blanch_total_receved($from,$to,$blanch_id,$empl_id,$dep_status){
 	$data = $this->db->query("SELECT SUM(d.depost) AS toal_deposit FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id JOIN tbl_customer c ON c.customer_id = d.customer_id WHERE d.depost_day between '$from' and '$to' AND d.blanch_id = '$blanch_id' AND d.empl_id = '$empl_id' AND d.dep_status = '$dep_status'");
 	return $data->row(); 
 }

  public function get_blanch_total_receved_all($from,$to,$blanch_id,$dep_status){
 	$data = $this->db->query("SELECT SUM(d.depost) AS toal_deposit FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id JOIN tbl_customer c ON c.customer_id = d.customer_id WHERE d.depost_day between '$from' and '$to' AND d.blanch_id = '$blanch_id'AND d.dep_status = '$dep_status'");
 	return $data->row(); 
 }

 public function get_blanchRecevedData($blanch_id){
 	$blanch = $this->db->query("SELECT * FROM tbl_blanch WHERE blanch_id = '$blanch_id'");
 	 return $blanch->row();
 }


public function outstand_loan($comp_id, $blanch_id = null, $empl_id = null, $from = null, $to = null) {
    $this->db->select('
        ot.*, 
        l.loan_int, l.restration, l.day, l.session, l.empl_id, l.blanch_id,
        c.f_name, c.m_name, c.l_name, c.phone_no,
        b.blanch_name,
        SUM(COALESCE(d.depost,0)) AS total_deposit,
        GREATEST(DATEDIFF(CURDATE(), o.loan_end_date), 0) AS overdue_days,
        o.loan_stat_date, o.loan_end_date
    ');
    $this->db->from('tbl_outstand_loan ot');
    $this->db->join('tbl_loans l','l.loan_id = ot.loan_id','left');
    $this->db->join('tbl_customer c','c.customer_id = ot.customer_id','left');
    $this->db->join('tbl_blanch b','b.blanch_id = l.blanch_id','left');
    $this->db->join('tbl_depost d','d.loan_id = ot.loan_id','left');
    $this->db->join('tbl_outstand o','o.loan_id = ot.loan_id','left');

    $this->db->where('ot.comp_id', $comp_id);
    $this->db->where('ot.out_status', 'open');

    if(!empty($blanch_id)){
        $this->db->where('l.blanch_id', $blanch_id);
    }
    if(!empty($empl_id) && $empl_id != 'all'){
        $this->db->where('l.empl_id', $empl_id);
    }
    if(!empty($from)){
        $this->db->where('o.loan_stat_date >=', $from);
    }
    if(!empty($to)){
        $this->db->where('o.loan_end_date <=', $to);
    }

    $this->db->group_by('ot.loan_id'); // group deposits per loan
    $query = $this->db->get();
    return $query->result();
}


public function total_outstand_loan($comp_id, $blanch_id = null, $empl_id = null, $from = null, $to = null) {
    $this->db->select('SUM(l.loan_int) AS total_loan, SUM(COALESCE(d.depost,0)) AS total_paid, SUM(l.loan_int - COALESCE(d.depost,0)) AS total_remain');
    $this->db->from('tbl_outstand_loan ot');
    $this->db->join('tbl_loans l','l.loan_id = ot.loan_id','left');
    $this->db->join('tbl_depost d','d.loan_id = ot.loan_id','left');
    $this->db->join('tbl_outstand o','o.loan_id = ot.loan_id','left');

    $this->db->where('ot.comp_id', $comp_id);
    $this->db->where('ot.out_status', 'open');

    if(!empty($blanch_id)){
        $this->db->where('l.blanch_id', $blanch_id);
    }
    if(!empty($empl_id) && $empl_id != 'all'){
        $this->db->where('l.empl_id', $empl_id);
    }
    if(!empty($from)){
        $this->db->where('o.loan_stat_date >=', $from);
    }
    if(!empty($to)){
        $this->db->where('o.loan_end_date <=', $to);
    }

    $query = $this->db->get();
    return $query->row();
}






  public function outstand_loan_employee($comp_id,$empl_id){
 	$data = $this->db->query("SELECT COUNT(p.pend_id) AS pending_day,c.f_name,c.m_name,c.l_name,b.blanch_name,c.phone_no,l.loan_int,l.restration,l.day,l.session,ot.remain_amount,o.loan_stat_date,o.loan_end_date FROM tbl_outstand_loan ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ot.customer_id LEFT JOIN tbl_outstand o ON o.loan_id = ot.loan_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_loan_pending p ON p.loan_id = ot.loan_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE ot.comp_id = '$comp_id' AND ot.out_status = 'open' AND e.empl_id = '$empl_id'  GROUP BY p.loan_id");
 	 return $data->result();
 }


 public function outstand_loan_blanch_data($blanch_id){
 	$data = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,b.blanch_name,c.phone_no,l.loan_int,l.restration,l.day,l.session,ot.remain_amount,o.loan_stat_date,o.loan_end_date FROM tbl_outstand_loan ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id LEFT JOIN tbl_customer c ON c.customer_id = ot.customer_id LEFT JOIN tbl_outstand o ON o.loan_id = ot.loan_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id  LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE ot.blanch_id = '$blanch_id' AND ot.out_status = 'open'");
 	 return $data->result();
 }

  public function total_outstand_loan_employee($comp_id,$empl_id){
 	$data = $this->db->query("SELECT SUM(ot.remain_amount) AS total_out FROM tbl_outstand_loan ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE ot.comp_id = '$comp_id' AND ot.out_status = 'open' AND l.empl_id = '$empl_id'");
 	 return $data->row();
 }

 public function total_outstand_loan_blnch($blanch_id){
 	$data = $this->db->query("SELECT SUM(ot.remain_amount) AS total_out FROM tbl_outstand_loan ot LEFT JOIN tbl_loans l ON l.loan_id = ot.loan_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE ot.blanch_id = '$blanch_id' AND ot.out_status = 'open'");
 	 return $data->row();
 }

 public function total_outstand_loans($comp_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE comp_id = '$comp_id' AND out_status = 'open'");
 	 return $data->row();
 }

 public function total_outstand_loan_today($comp_id)
{
    $today = date('Y-m-d'); // tarehe ya leo

    $data = $this->db->query("
        SELECT SUM(o.remain_amount) AS total_out
        FROM tbl_outstand_loan o
        JOIN tbl_outstand t ON o.loan_id = t.loan_id
        WHERE o.comp_id = '$comp_id'
          AND o.out_status = 'open'
          AND DATE(t.loan_end_date) = '$today'
    ");

    return $data->row();
}


 public function total_outstand_Blanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
 	 return $data->row();
 }

  public function total_outstand_loanBlanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id' AND out_status = 'open'");
 	 return $data->row();
 }

  public function outstand_loanBlanch($blanch_id){
  	$data = $this->db->query("SELECT COUNT(p.pend_id) AS pending_day,c.f_name,c.m_name,c.l_name,b.blanch_name,c.phone_no,l.loan_int,l.restration,l.day,l.session,ot.remain_amount,o.loan_stat_date,o.loan_end_date,ot.out_status FROM tbl_outstand_loan ot JOIN tbl_loans l ON l.loan_id = ot.loan_id JOIN tbl_customer c ON c.customer_id = ot.customer_id JOIN tbl_outstand o ON o.loan_id = ot.loan_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id JOIN tbl_loan_pending p ON p.loan_id = ot.loan_id WHERE ot.blanch_id = '$blanch_id' AND ot.out_status = 'open' GROUP BY p.loan_id");
 	 return $data->result();
 }



public function defaulters_customer($blanch_id){
    $sql = "
        SELECT 
            COUNT(p.pend_id) AS pending_day,
            c.f_name, c.m_name, c.l_name,
            b.blanch_name,
            c.phone_no,
            l.loan_int, l.restration, l.day, l.session,
            ot.remain_amount,
            o.loan_stat_date, o.loan_end_date,
            ot.out_status,
            MAX(d.deposit_day) AS last_payment_day,
            DATEDIFF(CURDATE(), COALESCE(MAX(d.deposit_day), o.loan_end_date)) AS overdue_days
        FROM tbl_outstand_loan ot
        JOIN tbl_loans l ON l.loan_id = ot.loan_id
        JOIN tbl_customer c ON c.customer_id = ot.customer_id
        JOIN tbl_outstand o ON o.loan_id = ot.loan_id
        JOIN tbl_blanch b ON b.blanch_id = l.blanch_id
        JOIN tbl_loan_pending p ON p.loan_id = ot.loan_id
        LEFT JOIN tbl_depost d ON d.loan_id = ot.loan_id
        WHERE ot.blanch_id = ?
          AND ot.out_status = 'open'
        GROUP BY p.loan_id
        HAVING overdue_days >= 10
        ORDER BY overdue_days DESC
    ";

    $query = $this->db->query($sql, [$blanch_id]);
    return $query->result();
}


 public function insert_superUser($data){
 	return $this->db->insert('tbl_super_admin',$data);
 }

 public function get_super_admin(){
 	$data = $this->db->query("SELECT * FROM tbl_super_admin");
 	 return $data->result();
 }

 public function get_all_company(){
 	$data = $this->db->query("SELECT * FROM tbl_company JOIN tbl_region ON tbl_region.region_id = tbl_company.region_id ORDER BY comp_id DESC");
 	 return $data->result();
 }


 public function get_all_blanchCom($comp_id){
 	$blanch = $this->db->query("SELECT * FROM tbl_blanch b JOIN tbl_region r ON r.region_id 
 	= b.region_id WHERE b.comp_id = '$comp_id'");
 	 return $blanch->result();
 }

 public function get_all_customer($comp_id){
 	$customer = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id' ORDER BY customer_id DESC");
 	  return $customer->result();
 }


 public function get_employee_email($comp_id){
 	$empl = $this->db->query("SELECT * FROM tbl_employee e JOIN tbl_blanch b ON b.blanch_id =  e.blanch_id WHERE e.comp_id = '$comp_id'");
 	 return $empl->result();
 }

 public function get_loanIncomeHistory($loan_id){
 	$income = $this->db->query("SELECT * FROM  tbl_receve r JOIN tbl_income i ON i.inc_id = r.inc_id LEFT JOIN tbl_employee e on e.empl_id = r.empl  WHERE r.loan_id = '$loan_id'");
 	 return $income->result();
 }

 public function get_compData($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
 	 return $data->row();
 }


 public function get_penddata($from,$to,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_loan_pending p JOIN tbl_blanch b ON b.blanch_id = p.blanch_id JOIN tbl_loans l ON l.loan_id = p.loan_id JOIN tbl_customer c ON c.customer_id = p.customer_id WHERE  p.pend_date between '$from' and '$to' AND p.blanch_id = '$blanch_id'");
 	return $data->result();
 }

 public function get_total_blanch($comp_id){
 	$blanch = $this->db->query("SELECT COUNT('comp_id') AS total_bla FROM tbl_blanch WHERE comp_id = '$comp_id'");
 	return $blanch->row();
 }

 public function get_managertest($empl_id){
 	$data = $this->db->query("SELECT * FROM tbl_employee WHERE empl_id = '$empl_id'");
 	 return $data->row();
 }


 public function get_sumEmployee($comp_id){
 	$empl = $this->db->query("SELECT COUNT(empl_id) AS total_employee FROM tbl_employee WHERE comp_id = '$comp_id'");
 	 return $empl->row();
 }

//total customer
 public function get_total_customer($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_cust FROM tbl_customer WHERE comp_id = '$comp_id'");
 	 return $customer->row();
 }

 public function get_total_customerBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_custBlanch FROM tbl_customer WHERE blanch_id = '$blanch_id'");
 	 return $customer->row();
 }

  public function get_total_customerActive($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_Active FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'open'");
 	 return $customer->row();
 }

  public function get_total_customerActiveBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_ActiveBla FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'open'");
 	 return $customer->row();
 }

  public function get_total_customerPending($comp_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_pending FROM tbl_customer WHERE comp_id = '$comp_id' AND customer_status = 'pending'");
 	 return $customer->row();
 }


  public function get_total_customerPendingBlanch($blanch_id){
 	$customer = $this->db->query("SELECT COUNT(customer_id) AS total_pendingblanch FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'pending'");
 	 return $customer->row();
 }

 public function get_loan_request($comp_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_request FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'open'");
 	 return $loan_request->row();
 }

  public function get_loan_requestBlanch($blanch_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_requests FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'open'");
 	 return $loan_request->row();
 }

 public function get_loan_Aproved($comp_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_aproved FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'aproved'");
 	 return $loan_request->row();
 }

  public function get_loan_AprovedBlanh($blanch_id){
 	$loan_request = $this->db->query("SELECT COUNT(loan_id) AS loan_aprovedBlanch FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'aproved'");
 	 return $loan_request->row();
 }

 public function get_today_loanPending($comp_id){
 	$date = date("Y-m-d");
 	$pendLoan = $this->db->query("SELECT COUNT(pend_id) AS loan_pend FROM tbl_loan_pending WHERE comp_id = '$comp_id'AND action_date >= '$date'");
 	 return $pendLoan->row();
 }

 public function get_today_loanPendingBlanch($blanch_id){
 	$date = date("Y-m-d");
 	$pendLoan = $this->db->query("SELECT COUNT(pend_id) AS loan_pends FROM tbl_loan_pending WHERE blanch_id = '$blanch_id'AND action_date >= '$date'");
 	 return $pendLoan->row();
 }

 public function loan_disbursedBlanch($blanch_id){
 	$disburse = $this->db->query("SELECT COUNT(loan_id) AS loandisburse FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'disbarsed'");
 	return $disburse->row();
 }



 public function get_total_recevableComp($comp_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_reje FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }

     public function get_total_recevableBlanchdata($blanch_id){
    	$date = date("Y-m-d");
    	$today_data = $this->db->query("SELECT SUM(restration) AS total_receiva FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND date_show = '$date'");
    	return $today_data->row();
    }


    public function get_recomended_expencesnumber($comp_id){
    	$data = $this->db->query("SELECT COUNT(req_id) AS expences_request FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'open'");
    	 return $data->row();
    }


    public function get_blanch_wallet($blanch_id){
    	$blanch_wallet = $this->db->query("SELECT SUM(blanch_amount) AS blanch_walet FROM tbl_transfor WHERE blanch_id = '$blanch_id'");
    	 return $blanch_wallet->row();
    }

    public function get_total_incomeBlanch($blanch_id){
    	$income = $this->db->query("SELECT SUM(receve_amount) AS total_incomeBlanch FROM tbl_receve WHERE blanch_id = '$blanch_id'");
    	return $income->row();
    }

    public function get_phoneNumber_match(){
    	$phone = $this->db->query("SELECT * FROM tbl_customer");
    	 return $phone->row();
    }

    public function get_sum_loanpend($comp_id){
    	$date = date("Y-m-d");
    	$loan_pend = $this->db->query("SELECT SUM(return_total) AS total_pend FROM tbl_loan_pending WHERE comp_id = '$comp_id' AND action_date >= '$date'");
    	 return $loan_pend->row();
    }

    public function get_sum_loanpendBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$loan_pend = $this->db->query("SELECT SUM(return_total) AS total_pendsy FROM tbl_loan_pending WHERE blanch_id = '$blanch_id' AND action_date >= '$date'");
    	 return $loan_pend->row();
    }


    public function get_outstand_total_blanch($blanch_id){
    	$outSatand = $this->db->query("SELECT SUM(remain_amount) AS total_remainblanch FROM tbl_outstand_loan WHERE blanch_id = '$blanch_id'");
    	return $outSatand->row();
    }

    public function get_customerCosed($blanch_id){
    	$closed = $this->db->query("SELECT COUNT(customer_id) AS total_closed FROM tbl_customer WHERE blanch_id = '$blanch_id' AND customer_status = 'close'");
    	 return $closed->row();
    }


    public function get_today_receivableBlanch($blanch_id){
    	$date = date("Y-m-d");
    	$receivable = $this->db->query("SELECT SUM(depost) AS today_blanchDepost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
    	 return $receivable->row();
    }

    public function get_requstExpensesBlanch($blanch_id){
    	$data = $this->db->query("SELECT COUNT(req_id) AS total_request_number FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_status = 'open'");
    	 return $data->row();
    }

   public function get_get_updated_request($req_id){
   	$data = $this->db->query("SELECT * FROM  tbl_request_exp WHERE req_id = '$req_id'");
   	return $data->row();
   }

   public function get_remain_company_balance($trans_id){
   	$data = $this->db->query("SELECT * FROM  tbl_ac_company WHERE trans_id = '$trans_id'");
   	 return $data->row();
   }

   public function get_remainBlanch_balance($trans_id){
   	$data = $this->db->query("SELECT * FROM tbl_transfor WHERE trans_id = '$trans_id'");
   	return $data->row();
   }

   public function get_blanch_account_remain($blanch_id){
   	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
   	 return $data->row();
   }

   public function check_name($f_name,$m_name,$l_name,$blanch_id,$comp_id){
		$data = $this->db->where(['f_name'=>$f_name , 'm_name'=>$m_name,'l_name'=>$l_name,'blanch_id'=>$blanch_id,'comp_id'=>$comp_id])
    	        ->get('tbl_customer');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

    public function check_national_Id($natinal_identity){
		$data = $this->db->where(['natinal_identity'=>$natinal_identity])
    	        ->get('tbl_sub_customer');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

       public function get_blanch_balance($blanch_id){
       	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
       	return $data->row();
       }

       public function get_receive_data($receved_id){
       	$data = $this->db->query("SELECT * FROM tbl_receve WHERE receved_id = '$receved_id'");
       	return $data->row();
       }


       public function get_sumLoanFee($comp_id){
       	$loanfee = $this->db->query("SELECT SUM(fee_interest) AS total_fee FROM tbl_loan_fee WHERE comp_id = '$comp_id'");
       	return $loanfee->row();
       }


	   public function get_customerData($customer_id){
		$customer = $this->db->query("
			SELECT 
				c.*, 
				b.blanch_name 
				
			FROM 
				tbl_customer c 
			LEFT JOIN 
				tbl_blanch b 
				ON b.blanch_id = c.blanch_id
			WHERE 
				c.customer_id = '$customer_id'
		");
		return $customer->row();
	}
	
	
	

       public function get_comp_data($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }


       public function delete_company($comp_id){
       	return $this->db->delete('tbl_company',['comp_id'=>$comp_id]);
       } 


       public function update_smsStatus($comp_id,$data){
       	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$data);
       }


       public function getOutstand_loanData($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE loan_id = '$loan_id'");
       	 return $data->row();
       }



       public function get_payID_outstand_loan($pay_id){
       	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE pay_id = '$pay_id'");
       	 return $data->row();
       }


       public function get_loanCustomerCode($customer_id){
       	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
       	 return $data->row();
       }


       public function get_customerLoanStatement($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_customer_report WHERE loan_id = '$loan_id'");
       	 return $data->row();
       }



       public function get_loan_aprove($comp_id){
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAprove FROM tbl_loans WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch open

       public function get_loan_aproveBlanch($blanch_id){
       		$date = date("Y-m-d");
         $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
         //print_r($back);
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAprove FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$back'");
       	 return $data->row();
       }

        public function get_loan_aproveclose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAproveclose FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal' AND disburse_day = '$day'");
       	 return $data->row();
       }
       //blanch close
        public function get_loan_aprovecloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAproveclose FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal' AND disburse_day = '$day'");
       	 return $data->row();
       }



       public function get_total_withAmount($comp_id){
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amount FROM tbl_loans WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch open

        public function get_total_withAmountBlanch($blanch_id){
        $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amount FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$back'");
       	 return $data->row();
       }

        public function get_total_withAmountclose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amountclose FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$day'");
       	 return $data->row();
       }
       //blanch close
       public function get_total_withAmountcloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(with_amount) AS withdrawal_amountclose FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$day'");
       	 return $data->row();
       }


       public function get_totalDepost($comp_id){
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depost FROM tbl_depost WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch depost

       public function get_totalDepostBlanch($blanch_id){
       	$date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$back'");
       	 return $data->row();
       }


        public function get_totalDepostClose($comp_id){
        $day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depostClose FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
       	 return $data->row();
       }

       //blanch close
        public function get_totalDepostCloseBlanch($blanch_id){
        $day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(depost) AS Total_depostClose FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
       	 return $data->row();
       }


       public function get_sumReceve($comp_id){
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaount FROM tbl_receve WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch receive open
     public function get_sumReceveBlanch($blanch_id){
     	  $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaount FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$back'");
       	 return $data->row();
       }

        public function get_sumReceveClose($comp_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaountClose FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$day'");
       	 return $data->row();
       }

       //blanch close
         public function get_sumReceveCloseBlanch($blanch_id){
        	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receve_amaountClose FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
       	 return $data->row();
       }


       public function get_expencesData($comp_id){
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE comp_id = '$comp_id'");
       	 return $data->row();
       }

       //blanch openexpences

        public function get_expencesDataBlanch($blanch_id){
        $date = date("Y-m-d");
        $back = date('Y-m-d', strtotime('-1 day', strtotime($date)));
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_exp FROM tbl_request_exp WHERE comp_id = '$blanch_id' AND req_date = '$back' AND req_status = 'accept'");
       	 return $data->row();
       }

       public function get_expencesDataClose($comp_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expClose FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept' AND req_date = '$day'");
       	 return $data->row();
       }

       public function get_expencesDataCloseBlanch($blanch_id){
       	$day = date("Y-m-d");
       	$data = $this->db->query("SELECT SUM(req_amount) AS total_expClose FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$day'");
       	 return $data->row();
       }


       public function get_loanOpen_skip($customer_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.customer_id = '$customer_id' AND l.loan_status = 'open' ORDER BY l.loan_id DESC LIMIT 1");
       	return $loan->row();
       }

//data available
       public function get_loanOpen_skipReject($customer_id){
       	$loan = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.customer_id = '$customer_id' AND l.loan_status = 'reject' ORDER BY l.loan_id DESC LIMIT 1");
       	return $loan->row();
       }


       public function upadete_loan($data,$loan_id){
       	return $this->db->where('loan_id',$loan_id)->update('tbl_loans',$data);
       }



       public function get_localgovernmentDetail($loan_id){
       	$data = $this->db->query("SELECT * FROM tbl_attachment JOIN tbl_region ON tbl_region.region_id = tbl_attachment.region_oficer WHERE loan_id = '$loan_id'");
       	 return $data->row();
       }


       public function update_localDetail($data,$attach_id){
       	return $this->db->where('attach_id',$attach_id)->update('tbl_attachment',$data);
       }



       public function get_total_depost($loan_id){
       	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE loan_id = '$loan_id'");
       	 return $data->row();
       }

	   public function get_total_and_latest_deposit($loan_id) {
    $query = $this->db->query("
        SELECT 
            SUM(depost) AS total_depost,
            (SELECT depost FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY deposit_day DESC LIMIT 1) AS latest_deposit,
            (SELECT deposit_day FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY deposit_day DESC LIMIT 1) AS latest_deposit_day
        FROM tbl_depost
        WHERE loan_id = '$loan_id'
    ");
    return $query->row();
}


   public function get_all_customerBlanch($blanch_id){
 	$customer = $this->db->query("SELECT * FROM tbl_customer WHERE blanch_id = '$blanch_id' ORDER BY customer_id DESC");
 	  return $customer->result();
 }


 public function get_customerInfor($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id WHERE c.customer_id = '$customer_id'");
 	  return $data->row();
 }


 public function update_customerData($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
 }

 public function get_lastdata($customer_id){
 	$data = $this->db->query("SELECT * FROM tbl_sub_customer sc JOIN tbl_account_type at ON at.account_id = sc.account_id  WHERE sc.customer_id = '$customer_id'");
 	 return $data->row();
 }


 public function update_lastCustomerData($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_sub_customer',$data);
 }


 public function getTotal_reqExpences($comp_id){
 	$data = $this->db->query("SELECT SUM(req_amount) AS total_reqExp FROM tbl_request_exp WHERE comp_id = '$comp_id' AND req_status = 'accept'");
 	return $data->row();
 }


 public function get_loan_collection($comp_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,e.username  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE  l.comp_id = '$comp_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


  public function get_loan_collectionBlanch($blanch_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,e.username  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE  l.blanch_id = '$blanch_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


  public function get_total_penartData($loan_id){
		$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_amount FROM tbl_customer_report cr WHERE loan_id = '$loan_id' GROUP BY loan_id");
		if ($penart->row()) {
			return $penart->row()->total_penart_amount; 
		}
		return 0; 
		  }


 
		  



 public function get_paidPenart($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
 	 return $data->row();
 }


 public function get_total_loan($comp_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan FROM tbl_loans WHERE comp_id = '$comp_id'");
 	 return $data->row();
 }

  public function get_total_loanBlanch($blanch_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan FROM tbl_loans WHERE blanch_id = '$blanch_id'");
 	 return $data->row();
 }

 public function get_totalPaid_loan($comp_id){
 	$loan_paid = $this->db->query("SELECT SUM(depost) AS total_loan_depost FROM tbl_depost WHERE comp_id = '$comp_id'");
 	 return $loan_paid->row();
 }

  public function get_totalPaid_loanBlanch($blanch_id){
 	$loan_paid = $this->db->query("SELECT SUM(depost) AS total_loan_depost FROM tbl_depost WHERE blanch_id = '$blanch_id'");
 	 return $loan_paid->row();
 }


 public function get_total_penart($comp_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS penart_amount FROM tbl_customer_report WHERE comp_id = '$comp_id'");
 	return $penart->row();
 }


 public function get_total_penartBlanch($blanch_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS penart_amount FROM tbl_customer_report WHERE blanch_id = '$blanch_id'");
 	return $penart->row();
 }

 public function get_paid_penart($comp_id){
 	$penart_paid = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE comp_id = '$comp_id'");
 	return $penart_paid->row();
 }



 public function get_paid_penartBlanch($blanch_id){
 	$penart_paid = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE blanch_id = '$blanch_id'");
 	return $penart_paid->row();
 }







 public function filter_loanstatus($blanch_id,$loan_status,$comp_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,e.username  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  
	 WHERE l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND l.comp_id = '$comp_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }


 public function get_total_loanFilter($blanch_id,$loan_status,$comp_id){
 	$data = $this->db->query("SELECT SUM(loan_int) AS total_loan FROM tbl_loans WHERE  blanch_id = '$blanch_id' AND loan_status = '$loan_status' AND comp_id = '$comp_id'");
 	 return $data->row();
 }


  public function get_totalPaid_loanFilter($blanch_id,$loan_status,$comp_id){
 	$loan_paid = $this->db->query("SELECT SUM(d.depost) AS total_loan_depost,l.loan_status FROM tbl_depost d LEFT JOIN tbl_loans l ON l.loan_id = d.loan_id WHERE d.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND d.comp_id = '$comp_id'");
 	 return $loan_paid->row();
 }


 public function get_total_penartFilter($blanch_id,$loan_status,$comp_id){
 	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS penart_amount FROM tbl_customer_report cr LEFT JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE  l.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND cr.comp_id = '$comp_id'");
 	return $penart->row();
 }


 public function get_paid_penartFilter($blanch_id,$loan_status,$comp_id){
 	$penart_paid = $this->db->query("SELECT SUM(pn.penart_paid) AS total_penart_paid  FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id WHERE pn.blanch_id = '$blanch_id' AND l.loan_status = '$loan_status' AND  pn.comp_id = '$comp_id'");
 	return $penart_paid->row();
 }


 public function get_sum_dapost($loan_id){
 	$data = $this->db->query("SELECT SUM(depost) AS remain_balance_loan FROM tbl_depost WHERE loan_id = '$loan_id'");
 	  return $data->row();
 }


 public function get_customer_statusData($blanch_id,$comp_id,$customer_status){
 	$customer = $this->db->query("SELECT * FROM tbl_customer c JOIN tbl_region r ON r.region_id = c.region_id JOIN tbl_blanch b ON b.blanch_id = c.blanch_id WHERE c.blanch_id = '$blanch_id' AND c.comp_id = '$comp_id' AND c.customer_status = '$customer_status'");
 	 return $customer->result();
 }


public function get_interestFormular($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_formular_setting WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function remove_formular($id){
	return $this->db->delete('tbl_formular_setting',['id'=>$id]);
}


public function get_reminder_loan($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_company ca ON ca.comp_id = l.comp_id WHERE l.loan_id = '$loan_id'");
	 return $data->row();
}

  
//sms counter
 public function get_smsCountDate($comp_id){
 	$today = date("Y-m-d");
  $sms_count = $this->db->query("SELECT * FROM tbl_sms_count WHERE comp_id = '$comp_id' AND date = '$today'");
  return  $sms_count->row();
 }

 public function get_smshIStorY($comp_id){
 $data = $this->db->query("SELECT * FROM tbl_sms_count WHERE comp_id = '$comp_id'");
  return $data->result();
 }

  public function get_sumSmsHistory($comp_id){
 $data = $this->db->query("SELECT SUM(sms_number) AS total_sms_history FROM tbl_sms_count WHERE comp_id = '$comp_id'");
  return $data->row();
 }

 public function get_data_sms($from,$to,$comp_id){
 	$sms = $this->db->query("SELECT * FROM tbl_sms_count WHERE date between '$from' and '$to' AND comp_id = '$comp_id'");
 	return $sms->result();

}

public function get_sumSms_total($from,$to,$comp_id){
 	$sms = $this->db->query("SELECT SUM(sms_number) AS total_sms FROM tbl_sms_count WHERE date between '$from' and '$to' AND comp_id = '$comp_id'");
 	return $sms->row();

}

public function get_depost_adjust($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
	return $data->row();
}

public function loanWithdrawaldate($blanch_id,$from,$to,$empl_id){
	$data = $this->db->query("SELECT SUM(with_amount) AS total_with FROM tbl_loans WHERE disburse_day between '$from' and '$to' AND blanch_id = '$blanch_id' AND empl_id = '$empl_id'");
	return $data->row();
}

public function loanWithdrawaldate_all($blanch_id,$from,$to){
	$data = $this->db->query("SELECT SUM(with_amount) AS total_with FROM tbl_loans WHERE disburse_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_allEmployee_Block($comp_id){
	$data = $this->db->query("SELECT tbl_employee.empl_status FROM tbl_employee WHERE comp_id = '$comp_id'");
		return $data->row();

}



public function getEmployeesByBranch($comp_id, $blanch_id){
    $empl = $this->db->query("
        SELECT * 
        FROM tbl_employee e
        JOIN tbl_blanch b ON b.blanch_id = e.blanch_id
        JOIN tbl_position p ON p.position_id = e.position_id
        WHERE e.comp_id = '$comp_id'
          AND e.blanch_id = '$blanch_id'
          AND e.empl_status = 'open'
          AND e.ac_status = 'empl'
        ORDER BY e.empl_id DESC
    ");
    return $empl->result();
}




//Account Transaction

public function insert_account_name($data){
	return $this->db->insert('tbl_account_transaction',$data);
}

public function get_account_transaction($comp_id){
    $data = $this->db->query("SELECT * FROM tbl_account_transaction WHERE comp_id = '$comp_id'");
       return $data->result();
}

public function get_customer_account_verfied($blanch_id){
	$data = $this->db->query("SELECT * FROM  tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
	return $data->result();
}


public function delete_account($trans_id){
	return $this->db->delete('tbl_account_transaction',['trans_id'=>$trans_id]);
}


public function get_sumTotalCapital($comp_id){
	$data = $this->db->query("SELECT SUM(amount) AS total_capital FROM tbl_capital WHERE comp_id = '$comp_id'");
	   return $data->row();
}


public function get_total_sumaryAccount($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_ac_company ac JOIN tbl_account_transaction at ON at.trans_id = ac.trans_id WHERE ac.comp_id = '$comp_id'");
	  return $data->result();
}


public function get_account_balance($trans_id){
	$data = $this->db->query("SELECT * FROM tbl_ac_company WHERE trans_id = '$trans_id'");
	 return $data->row();
}

public function get_ledyAmount($to_account,$blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE receive_trans_id = '$to_account' AND blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_sumTransfor_chargers($comp_id){
	$data = $this->db->query("SELECT SUM(charger) AS total_chargers FROM tbl_transfor WHERE comp_id = '$comp_id'");
	 return $data->row();
}


public function get_sumBlanchCpital($blanch_id){
	$capital_blanch = $this->db->query("SELECT SUM(blanch_capital) AS total_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	 return $capital_blanch->row();
}


public function get_sum_companyBalance($comp_id){
	$data = $this->db->query("SELECT SUM(comp_balance) AS total_comp_balance FROM tbl_ac_company WHERE comp_id = '$comp_id'");
	  return $data->row();
}


public function get_amount_remainAmountBlanch($blanch_id,$payment_method){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$payment_method'");
	return $data->row();
}

public function get_sumfeepercentage($loan_id){
   $data = $this->db->query("SELECT SUM(fee_percentage) AS total_fee  FROM tbl_pay WHERE loan_id = '$loan_id'");
    return $data->row();
}


public function get_loanDeletedata($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	  return $data->row();
}

public function get_total_loanDeposit($loan_id){
	$data = $this->db->query("SELECT SUM(depost) AS total_loanDepost FROM tbl_depost WHERE loan_id = '$loan_id'");
	 return $data->row();
}

public function get_Desc_depost($loan_id){
	$data = $this->db->query("SELECT * FROM  tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC");
	  return $data->row();
}


public function get_sum_total_BlanchCapital($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_capital_blanch FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_blanch_depost_Balance($comp_id){
	$date = date("Y-m-d");
	$depost = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
	return $depost->row();
}

public function get_total_loanWithdrawal($comp_id){
	$date = date("Y-m-d");
  $data = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_withdrawal FROM tbl_loans WHERE comp_id = '$comp_id' AND region_id = 'ok' AND disburse_day = '$date'");
  return $data->row();
}


public function check_nonDeducted_balance($comp_id,$blanch_id){
	$data = $this->db->query("SELECT * FROM  tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}

public function get_deducted_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
	 return $data->row();
}


 public function get_interest_loan($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE pr.loan_id = '$loan_id'");
 	return $data->row();
 }


 public function get_depost_record_data($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC");
 	 return $data->row();
 }

 public function get_amount_deducted($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_deducted_fee WHERE loan_id = '$loan_id'");
 	 return $data->row();
 }


 public function get_sum_nonDeducted_fee($loan_id){
 	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive,blanch_id FROM tbl_receve WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_non_deducted_balance($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }

 public function get_sum_receive_deducted($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
 	return $data->row();
 }


 public function get_deducted_income($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT * FROM tbl_deducted_fee df LEFT JOIN tbl_loans l ON l.loan_id = df.loan_id LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_blanch b ON b.blanch_id = df.blanch_id WHERE df.comp_id = '$comp_id' AND df.deducted_date = '$today'");
 	return $data->result();
 }


 public function get_total_deducted_income($comp_id){
 	$today = date("Y-m-d");
 	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$today'");
 	return $data->row();
 }


 public function get_deducted_account_balance($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_receive_deducted rd JOIN tbl_blanch b ON b.blanch_id = rd.blanch_id WHERE rd.comp_id = '$comp_id'");
 	 return $data->result();
 }


 public function fetch_blanch_account_data($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('ac_id', 'ASC');
  $query = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
  $output = '<option value="">Select Account</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->receive_trans_id.'">'.$row->account_name. '</option>';
  }
  return $output;
 }

 public function get_blance_deducted_fee($from_blanch){
 	$data = $this->db->query("SELECT * FROM  tbl_receive_deducted WHERE blanch_id = '$from_blanch'");
 	return $data->row();
 }

 public function get_blanch_accountBalance($to_blanch,$to_blanch_account){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$to_blanch' AND receive_trans_id = '$to_blanch_account'");
 	return $data->row();
 }

 public function get_balance_nonDeducted($from_blanch){
 	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$from_blanch'");
 	return $data->row();
 }


public function check_company_account($comp_id,$to_comp_account){
	$data = $this->db->query("SELECT * FROM  tbl_ac_company WHERE comp_id = '$comp_id' AND trans_id = '$to_comp_account'");
	return $data->row();
}

public function get_blanch_blanchdata($comp_id){
	$data = $this->db->query("SELECT tbb.deduct_type,tbb.from_blanch_id,tbb.from_mount,tbb.to_blanch_id,tbb.to_blach_account_id,tbb.trans_fee,tbb.user_trans,tbb.date_transfor,at.account_name,b.blanch_name AS from_blanch ,tb.blanch_name AS to_blanch,tbb.trans_fee,tbb.user_trans,tbb.date_transfor FROM  tbl_transfor_blanch_blanch tbb LEFT JOIN tbl_blanch b ON b.blanch_id = tbb.from_blanch_id JOIN tbl_account_transaction at ON at.trans_id = tbb.to_blach_account_id JOIN tbl_blanch tb ON tb.blanch_id = tbb.to_blanch_id WHERE tbb.comp_id = '$comp_id'");
	return $data->result();
}


public function get_branch_comTransaction($comp_id){
 $data = $this->db->query("SELECT * FROM tbl_transfor_blanch_company bc LEFT JOIN tbl_blanch b ON b.blanch_id = bc.from_blanch LEFT JOIN tbl_account_transaction at ON at.trans_id = bc.to_comp_account WHERE bc.comp_id = '$comp_id'");
 return $data->result();
}

public function get_totalBlanch_comptrans($comp_id){
$total = $this->db->query("SELECT SUM(balance) AS total_blanch_comp FROM  tbl_transfor_blanch_company WHERE comp_id = '$comp_id'");
return $total->row();
}

public function total_chargers_comp($comp_id){
	$data = $this->db->query("SELECT SUM(trans_fee) AS total_fee FROM  tbl_transfor_blanch_company WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_totaldeducted_blanch($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_deducted rd JOIN tbl_blanch b ON b.blanch_id = rd.blanch_id WHERE rd.comp_id = '$comp_id'");
	return $data->result();
}

public function getTotal_deducted($comp_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted FROM tbl_receive_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_nondeducted_blanch($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted nd JOIN tbl_blanch b ON b.blanch_id = nd.blanch_id WHERE nd.comp_id = '$comp_id'");
	return $data->result();
}

public function getTotal_deductednon($comp_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nondeducted FROM tbl_receive_non_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function view_income_balance($blanch_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_blanch FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_nondeducted_blanchBalance($blanch_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nonBlance FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_blanch_accountExpenses($blanch_id,$trans_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id'");
	return $data->row();
}

public function get_sum_principal_depost($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_interest_depost($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_principal_depostBranch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_sum_interest_depostBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}


public function get_total_interest_total($comp_id){
	$interest = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'withdrawal'");
	return $interest->row();
}

public function get_total_interest_totalOut($comp_id){
	$interest = $this->db->query("SELECT SUM(sche_interest) AS total_interestout FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out'");
	return $interest->row();
}



public function get_total_principal_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_total_principal_repaymentout($comp_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principalOut FROM tbl_depost WHERE comp_id = '$comp_id' AND dep_status = 'out'");
	return $data->row();
}


public function get_fee_deducted_total($comp_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_fee FROM tbl_receive_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_sum_nonDeducted($comp_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nondeducted FROM tbl_receive_non_deducted WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_blanch_capitalPrincipal($comp_id,$blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND princ_status = '$princ_status'");
	return $data->row();
}

public function get_blanch_interest_capital($comp_id,$blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND int_status = '$princ_status'");
	return $data->row();
}


public function get_interest_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_capital_interest FROM tbl_blanch_capital_interest WHERE comp_id = '$comp_id' AND int_status = 'withdrawal'");
	return $data->row();
}


public function get_principal_blanchAccount($comp_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal FROM tbl_blanch_capital_principal WHERE comp_id = '$comp_id' AND princ_status = 'withdrawal'");
	return $data->row();
}


public function get_default_interest_repayment($comp_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS default_interest FROM tbl_blanch_capital_interest WHERE comp_id = '$comp_id' AND int_status = 'out'");
	return $data->row();
}


public function get_principal_blanchAccountDefault($comp_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_default FROM tbl_blanch_capital_principal WHERE comp_id = '$comp_id' AND princ_status = 'out'");
	return $data->row();
}


public function get_accept_expensesBlanch($comp_id){
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_exp,b.blanch_name FROM tbl_request_exp re LEFT JOIN tbl_blanch b ON b.blanch_id = re.blanch_id WHERE re.comp_id = '$comp_id' GROUP BY re.blanch_id");
	return $data->result();
}

public function get_sum_blanch_total_expenses($comp_id){
	$data = $this->db->query("SELECT SUM(req_amount) AS total_expense_data FROM tbl_request_exp WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_account_balance_blanch($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_balance,account_name FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.comp_id = '$comp_id' GROUP BY ba.receive_trans_id");
		return $data->result();
	
}

public function get_total_blanch_capital($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_balanch_amount FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function get_depost_loan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,at.account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	return $data->result();
}

public function get_depost_loan_withdrawal_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost,at.account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	return $data->result();
}



public function get_total_depostloan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depostinloan FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$day' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_total_depostloan_withdrawalBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depostinloan FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day' AND dep_status = 'withdrawal'");
	return $data->row();
}

public function get_loanDepost_out($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOut,account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
	return $data->result();
}

public function get_loanDepost_out_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOut,account_name FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
	return $data->result();
}

public function get_sumloanDepost_out($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOutData FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.comp_id = '$comp_id' AND d.depost_day = '$day' AND d.dep_status = 'out'");
	return $data->row();
}

public function get_sumloanDepost_outBlanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_deposOutData FROM tbl_depost d JOIN tbl_account_transaction at ON at.trans_id = d.depost_method WHERE d.blanch_id = '$blanch_id' AND d.depost_day = '$day' AND d.dep_status = 'out'");
	return $data->row();
}

public function get_loanWithdrawal_today($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_withloan,at.account_name FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$day' GROUP BY l.method");
	return $data->result();
}

public function get_loanWithdrawal_today_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_withloan,at.account_name FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$day' GROUP BY l.method");
	return $data->result();
}

public function get_sumloan_withdrawal($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWithdrawal FROM tbl_loans WHERE comp_id = '$comp_id' AND disburse_day = '$day' AND loan_status = 'withdrawal'");
	return $data->row();
}

public function get_sumloan_withdrawal_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanWithdrawal FROM tbl_loans WHERE blanch_id = '$blanch_id' AND disburse_day = '$day' AND loan_status = 'withdrawal'");
	return $data->row();
}

public function get_today_expenses($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,at.account_name FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$day' GROUP BY re.trans_id");
	return $data->result();
}

public function get_today_expenses_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS total_expenses,at.account_name FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$day' GROUP BY re.trans_id");
	return $data->result();
}


public function get_today_sumExpenses($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS sum_expenses FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.comp_id = '$comp_id' AND re.req_date = '$day'");
	return $data->row();
}

public function get_today_sumExpenses_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(re.req_amount) AS sum_expenses FROM tbl_request_exp re JOIN tbl_account_transaction at ON at.trans_id = re.trans_id WHERE re.blanch_id = '$blanch_id' AND re.req_date = '$day'");
	return $data->row();
}

public function get_today_deducted_fee($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE comp_id = '$comp_id' AND deducted_date = '$day'");
	return $data->row();
}

public function get_today_deducted_fee_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}


public function get_non_deducted_feeToday($comp_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondeducted FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$day'");
	return $data->row();
}

public function get_non_deducted_feeToday_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nondeducted FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_deducted_balance_blanch($blanch_id){
    $day = date("Y-m-d");

    $data = $this->db->query("
        SELECT df.*, l.*, c.*, b.*
        FROM tbl_deducted_fee df
        JOIN tbl_loans l ON l.loan_id = df.loan_id
        JOIN tbl_customer c ON c.customer_id = l.customer_id
        JOIN tbl_blanch b ON b.blanch_id = df.blanch_id
        WHERE df.blanch_id = '$blanch_id'
        AND df.deducted_date = '$day'
    ");

    return $data->result();
}


	  public function get_sms_penart($customer_id)
	  {
		  $data = $this->db->query("
			  SELECT 
				  c.phone_no,
				  c.f_name,
				  c.m_name,
				  c.l_name,
				  b.blanch_name
			  FROM tbl_customer c
			  JOIN tbl_blanch b ON c.blanch_id = b.blanch_id
			  WHERE c.customer_id = '$customer_id'
		  ");
		  return $data->row();
	  }


	  public function get_receive_details_by_customer($customer_id)
{
    $sql = "
        SELECT 
            r.*, 
            b.blanch_name, 
            e.empl_name, 
            c.f_name, 
            c.m_name, 
            c.l_name, 
            c.phone_no
        FROM tbl_receve r
        JOIN tbl_blanch b ON r.blanch_id = b.blanch_id
        JOIN tbl_employee e ON r.empl = e.empl_id
        JOIN tbl_customer c ON r.customer_id = c.customer_id
        WHERE r.customer_id = ?
    ";
    $data = $this->db->query($sql, array($customer_id));
    return $data->result(); // changed to result() because one customer can have many receives
}


public function get_total_receive_amount_by_blanch($blanch_id)
{
    $sql = "
        SELECT 
            SUM(r.receve_amount) AS total_receive
        FROM tbl_receve r
        WHERE r.blanch_id = ?
          AND DATE(r.receve_day) = CURDATE()
    ";
    $query = $this->db->query($sql, array($blanch_id));
    $result = $query->row();

    if ($result && isset($result->total_receive)) {
        return $result->total_receive;
    } else {
        return 0;
    }
}


public function get_today_deducted_feeblanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}

public function getprincipal_account($blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM  tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND princ_status = '$princ_status'");
	return $data->row();
}

public function get_blanch_account_target($blanch_id,$trans_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id'");
	return $data->row();
}


public function get_interest_blanch_capital($blanch_id,$trans_id,$princ_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' AND int_status = '$princ_status'");
	return $data->row();
}

public function get_today_transaction_principal_int($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM  tbl_principal_int_transfor it JOIN tbl_account_transaction at ON at.trans_id = it.from_account WHERE it.blanch_id = '$blanch_id' AND it.date_trans = '$day'");
	return $data->result();
}

public function get_total_transfor($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(balance) AS total_tranfor FROM tbl_principal_int_transfor WHERE blanch_id = '$blanch_id' AND date_trans = '$day'");
	return $data->row();
}

public function get_total_branchAccount($blanch_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_amount FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_principal_repayment($blanch_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_with FROM  tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND princ_status = 'withdrawal'");
	return $data->row();
}

public function get_principal_repayment_out($blanch_id){
	$data = $this->db->query("SELECT SUM(principal_balance) AS total_principal_out FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND princ_status = 'out'");
	return $data->row();
}

public function get_total_repayment_interest($blanch_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_interest_withdrawal FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND int_status = 'withdrawal'");
	return $data->row();
}

public function get_total_repayment_interestout($blanch_id){
	$data = $this->db->query("SELECT SUM(capital_interest) AS total_interest_out FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND int_status = 'out'");
	return $data->row();
}

public function get_deducted_feeBlanch($blanch_id){
	$data = $this->db->query("SELECT SUM(deducted) AS total_deducted_fee FROM tbl_receive_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_nonDeducted_Blanchdata($blanch_id){
	$data = $this->db->query("SELECT SUM(non_balance) AS total_nonBalance FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_today_income_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $data->row();
}

public function get_today_nonDeducted_fee($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_nonDeducted_fee FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_blanch_account_summary($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_today_summary_transformation($blanch_id){
	$day = date("Y-m-d");
	$loan = $this->db->query("SELECT SUM(l.loan_aprove) AS total_with,at.trans_id,at.account_name,l.method,l.blanch_id FROM tbl_loans l JOIN tbl_account_transaction at ON at.trans_id = l.method WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.region_id = 'ok' AND l.disburse_day = '$day' GROUP BY at.trans_id");
	foreach ($loan->result() as $r) {
	  $r->total_principal_repayment = $this->get_today_principal_repaymrnt($r->method,$blanch_id);
	  $r->total_principal_out = $this->get_principal_repayment_out_today($r->method,$blanch_id);
	  $r->total_interest_with = $this->get_interest_with_repayment($r->method,$blanch_id);
	  $r->total_interest_out = $this->get_interest_out_repayment($r->method,$blanch_id);
	  $r->total_expenses = $this->get_today_expensesblanch($r->method,$blanch_id);
	}
	return $loan->result();
}


public function get_today_principal_repaymrnt($method,$blanch_id){
$day = date("Y-m-d");
$principal = $this->db->query("SELECT SUM(d.sche_principal) AS total_principal_repayment FROM tbl_depost d WHERE blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.depost_day = '$day' AND d.dep_status = 'withdrawal' GROUP BY d.depost_method");
 if ($principal->row()) {
      return $principal->row()->total_principal_repayment; 
    }
    return 0; 

}


public function get_principal_repayment_out_today($method,$blanch_id){
$day = date("Y-m-d");
$principal = $this->db->query("SELECT SUM(d.sche_principal) AS total_principal_out FROM tbl_depost d WHERE blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.depost_day = '$day' AND d.dep_status = 'out' GROUP BY d.depost_method");
 if ($principal->row()) {
      return $principal->row()->total_principal_out; 
    }
    return 0; 
}




public function get_interest_with_repayment($method,$blanch_id){
	$day = date("Y-m-d");
	$interest = $this->db->query("SELECT SUM(d.sche_interest) AS total_interest_with FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.dep_status = 'withdrawal' AND d.depost_day = '$day' GROUP BY d.depost_method");
	if ($interest->row()) {
      return $interest->row()->total_interest_with; 
    }
    return 0; 
}

public function get_interest_out_repayment($method,$blanch_id){
 $day = date("Y-m-d");
 $interest = $this->db->query("SELECT SUM(d.sche_interest) AS total_interest_out FROM tbl_depost d WHERE d.blanch_id = '$blanch_id' AND d.depost_method = '$method' AND d.dep_status = 'out' AND d.depost_day = '$day' GROUP BY d.depost_method");
	if ($interest->row()) {
      return $interest->row()->total_interest_out; 
    }
    return 0; 	
}


public function get_today_expensesblanch($method,$blanch_id){
$day = date("Y-m-d");
$expenses = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM tbl_request_exp e WHERE e.blanch_id = '$blanch_id' AND e.trans_id = '$method' AND e.req_date = '$day' GROUP BY e.trans_id");
if ($expenses->row()) {
      return $expenses->row()->total_expenses; 
    }
    return 0; 
}


public function get_total_today_loanWithdrawal($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_withdrawal_today FROM tbl_loans l WHERE blanch_id = '$blanch_id' AND l.disburse_day = '$day'");
	return $data->row();
}

public function get_total_principal_repayment_blanch($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal_rep FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_total_interest_repayment($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest_rep FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$day'");
	return $data->row();
}

public function get_total_expenses_today($blanch_id){
	$day = date("Y-m-d");
	$expense = $this->db->query("SELECT SUM(req_amount) AS total_request_amount FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND req_date = '$day'");
	return $expense->row();
}

public function get_tot_deducted_feetoday($blanch_id){
	$day = date("Y-m-d");
	$deducted = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_today FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id' AND deducted_date = '$day'");
	return $deducted->row();
}

public function get_total_non_deducted_fee($blanch_id){
	$day = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_today FROM  tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$day'");
	return $data->row();
}


public function get_loan_status($customer_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE customer_id = '$customer_id' ORDER BY loan_id DESC LIMIT 1");
	return $data->row();
}


public function get_principal_repayment_account($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal pc JOIN tbl_account_transaction at ON at.trans_id = pc.trans_id WHERE pc.blanch_id = '$blanch_id'");
	return $data->result();
}

  public function get_loan_schedule_customer($loan_id){
   	$loan = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_loan_category lt ON lt.category_id = l.category_id LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_sub_customer s ON s.customer_id = l.customer_id LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = l.method  WHERE l.loan_id = '$loan_id' ");
       return $loan->row();
   }
   
public function get_interest_summary($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest ic JOIN tbl_account_transaction at ON at.trans_id = ic.trans_id WHERE ic.blanch_id = '$blanch_id'");
	return $data->result();
}


public function income_receive_delete($receved_id){
	$data = $this->db->query("SELECT * FROM tbl_receve WHERE receved_id = '$receved_id'");
	return $data->row();
}


public function get_data_paypenart($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_receive_nonDeducted($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_receive_non_deducted WHERE blanch_id = '$blanch_id'");
	return $data->row();
}

public function get_total_loan_principal($loan_id){
	$data = $this->db->query("SELECT SUM(sche_principal) AS total_principal FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_total_loan_interest($loan_id){
	$data = $this->db->query("SELECT SUM(sche_interest) AS total_interest FROM tbl_depost WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_principal_remain($blanch_id,$payment_method,$loan_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_principal WHERE blanch_id = '$blanch_id' AND trans_id = '$payment_method' AND princ_status = '$loan_status'");
	return $data->row();
}


public function get_interest_remain($blanch_id,$payment_method,$loan_status){
	$data = $this->db->query("SELECT * FROM tbl_blanch_capital_interest WHERE blanch_id = '$blanch_id' AND trans_id = '$payment_method' AND int_status = '$loan_status'");
	return $data->row();
}


public function get_blanch_capital_balance($blanch_id,$payment_method){
	$balance = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$payment_method'");
	return $balance->row();
}


// public function get_total_amount_depost_loan($loan_id){
//  	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE loan_id = '$loan_id'");
//  	return $data->row();
//  }

public function get_comapanydetail($comp_id)
{
	$data = $this->db->query("SELECT * FROM tbl_company WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function block_company($comp_id,$comp_data)
{
	return $this->db->where('comp_id',$comp_id)->update('tbl_company',$comp_data);
}


public function get_blanch_capital_data($blanch_id)
{
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_blanch_balance_fee($comp_id)
{
	$data = $this->db->query("SELECT * FROM tbl_blanch b LEFT JOIN tbl_receive_deducted rd ON rd.blanch_id = b.blanch_id LEFT JOIN tbl_receive_non_deducted rn ON rn.blanch_id = b.blanch_id WHERE b.comp_id = '$comp_id'");
	return $data->result();
}


public function get_cashflow_accumlation($blanch_id)
{
 $data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
 return $data->result();
}

public function get_total_accumlation($blanch_id)
{
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_blanch_capital FROM tbl_blanch_account WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function update_member_status($data,$customer_id){
	return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
}


public function get_total_loanGroup($comp_id,$group_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loan, SUM(loan_int) AS total_loanint FROM tbl_loans WHERE comp_id = '$comp_id' AND group_id = '$group_id'");
	return $data->row();
}
public function get_total_depostGroup($comp_id,$group_id){
	$data = $this->db->querY("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE comp_id = '$comp_id' AND group_id = '$group_id'");
	return $data->row();
}


public function insert_miamala($data){
	return $this->db->insert('tbl_miamala',$data);
}


public function get_miamala($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_miamala WHERE blanch_id = '$blanch_id' AND date = '$date'");
	return $data->result();
}

public function delete_miamala($id){
	return $this->db->delete('tbl_miamala',['id'=>$id]);
}


public function update_miamala($data,$id){
	return $this->db->where('id',$id)->update('tbl_miamala',$data);
}

public function get_comp_miamala_dada($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_miamala m JOIN tbl_blanch b ON b.blanch_id = m.blanch_id WHERE m.comp_id = '$comp_id'");
	return $data->result();
}

public function get_total_miamala($comp_id){
	$data = $this->db->query("SELECT SUM(amount) AS total_amount FROM tbl_miamala WHERE comp_id = '$comp_id' AND status = 'open'");
	return $data->row();
}

public function get_miamala_depost($id){
	$miamala = $this->db->query("SELECT * FROM tbl_miamala WHERE id = '$id'");
	return $miamala->row();
}


public function get_general_loanGroup($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.comp_id = '$comp_id' AND  NOT l.empl_id = '0' AND NOT l.group_id = '0' GROUP BY l.empl_id");
	return $data->result();
}

public function get_general_loanGroupblanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.blanch_id = '$blanch_id' AND  NOT l.empl_id = '0' AND NOT l.group_id = '0' GROUP BY l.empl_id");
	return $data->result();
}


public function get_empl_group($empl_id){
	$data = $this->db->query("SELECT g.group_name,g.group_id FROM tbl_loans l JOIN tbl_group g ON g.group_id = l.group_id WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.group_id");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_deposit_group($r->group_id);
		$r->total_restoration = $this->get_restoration($r->group_id);
		$r->total_loan_aprove = $this->get_total_aproved($r->group_id);
		$r->total_tommorow = $this->tommorow_collection($r->group_id);
		$r->total_penart = $this->totLgroup_penart($r->group_id);
		$r->total_penart_paid = $this->pay_group_penart($r->group_id);
		$r->total_deducted_fee = $this->get_total_income($r->group_id);
		$r->total_loan_disbursed = $this->get_total_disbursement($r->group_id);
	}
	return $data->result();
}


public function get_total_deposit_group($group_id){
		$depost = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id  WHERE d.group_id = '$group_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal'  GROUP BY d.group_id ORDER BY l.loan_id DESC ");
		if ($depost->row()) {
			return $depost->row()->total_depost; 
		}
		return 0; 
}

public function get_restoration($group_id){
$restoration = $this->db->query("SELECT SUM(restration) AS total_restoration FROM tbl_loans l  WHERE l.group_id = '$group_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal' GROUP BY l.group_id ORDER BY l.loan_id DESC");
		if ($restoration->row()) {
			return $restoration->row()->total_restoration; 
		}
		return 0; 
}

public function get_total_aproved($group_id){
 $loan_aprove = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_aprove FROM tbl_loans l  WHERE l.group_id = '$group_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'aproved' GROUP BY l.group_id ORDER BY l.loan_id DESC");
		if ($loan_aprove->row()) {
			return $loan_aprove->row()->total_loan_aprove; 
		}
		return 0; 
}


public function tommorow_collection($group_id){
	$date = date("Y-m-d");
  $front = date('Y-m-d', strtotime('+1 day', strtotime($date)));
 $tommorow = $this->db->query("SELECT SUM(restration) AS total_tommorow FROM tbl_loans l  WHERE l.group_id = '$group_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.date_show = '$front' AND loan_status = 'withdrawal'  GROUP BY l.group_id ORDER BY l.loan_id DESC ");
 if ($tommorow->row()) {
			return $tommorow->row()->total_tommorow; 
		}
		return 0; 
 }


 public function totLgroup_penart($group_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE cr.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY cr.group_id ORDER BY l.loan_id DESC");
 	if ($penart->row()) {
			return $penart->row()->total_penart; 
		}
		return 0; 
 }


 public function pay_group_penart($group_id){
 	$pay_penart = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id  WHERE pn.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY pn.group_id ORDER BY l.loan_id DESC");
  	if ($pay_penart->row()){
			return $pay_penart->row()->total_penart_paid; 
		}
		return 0;  
 }


 public function get_total_income($group_id){
 	$income = $this->db->query("SELECT SUM(df.deducted_balance) AS total_deducted_fee FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id WHERE df.group_id = '$group_id' AND loan_status = 'withdrawal' GROUP BY df.group_id ORDER BY l.loan_id DESC");
 	 	if ($income->row()) {
			return $income->row()->total_deducted_fee; 
		}
		return 0;
 }


 public function get_total_disbursement($group_id){
 	$disburse = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_disbursed FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = 'disbarsed'  GROUP BY group_id ORDER BY loan_id DESC");
   if ($disburse->row()) {
   	return $disburse->row()->total_loan_disbursed;
   }
   return 0;

 }


 public function get_total_aproved_group_empl($empl_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
 	 foreach ($data->result() as $r) {
 	 	$r->total_tommor_collection = $this->get_emplgroup_tommorow($r->empl_id);
 	 	$r->total_depost_empl = $this->get_total_depost_empl_depost($r->empl_id);
 	 	$r->total_penart_empl = $this->totLgroup_penart_empl($r->empl_id);
 	 	$r->total_penart_paid_empl = $this->pay_group_penart_empl($r->empl_id);
 	 	$r->total_deducted_fee_empl = $this->get_total_income_empl($r->empl_id);
 	 	$r->total_restoration_empl = $this->get_restoration_empl($r->empl_id);
 	 	$r->total_loan_disbursed_empl = $this->get_total_disbursement_empl($r->empl_id);
 	 	$r->total_loan_aprove_empl = $this->get_total_aproved_empl($r->empl_id);
  }
 	return $data->result();
 }


 public function get_emplgroup_tommorow($empl_id){
 	$date = date("Y-m-d");
  $front = date('Y-m-d', strtotime('+1 day', strtotime($date)));
 $tommorow = $this->db->query("SELECT SUM(l.restration) AS total_tommor_collection FROM tbl_loans l  WHERE l.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.date_show = '$front' AND loan_status = 'withdrawal' GROUP BY l.empl_id");
 if ($tommorow->row()) {
			return $tommorow->row()->total_tommor_collection; 
		}
		return 0; 
 }


 public function get_total_depost_empl_depost($empl_id){
 	$depost = $this->db->query("SELECT SUM(depost) AS total_depost_empl FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id WHERE d.empl_id = '$empl_id' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND l.loan_status = 'withdrawal' GROUP BY d.empl_id");
 	// print_r($depost);
 	// exit();
	 if ($depost->row()) {
			return $depost->row()->total_depost_empl; 
	 }
	 return 0;
 }


 public function totLgroup_penart_empl($empl_id){
 	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_empl FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id ORDER BY l.loan_id DESC");
 	if ($penart->row()) {
			return $penart->row()->total_penart_empl; 
		}
		return 0; 
 }


  public function pay_group_penart_empl($empl_id){
 	$pay_penart = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid_empl FROM tbl_pay_penart pn JOIN tbl_loans l ON l.loan_id = pn.loan_id  WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
  	if ($pay_penart->row()){
			return $pay_penart->row()->total_penart_paid_empl; 
		}
		return 0;  
 }


  public function get_total_income_empl($empl_id){
 	$income = $this->db->query("SELECT SUM(df.deducted_balance) AS total_deducted_fee_empl FROM tbl_deducted_fee df JOIN tbl_loans l ON l.loan_id = df.loan_id WHERE l.empl_id = '$empl_id' AND loan_status = 'withdrawal' AND NOT l.group_id = '0' AND NOT l.empl_id = '0' GROUP BY l.empl_id");
 	 	if ($income->row()) {
			return $income->row()->total_deducted_fee_empl; 
		}
		return 0;
 }


 public function get_restoration_empl($empl_id){
$restoration = $this->db->query("SELECT SUM(restration) AS total_restoration_empl FROM tbl_loans l  WHERE l.empl_id = '$empl_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'withdrawal' GROUP BY l.empl_id");
		if ($restoration->row()) {
			return $restoration->row()->total_restoration_empl; 
		}
		return 0; 
}

public function get_total_disbursement_empl($empl_id){
 	$disburse = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_disbursed_empl FROM tbl_loans l WHERE l.empl_id = '$empl_id' AND l.loan_status = 'disbarsed' AND NOT l.group_id = '0' AND NOT l.empl_id = '0'  GROUP BY l.empl_id");
   if ($disburse->row()) {
   	return $disburse->row()->total_loan_disbursed_empl;
   }
   return 0;

 }


 public function get_total_aproved_empl($empl_id){
 $loan_aprove = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_aprove_empl FROM tbl_loans l  WHERE l.empl_id = '$empl_id'   AND NOT l.group_id = '0' AND NOT l.empl_id = '0' AND loan_status = 'aproved' GROUP BY l.empl_id");
		if ($loan_aprove->row()) {
			return $loan_aprove->row()->total_loan_aprove_empl; 
		}
		return 0; 
}





public function insert_loanfee_type($data){
	return $this->db->insert('tbl_fee_type',$data);
}

public function get_loanfee_type($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_type WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_loanfee_typeData($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_type WHERE comp_id = '$comp_id'");
	return $data->result();
}


public function update_loanfee_type($data,$id){
	return $this->db->where('id',$id)->update('tbl_fee_type',$data);
}

public function get_loan_income($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_id'");
	return $data->row();
}

public function get_group_loan($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_group WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function get_group_loan_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_group WHERE blanch_id = '$blanch_id'");
	return $data->result();
}


public function get_loan_group_customer($group_id){
	$data = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,l.loan_aprove,l.loan_int,l.restration,l.loan_id,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.group_id = '$group_id'");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_depost_customer($r->loan_id);
		$r->total_penart = $this->get_penart_group_customer($r->loan_id); 
		$r->total_paid_penart = $this->get_paid_penart_group($r->loan_id);
	}
	return $data->result();
}


public function get_loan_group_customer_status($group_id,$loan_status){
	$data = $this->db->query("SELECT c.f_name,c.m_name,c.l_name,l.loan_aprove,l.loan_int,l.restration,l.loan_id,l.loan_status,l.day FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id WHERE l.group_id = '$group_id' AND l.loan_status = '$loan_status'");
	foreach ($data->result() as $r) {
		$r->total_depost = $this->get_total_depost_customer($r->loan_id);
		$r->total_penart = $this->get_penart_group_customer($r->loan_id); 
		$r->total_paid_penart = $this->get_paid_penart_group($r->loan_id);
	}
	return $data->result();
}


public function get_total_depost_customer($loan_id){
	$depost = $this->db->query("SELECT SUM(d.depost) AS total_depost FROM tbl_depost d WHERE d.loan_id = '$loan_id' GROUP BY d.loan_id");
	if ($depost->row()) {
		return $depost->row()->total_depost;
	}
	return 0;
}


public function get_penart_group_customer($loan_id){
	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS total_penart FROM tbl_customer_report cr WHERE cr.loan_id = '$loan_id' GROUP BY cr.loan_id");
	if ($penart->row()) {
		return $penart->row()->total_penart;
	}
	return 0;
}


public function get_paid_penart_group($loan_id){
	$paid = $this->db->query("SELECT SUM(pn.penart_paid) AS total_paid_penart FROM tbl_pay_penart pn WHERE pn.loan_id = '$loan_id' GROUP BY pn.loan_id");
	if ($paid->row()) {
		return $paid->row()->total_paid_penart;
	}
	return 0;
}

 public function get_blanch_group($blanch_id,$loan_status){
  	$data = $this->db->query("SELECT * FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = '$loan_status' GROUP BY blanch_id");
  	return $data->row();
  }


public function get_total_group_loan($group_id){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loangroup,SUM(loan_int) AS total_int,SUM(restration) AS total_restoration,group_id FROM tbl_loans WHERE group_id = '$group_id' GROUP BY group_id");
	foreach ($data->result() as $r) {
		$r->total_depost_groups = $this->get_total_deposit_group_member($r->group_id);
		$r->total_penart_group = $this->get_penart_group_member($r->group_id);
		$r->total_paid = $this->get_paid_penart_member($r->group_id);
	}
	return $data->result();
}

public function get_total_group_loan_status($group_id,$loan_status){
	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loangroup,SUM(loan_int) AS total_int,SUM(restration) AS total_restoration,group_id,loan_status FROM tbl_loans WHERE group_id = '$group_id' AND loan_status = '$loan_status' GROUP BY group_id ");
	foreach ($data->result() as $r) {
		$r->total_depost_groups = $this->get_total_deposit_group_member_status($r->group_id,$loan_status);
		$r->total_penart_group = $this->get_penart_group_member_status($r->group_id,$loan_status);
		$r->total_paid = $this->get_paid_penart_member_status($r->group_id,$loan_status);
	}
	return $data->result();
}



public function get_total_deposit_group_member_status($group_id,$loan_status){
 $deposit = $this->db->query("SELECT SUM(d.depost) AS total_depost_groups FROM tbl_depost d JOIN tbl_loans l ON l.loan_id = d.loan_id  WHERE d.group_id = '$group_id' AND l.loan_status = '$loan_status'  GROUP BY d.group_id");
 if ($deposit->row()) {
  return $deposit->row()->total_depost_groups;
 }
 return 0;
}


public function get_penart_group_member_status($group_id,$loan_status){
	$penart = $this->db->query("SELECT SUM(cr.penart_amount) AS total_penart_group FROM tbl_customer_report cr JOIN tbl_loans l ON l.loan_id = cr.loan_id WHERE cr.group_id = '$group_id' AND l.loan_status = '$loan_status' GROUP BY cr.group_id");
	if ($penart->row()) {
		return $penart->row()->total_penart_group;
	}
	return 0;
}


public function get_paid_penart_member_status($group_id,$loan_status){
	$paid_data = $this->db->query("SELECT SUM(pp.penart_paid) AS total_paid FROM tbl_pay_penart pp JOIN tbl_loans l ON l.loan_id = pp.loan_id WHERE pp.group_id = '$group_id' AND l.loan_status = '$loan_status' GROUP BY pp.group_id");
	 if ($paid_data->row()) {
	 	 return $paid_data->row()->total_paid;
	 }
	 return 0;
}




public function get_total_deposit_group_member($group_id){
 $deposit = $this->db->query("SELECT SUM(depost) AS total_depost_groups FROM tbl_depost WHERE group_id = '$group_id' GROUP BY group_id");
 if ($deposit->row()) {
  return $deposit->row()->total_depost_groups;
 }
 return 0;
}


public function get_penart_group_member($group_id){
	$penart = $this->db->query("SELECT SUM(penart_amount) AS total_penart_group FROM tbl_customer_report WHERE group_id = '$group_id' GROUP BY group_id");
	if ($penart->row()) {
		return $penart->row()->total_penart_group;
	}
	return 0;
}

public function get_paid_penart_member($group_id){
	$paid_data = $this->db->query("SELECT SUM(penart_paid) AS total_paid FROM tbl_pay_penart WHERE group_id = '$group_id' GROUP BY group_id");
	 if ($paid_data->row()) {
	 	 return $paid_data->row()->total_paid;
	 }
	 return 0;
}

public function insert_loanFee_category($data){
	return $this->db->insert('tbl_fee_category',$data);
}


public function get_loanfee_category($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_category WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function get_loanfee_categoryData($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_fee_category WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function modify_loanFee_category($data,$id){
	return $this->db->where('id',$id)->update('tbl_fee_category',$data);
}


public function get_loanproduct_fee($loan_id){
	$data = $this->db->query("SELECT * FROM tbl_loans l JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.loan_id = '$loan_id'");
	return $data->row();
}

 public function get_Desc_balance($loan_id)
{
	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
	return $data->row();
}

public function check_loan_pending($loan_id)
{
	$data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_id'");
	return $data->row();
}


public function get_total_pending_loan($loan_ID){
 $data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_ID'");
 return $data->row();
}

public function get_outstand_total($loan_ID){
	$data = $this->db->query("SELECT * FROM  tbl_outstand_loan WHERE loan_id = '$loan_ID'");
	return $data->row();
}

public function get_loan_option($loan_ID){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE loan_id = '$loan_ID'");
	return $data->row();
}



public function get_total_loan_pending($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_pending_total pt JOIN tbl_loans l ON l.loan_id = pt.loan_id JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id JOIN tbl_customer c ON c.customer_id = pt.customer_id  WHERE pt.blanch_id = '$blanch_id' AND total_pend IS NOT FALSE ");
	return $data->result();
}

public function get_total_loan_pending_officer($blanch_id, $empl_id) {
    $query = $this->db->query("
        SELECT * 
        FROM tbl_pending_total pt
        JOIN tbl_loans l ON l.loan_id = pt.loan_id
        JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id
        JOIN tbl_customer c ON c.customer_id = pt.customer_id
        WHERE pt.blanch_id = ? 
          AND c.empl_id = ? 
          AND pt.total_pend IS NOT FALSE
    ", array($blanch_id, $empl_id));

    return $query->result(); // Returns array of pending loans for that officer
}


public function get_total_loan_pending_by_officer($blanch_id, $empl_id){
    $data = $this->db->query("
        SELECT pt.*, l.*, b.*, c.* 
        FROM tbl_pending_total pt 
        JOIN tbl_loans l ON l.loan_id = pt.loan_id 
        JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id 
        JOIN tbl_customer c ON c.customer_id = pt.customer_id  
        WHERE pt.blanch_id = '$blanch_id' 
        AND pt.total_pend > 0
        AND l.empl_id = '$empl_id'
    ");
    return $data->result();
}


public function get_total_pend_loan($blanch_id){
	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM tbl_pending_total WHERE blanch_id = '$blanch_id'");
	return $data->row();
}


public function get_total_pend_officerloan($blanch_id, $empl_id) {
    $query = $this->db->query("
        SELECT SUM(pt.total_pend) AS total_pending 
        FROM tbl_pending_total pt
        JOIN tbl_customer c ON c.customer_id = pt.customer_id
        WHERE pt.blanch_id = ? AND c.empl_id = ?
    ", array($blanch_id, $empl_id));

    return $query->row();
}



public function get_total_loan_pendingComp($comp_id){
    $query = $this->db->query("
        SELECT * 
        FROM tbl_pending_total pt
        JOIN tbl_loans l ON l.loan_id = pt.loan_id
        JOIN tbl_blanch b ON b.blanch_id = pt.blanch_id
        JOIN tbl_customer c ON c.customer_id = pt.customer_id
        JOIN tbl_loan_category lc ON lc.category_id = l.category_id
        WHERE pt.comp_id = ?
        AND total_pend IS NOT FALSE
    ", [$comp_id]);

    return $query->result();
}



public function get_total_pend_loan_company($comp_id){
	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM tbl_pending_total WHERE comp_id = '$comp_id'");
	return $data->row();
}

public function get_cashbook($comp_id){
	$data = $this->db->query("SELECT SUM(blanch_capital) AS total_capital FROM tbl_blanch_account WHERE comp_id = '$comp_id'");
	return $data->row();
}


public function get_empl_data_loan($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_employee WHERE comp_id = '$comp_id'");
	return $data->result();
}

public function get_empl_data_loan_blanch($blanch_id){
	$data = $this->db->query("SELECT * FROM tbl_employee WHERE blanch_id = '$blanch_id'");
	return $data->result();
}

public function get_loan_empl_data($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_received,SUM(withdraw) AS total_withdrawal,c.f_name,c.m_name,c.l_name,l.restration,c.phone_no,l.day,pr.prev_id,pr.trans_id,at.account_name AS depost_account,pr.with_trans,wa.account_name AS with_account FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id LEFT JOIN tbl_account_transaction wa ON wa.trans_id = pr.with_trans WHERE pr.empl_id = '$empl_id' AND pr.group_id = '0' AND pr.lecod_day = '$today' GROUP BY pr.prev_id ");
	return $data->result();
}

public function get_total_depost_individual($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_individual ,SUM(withdraw) AS total_withdrawal_individual FROM tbl_prev_lecod WHERE empl_id = '$empl_id' AND lecod_day = '$today' AND group_id = '0' GROUP BY empl_id");
	return $data->result();
}

public function get_empl_group_depost($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_group g ON g.group_id = pr.group_id WHERE pr.empl_id = '$empl_id' AND pr.lecod_day = '$today' GROUP BY pr.group_id");
	return $data->result();
}


public function member_group($group_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_received,SUM(withdraw) AS total_withdrawal,c.f_name,c.m_name,c.l_name,l.restration,c.phone_no,l.day,pr.prev_id,pr.trans_id,at.account_name AS depost_account,pr.with_trans,wa.account_name AS with_account FROM tbl_prev_lecod pr JOIN tbl_loans l ON l.loan_id = pr.loan_id JOIN tbl_customer c ON c.customer_id = pr.customer_id LEFT JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id LEFT JOIN tbl_account_transaction wa ON wa.trans_id = pr.with_trans WHERE pr.group_id = '$group_id'  AND pr.lecod_day = '$today' GROUP BY pr.prev_id ");
	return $data->result();
}


public function get_total_group_depost($group_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_group,SUM(withdraw) AS total_withdrawal_group FROM tbl_prev_lecod WHERE group_id = '$group_id' AND lecod_day = '$today'");
	return $data->result();
}


public function get_total_empl_depost_data($empl_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_oficer,SUM(withdraw) AS total_withdrawal_oficer FROM tbl_prev_lecod WHERE empl_id = '$empl_id' AND lecod_day = '$today'");
	return $data->result();
}


public function get_total_deposit($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_deposit_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_withdrawal($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(withdraw) AS total_withdrawal_comp FROM tbl_prev_lecod WHERE comp_id = '$comp_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_total_withdrawal_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(withdraw) AS total_withdrawal_comp FROM tbl_prev_lecod WHERE blanch_id = '$blanch_id' AND lecod_day = '$date'");
	return $data->row();
}

public function get_totalaccount_transaction($comp_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_depost_account,at.account_name, count(depost) AS recept FROM tbl_prev_lecod pr JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id  WHERE pr.comp_id = '$comp_id' AND pr.lecod_day = '$date' AND pr.trans_id IS NOT NULL GROUP BY pr.trans_id");
	return $data->result();
}

public function get_totalaccount_transaction_blanch($blanch_id){
	$date = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(pr.depost) AS total_depost_account,at.account_name, count(depost) AS recept FROM tbl_prev_lecod pr JOIN tbl_account_transaction at ON at.trans_id = pr.trans_id  WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$date' AND pr.trans_id IS NOT NULL GROUP BY pr.trans_id");
	return $data->result();
}


public function get_teller_deposit_with($comp_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id WHERE pr.comp_id = '$comp_id' AND pr.lecod_day = '$today' GROUP BY pr.blanch_id");
	return $data->result();
}

public function get_eploye_deposit($blanch_id){
	$today = date("Y-m-d");
	$data = $this->db->query("SELECT SUM(depost) AS total_depost_teller,SUM(withdraw) AS total_withdrawal_teller,e.empl_name,pr.lecod_day FROM tbl_prev_lecod pr JOIN tbl_employee e ON e.empl_id = pr.empl_id WHERE pr.blanch_id = '$blanch_id' AND pr.lecod_day = '$today' GROUP BY pr.empl_id");
	return $data->result();
}


  public function get_today_loan_withdrawal($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,l.blanch_id  FROM tbl_loans l WHERE l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$date' GROUP BY l.blanch_id");

  	return $data = $data->row();
  }

  public function get_today_loan_withdrawal_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_with,l.blanch_id  FROM tbl_loans l WHERE l.disburse_day between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'  GROUP BY l.blanch_id");

  	return $data = $data->row();
  }

   public function get_today_loan_withdrawalComp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_withcomp  FROM tbl_loans l WHERE l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal' AND l.disburse_day = '$date'");

  	return $data = $data->row();
  }


   public function get_today_loan_withdrawalComp_prev($comp_id,$from,$to){
  	$data = $this->db->query("SELECT SUM(l.loan_aprove) AS total_loan_withcomp  FROM tbl_loans l WHERE l.disburse_day between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");

  	return $data = $data->row();
  }

  public function get_total_depost_blanch($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE blanch_id = '$blanch_id' AND depost_day = '$date'");
  	return $data->row();
  }


  public function get_total_depost_blanch_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost FROM tbl_depost WHERE depost_day  between '$from' and '$to' AND blanch_id = '$blanch_id'");
  	return $data->row();
  }

  public function get_total_depost_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_depost WHERE comp_id = '$comp_id' AND depost_day = '$date'");
  	return $data->row();
  }

   public function get_total_depost_comp_prev($comp_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost_comp FROM tbl_depost WHERE depost_day between '$from' and '$to' AND comp_id = '$comp_id'");
  	return $data->row();
  }

  public function get_total_deducted_fee_today($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balance FROM tbl_deducted_fee WHERE blanch_id = '$blanch_id'  AND deducted_date = '$date'");
  	return $data->row();
  }


  public function get_total_deducted_fee_today_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balance FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND blanch_id = '$blanch_id'");
  	return $data->row();
  }

   public function get_total_deducted_fee_todaycomp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balancecomp FROM tbl_deducted_fee WHERE comp_id = '$comp_id'  AND deducted_date = '$date'");
  	return $data->row();
  }

  public function get_total_deducted_fee_todaycomp_prev($comp_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(deducted_balance) AS total_deducted_balancecomp FROM tbl_deducted_fee WHERE deducted_date between '$from' and '$to' AND comp_id = '$comp_id'");
  	return $data->row();
  }

  public function get_total_receive_nonDeducted($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted FROM tbl_receve WHERE blanch_id = '$blanch_id' AND receve_day = '$date'");
  	return $data->row();
  }

   public function get_total_receive_nonDeducted_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted FROM tbl_receve WHERE receve_day between '$from' and '$to' AND blanch_id = '$blanch_id'");
  	return $data->row();
  }

  public function get_total_receive_nonDeducted_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted_comp FROM tbl_receve WHERE comp_id = '$comp_id' AND receve_day = '$date'");
  	return $data->row();
  }


  public function get_total_receive_nonDeducted_comp_prev($comp_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(receve_amount) AS total_receive_nondeducted_comp FROM tbl_receve WHERE receve_day between '$from' and '$to' AND comp_id = '$comp_id'");
  	return $data->row();
  }

  public function get_expenses_total_comp($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM tbl_request_exp WHERE blanch_id = '$blanch_id' AND date(created) = '$date'");
  	return $data->row();
  }

  public function get_expenses_total_comp_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses FROM tbl_request_exp WHERE date(created) between '$from' and '$to' AND blanch_id = '$blanch_id'");
  	return $data->row();
  }

  public function get_expenses_total_compblanch($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses_comp FROM tbl_request_exp WHERE comp_id = '$comp_id' AND date(created) = '$date'");
  	return $data->row();
  }


  public function get_expenses_total_compblanch_prev($comp_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(req_amount) AS total_expenses_comp FROM tbl_request_exp WHERE date(created) between '$from' and '$to' AND comp_id = '$comp_id'");
  	return $data->row();
  }


  public function get_newcustomer($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT COUNT(customer_id) AS total_customer FROM tbl_customer WHERE blanch_id = '$blanch_id' AND date(customer_day) = '$date' ");
  	return $data->row();
  }


  public function get_today_receivable_blanch($blanch_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration FROM tbl_loans WHERE blanch_id = '$blanch_id' AND date_show = '$date' AND loan_status = 'withdrawal'");
  	return $data->row();
  }

  public function get_today_receivable_blanch_prev($blanch_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration FROM tbl_loans WHERE date_show between '$from' and '$to' AND blanch_id = '$blanch_id'AND loan_status = 'withdrawal'");
  	return $data->row();
  }

   public function get_today_receivable_comp($comp_id){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration_comp FROM tbl_loans WHERE comp_id = '$comp_id' AND date_show = '$date' AND loan_status = 'withdrawal'");
  	return $data->row();
  }


   public function get_today_receivable_comp_prev($comp_id,$from,$to){
  	$date = date("Y-m-d");
  	$data = $this->db->query("SELECT SUM(restration) AS total_restoration_comp FROM tbl_loans WHERE date_show between '$from' and '$to' AND comp_id = '$comp_id'  AND loan_status = 'withdrawal'");
  	return $data->row();
  }

  public function insert_loan_topup($data){
  	return $this->db->insert('tbl_topup',$data);
  }


  public function get_group_loan_data($group_id,$comp_id){
  	$data = $this->db->query("SELECT SUM(depost) AS total_depost,SUM(withdrow) AS total_withdrawal,SUM(balance) AS total_balance,date_data  FROM tbl_pay WHERE group_id = '$group_id'  GROUP BY pay_status ORDER BY pay_id DESC");
  	return $data->result();
  }

  public function get_loanEmployee_blanch_loan($blanch_id){
  	$data = $this->db->query("SELECT SUM(l.loan_int) AS total_loan, e.empl_name,e.empl_id  FROM tbl_loans l LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.blanch_id = '$blanch_id' GROUP BY l.empl_id");
  	foreach ($data->result() as $r) {
  	 $r->total_depost_loan = $this->get_deposit_inloancategory($r->empl_id);	
  	}
  	return $data->result();
  }


 
  public function get_deposit_inloancategory($empl_id){
		$deposit = $this->db->query("SELECT SUM(d.depost) AS total_depost_loan FROM tbl_depost d WHERE d.empl_id = '$empl_id' GROUP BY d.empl_id");
		if ($deposit->row()) {
			return $deposit->row()->total_depost_loan; 
		}
		return 0; 
		 }

		 public function get_total_blanch_loan($blanch_id){
		 	$data = $this->db->query("SELECT SUM(loan_int) AS total_blanch_loan,blanch_id FROM tbl_loans WHERE blanch_id = '$blanch_id'");
		 	foreach ($data->result() as $r) {
		 		$r->total_received = $this->get_total_received_blanch($r->blanch_id);
		 	}
		 	return $data->result();
		 }

		 public function get_total_received_blanch($blanch_id){
     $deposit = $this->db->query("SELECT SUM(depost) AS total_received FROM tbl_depost WHERE blanch_id = '$blanch_id'");

     if ($deposit->row()) {
       return $deposit->row()->total_received;
     }
     return 0;
		 }


public function fetch_employee($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->get('tbl_employee');
  $output = '<option value="">Select Employee</option>';
 
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->empl_id.'">'.$row->empl_name.'  </option>';
  }
  return $output;
 }

 public function fetch_employee_data($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->get('tbl_employee');
   $output = '<option value="">Select Employee</option>';
   $output .= '<option value="all">ALL</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->empl_id.'">'.$row->empl_name.'  </option>';
  }
  return $output;
 }


  public function fetch_employee_data_deposit($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->get('tbl_employee');
   $output = '<option value="">Select Employee</option>';
   $output .= '<option value="all">ALL</option>';
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->empl_id.'">'.$row->empl_name.'  </option>';
  }
  return $output;
 }


 public function fetch_acount($blanch_id)
 {
  $this->db->where('blanch_id', $blanch_id);
  $this->db->order_by('empl_id', 'ASC');
  $query = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id  WHERE ba.blanch_id = '$blanch_id'");
  $output = '<option value="">Select Account</option>';
  
  foreach($query->result() as $row)
  {
   $output .= '<option value="'.$row->receive_trans_id.'">'.$row->account_name.'  </option>';
  }
  return $output;
 }

 public function get_blanch_balance_expenses($blanch_id,$trans_id){
 $data = $this->db->query("SELECT * FROM tbl_blanch_account ba WHERE ba.blanch_id = '$blanch_id' AND ba.receive_trans_id = '$trans_id'");
 return $data->row();
 }


 public function get_expenses_reject($req_id){
 	$data = $this->db->query("SELECT * FROM tbl_request_exp WHERE req_id = '$req_id'");
 	return $data->row();
 }


 public function get_loan_withdrawal_category($comp_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l  LEFT JOIN tbl_blanch b ON b.blanch_id = l.blanch_id WHERE l.comp_id = '$comp_id' GROUP BY l.blanch_id");
 	return $data->result();
 }

 public function get_loan_product_coompany($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_loan_category lc ON lc.category_id = l.category_id WHERE l.blanch_id = '$blanch_id' GROUP BY l.category_id");
 	return $data->result();
 }


 public function get_loanfee_category_blanch($category_id,$blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id LEFT JOIN tbl_account_transaction ac ON ac.trans_id = l.method LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id WHERE l.category_id = '$category_id' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
 	return $data->result();
 }


 public function get_total_category_loan_with($category_id,$blanch_id){
 	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loanAprove,SUM(loan_int) AS total_interest FROM tbl_loans WHERE category_id = '$category_id' AND blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
 	return $data->result();
 }

 public function get_total_blanch_loanWith($blanch_id){
 	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_blanch_Aprove,SUM(loan_int) AS total_blanch_int FROM tbl_loans WHERE blanch_id = '$blanch_id' AND loan_status = 'withdrawal'");
 	return $data->result();
 }

 public function get_total_loancompany_with($comp_id){
 	$data = $this->db->query("SELECT SUM(loan_aprove) AS total_loan_aprove_comp,SUM(loan_int) AS total_int_comp FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
 	return $data->row();
 }


 public function get_employee_blanch($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_employee WHERE blanch_id = '$blanch_id'");
 	return $data->result();
 }


 public function get_blanch_account_data($blanch_id){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account ba JOIN tbl_account_transaction at ON at.trans_id = ba.receive_trans_id WHERE ba.blanch_id = '$blanch_id'");
 	return $data->result();
 }

 public function get_remain_balance_inpay($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
 	return $data->row();
 }

 public function get_borrowe_alert($customer_id){
 	$data = $this->db->query("SELECT COUNT(customer_id) AS total_loan FROM tbl_loans WHERE customer_id = '$customer_id'");
 	return $data->row();
 }



  public function get_loan_collection_customer($customer_id){
 	$loan_data = $this->db->query("SELECT pn.penart_paid,SUM(d.depost) AS total_depost,c.f_name,c.m_name,c.l_name,b.blanch_name,l.loan_id,l.loan_int,l.restration,l.loan_status,ot.loan_end_date,l.loan_aprove,e.username,e.empl_name,ot.loan_stat_date,l.session,l.day,at.oficer,at.phone_oficer,at.region_oficer,at.district_oficer,at.ward_oficer,at.street_oficer,at.oficer_position,r.region_name,at.attach_id,at.cont_attachment,c.customer_id  FROM tbl_loans l 
	 LEFT JOIN tbl_pay_penart pn ON pn.loan_id = l.loan_id  
	 LEFT JOIN tbl_depost d ON d.loan_id = l.loan_id 
	 JOIN tbl_customer c ON c.customer_id = l.customer_id 
	 JOIN tbl_blanch b ON b.blanch_id = l.blanch_id 
	 LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id 
	 LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id 
	 LEFT JOIN tbl_attachment at ON at.loan_id = l.loan_id
	 LEFT JOIN tbl_region r ON r.region_id = at.region_oficer  
	 WHERE  l.customer_id = '$customer_id' GROUP BY l.loan_id");
 	foreach($loan_data->result() as $r){
 		$r->total_penart_amount = $this->get_total_penartData($r->loan_id);
 	}

 	return $loan_data->result();
 }
 public function update_profile_data($customer_id, $blanch_id, $f_name, $m_name, $l_name, $phone_no, $empl_id)
 {
	 $this->db->trans_start();
 
	 // Update tbl_customer
	 $this->db->where('customer_id', $customer_id);
	 $this->db->update('tbl_customer', [
		 'blanch_id' => $blanch_id,
		 'f_name'    => $f_name,
		 'm_name'    => $m_name,
		 'l_name'    => $l_name,
		 'phone_no'  => $phone_no,
		 'empl_id'   => $empl_id
	 ]);
 
	 // Update tbl_loans
	 $this->db->where('customer_id', $customer_id);
	 $this->db->update('tbl_loans', [
		 'blanch_id' => $blanch_id,
		 'empl_id'   => $empl_id
	 ]);
 
	 // Update tbl_depost
	 $this->db->where('customer_id', $customer_id);
	 $this->db->update('tbl_depost', [
		 'blanch_id' => $blanch_id,
		 'empl_id'   => $empl_id
	 ]);
 
	 // ✅ Get loan_ids to update tbl_outstand and tbl_outstand_loan
	 $this->db->select('loan_id');
	 $this->db->where('customer_id', $customer_id);
	 $loan_ids_result = $this->db->get('tbl_loans')->result();
 
	 if (!empty($loan_ids_result)) {
		 $loan_ids = array_column($loan_ids_result, 'loan_id');
 
		 // ✅ Update tbl_outstand
		 $this->db->where_in('loan_id', $loan_ids);
		 $this->db->update('tbl_outstand', [
			 'blanch_id' => $blanch_id
		 ]);
 
		 // ✅ Update tbl_outstand_loan
		 $this->db->where_in('loan_id', $loan_ids);
		 $this->db->update('tbl_outstand_loan', [
			 'blanch_id' => $blanch_id
		 ]);
	 }
 
	 // Update tbl_prev_lecod
	 $this->db->where('customer_id', $customer_id);
	 $this->db->update('tbl_prev_lecod', [
		 'blanch_id' => $blanch_id,
		 'empl_id'   => $empl_id
	 ]);
 
	 // Update tbl_customer_report
	 $this->db->where('customer_id', $customer_id);
	 $this->db->update('tbl_customer_report', [
		 'blanch_id' => $blanch_id
	 ]);
 
	 $this->db->trans_complete();
	 return $this->db->trans_status();
 }
 
 
 
 

 public function update_customer_profile_data($customer_id,$data){
 	return $this->db->where('customer_id',$customer_id)->update('tbl_customer',$data);
 }

 

 public function get_nextreceivable($comp_id){
	$data = $this->db->query("SELECT * FROM tbl_loans WHERE comp_id = '$comp_id' AND loan_status = 'withdrawal'");
	return $data->result();
}

public function get_remain_amount($loan_id) {
	// Query to join tbl_depost and tbl_loans and calculate remain_amount
	$this->db->select('tbl_loans.loan_int - IFNULL(SUM(tbl_depost.depost), 0) as remain_amount');
	$this->db->from('tbl_depost');
	$this->db->join('tbl_loans', 'tbl_depost.loan_id = tbl_loans.loan_id', 'inner');
	$this->db->where('tbl_depost.loan_id', $loan_id);
	
	// Execute the query
	$query = $this->db->get();
	
	// Check if the query returned a result
	if ($query->num_rows() > 0) {
		return $query->row()->remain_amount;
	} else {
		return null;  // or return a default value (e.g., 0)
	}
}

		public function get_loan_active_customer($customer_id){
     	$data = $this->db->query("SELECT l.loan_id,l.loan_int,l.restration,l.customer_id,ot.loan_stat_date,ot.loan_end_date,l.loan_status FROM tbl_loans l LEFT JOIN tbl_outstand ot ON ot.loan_id = l.loan_id  WHERE l.customer_id = '$customer_id' ORDER BY l.loan_id DESC");
     	return $data->row();
     }


	 
     public function get_total_amount_paid_loan($loan_id){
     	$data = $this->db->query("SELECT SUM(depost) AS total_Deposit FROM tbl_depost WHERE loan_id = '$loan_id'");
     	return $data->row();
     }


     public function get_outstand_loan_customer($loan_id){
 	$data = $this->db->query("SELECT SUM(remain_amount) AS total_out FROM tbl_outstand_loan WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_grouped_payments_by_company($comp_id = null, $from = null, $to = null, $representative = null)
 {
	 $this->db->select('
		 p.comp_id,
		 e.empl_id,
		 e.empl_name,
		 p.emply AS representative,
		 c.customer_id,
		 CONCAT_WS(" ", c.f_name, c.m_name, c.l_name) AS customer_name,
		 p.depost,
		 p.wakala_name AS wakala,
		 t.account_name AS payment_method_name
	 ');
	 $this->db->from('tbl_pay p');
	 $this->db->join('tbl_customer c', 'p.customer_id = c.customer_id', 'left');
	 $this->db->join('tbl_employee e', 'c.empl_id = e.empl_id', 'left');
	 $this->db->join('tbl_account_transaction t', 'p.p_method = t.trans_id', 'left');
 
	 if ($comp_id !== null) {
		 $this->db->where('p.comp_id', $comp_id);
	 }
 
	 if (!empty($from) && !empty($to)) {
		 $this->db->where('DATE(p.date_data) >=', $from);
		 $this->db->where('DATE(p.date_data) <=', $to);
	 }
 
	 if (!empty($representative)) {
		 $this->db->where('p.emply', $representative); // <-- filter by representative
	 }
 
	 $this->db->where('p.emply !=', 'SYSTEM WITHDRAWAL');
	 $this->db->where('p.depost !=', 0);
	 $this->db->where('t.account_name IS NOT NULL', null, false);
	 $this->db->where('p.depost IS NOT NULL', null, false);
	 $this->db->order_by('e.empl_name, t.account_name, p.emply');
 
	 $query = $this->db->get();
	 $result = $query->result();
 
	 // ---- Grouping logic stays unchanged ----
	 $grouped = [];
	 foreach ($result as $row) {
		 $empl_name = $row->empl_name ?? 'Unknown Employee';
		 $method = $row->payment_method_name ?? 'Unknown Method';
		 $rep = $row->representative ?? 'Unknown Representative';
 
		 if (!isset($grouped[$empl_name])) {
			 $grouped[$empl_name] = [
				 'empl_id' => $row->empl_id,
				 'empl_name' => $empl_name,
				 'comp_id' => $row->comp_id,
				 'payment_methods' => []
			 ];
		 }
 
		 if (!isset($grouped[$empl_name]['payment_methods'][$method])) {
			 $grouped[$empl_name]['payment_methods'][$method] = [];
		 }
 
		 if (!isset($grouped[$empl_name]['payment_methods'][$method][$rep])) {
			 $grouped[$empl_name]['payment_methods'][$method][$rep] = [];
		 }
 
		 $grouped[$empl_name]['payment_methods'][$method][$rep][] = [
			 'customer_id'    => $row->customer_id,
			 'customer_name'  => $row->customer_name,
			 'deposit'        => $row->depost,
			 'wakala'         => $row->wakala
		 ];
	 }
 
	 // ---- Format grouped result ----
	 $final_output = [];
	 foreach ($grouped as $empl_data) {
		 $methods = [];
		 foreach ($empl_data['payment_methods'] as $method_name => $reps) {
			 $representatives = [];
			 foreach ($reps as $rep_name => $customers) {
				 $representatives[] = [
					 'representative' => $rep_name,
					 'customers' => $customers
				 ];
			 }
			 $methods[] = [
				 'method' => $method_name,
				 'representatives' => $representatives
			 ];
		 }
 
		 $final_output[] = [
			 'empl_id' => $empl_data['empl_id'],
			 'empl_name' => $empl_data['empl_name'],
			 'comp_id' => $empl_data['comp_id'],
			 'payment_methods' => $methods
		 ];
	 }
 
	 return $final_output;
 }
 
 
 
 


 public function get_total_pay_description($loan_id){
     $data = $this->db->query("SELECT * FROM tbl_pay p LEFT JOIN tbl_loans l ON l.loan_id = p.loan_id LEFT JOIN tbl_account_transaction at ON at.trans_id = p.p_method WHERE p.loan_id = '$loan_id' ORDER BY p.pay_id DESC LIMIT 5");
     return $data->result();
     }


      public function get_total_remain_with($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
 	return $data->row();
 }

  public function get_total_loan_pend($loan_id){
 	$data = $this->db->query("SELECT SUM(total_pend) AS total_pending FROM  tbl_pending_total WHERE loan_id = '$loan_id'");
 	return $data->row();
 }


 public function get_total_penart_loan($loan_id){
 	$data = $this->db->query("SELECT SUM(penart_amount) AS total_penart FROM tbl_customer_report WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

  public function get_total_paypenart($loan_id){
 	$data = $this->db->query("SELECT SUM(penart_paid) AS total_penart_paid FROM tbl_pay_penart WHERE loan_id = '$loan_id'");
 	return $data->row();
 }


  public function get_end_deposit_time($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' ORDER BY dep_id DESC");
 	return $data->row();
 }

public function get_expected_receivable($from,$to,$blanch_id){
$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE  l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
return $data->result();
}

public function get_expected_receivable_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT * FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
return $data->result();
}

public function get_expected_receivable_sum($from,$to,$blanch_id){
$data = $this->db->query("SELECT SUM(l.restration) AS total_expectation FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.blanch_id = '$blanch_id' AND l.loan_status = 'withdrawal'");
return $data->row();
}

public function get_expected_receivable_sum_comp($from,$to,$comp_id){
$data = $this->db->query("SELECT SUM(l.restration) AS total_expectation FROM tbl_loans l LEFT JOIN tbl_customer c ON c.customer_id = l.customer_id JOIN tbl_blanch b ON b.blanch_id = l.blanch_id LEFT JOIN tbl_employee e ON e.empl_id = l.empl_id WHERE l.date_show between '$from' and '$to' AND l.comp_id = '$comp_id' AND l.loan_status = 'withdrawal'");
return $data->row();
}


//penart by General
       public function get_penart_general_loan($comp_id){
       	$data = $this->db->query("SELECT * FROM tbl_penart_value WHERE comp_id = '$comp_id' AND category_id IS NOT TRUE");
       	return $data->row();
       }

       //penart by Loan product
       public function get_penart_byloan_product($comp_id,$category_id){
       	$data = $this->db->query("SELECT * FROM tbl_penart_value WHERE comp_id = '$comp_id' AND category_id = '$category_id'");
       	return $data->row();
       }

       public function get_penart_category_comp($comp_id){
       	$data = $this->db->query("SELECT * FROM  tbl_penart_category WHERE comp_id = '$comp_id'");
       	return $data->row();
       }



       public function get_all_customer_comp(){
       	$comp_id = '106';
       	$data = $this->db->query("SELECT * FROM tbl_customer WHERE comp_id = '$comp_id'");
       	return $data->result();
       }


       public function update_comp_customer($comp_id,$data){
       	return $this->db->where('comp_id',$comp_id)->update('tbl_customer',$data);
       }



	   public function get_today_deposit_true($loan_id) {
		$date = date("Y-m-d");
		$data = $this->db->query("SELECT * FROM tbl_depost WHERE loan_id = '$loan_id' AND depost_day = '$date'");
		$result = $data->row();
	
		return $result ? $result : 0;
	}
	

	 
	public function has_permission($empl_id, $url, $action) {
        $this->db->where(['url' => $url, 'action' => $action]);
        $this->db->join('employee_links', 'system_links.id = employee_links.link_id');
        $this->db->where('employee_links.empl_id', $empl_id);
        return $this->db->count_all_results('system_links') > 0;
    }
	
	public function get_all_links() {
		return $this->db->order_by('group_name')->order_by('link_name')->get('system_links')->result();
	}
	
	public function insert_permission($data)
{
    return $this->db->insert('tbl_permission', $data);
}




public function get_employee_by_id($empl_id) {
    return $this->db->get_where('tbl_employee', ['empl_id' => $empl_id])->row();
}



// public function get_todaexpected_collections($comp_id)
// {
//     $today = date('Y-m-d');

//     $this->db->select("
//         l.loan_id,
//         l.customer_id,
//         l.how_loan AS loan_amount,
//         l.restration,
//         l.date_show AS expected_date,
//         COALESCE(p.depost, 0) AS depost,
//         COALESCE(p.date_data, NULL) AS payment_date
//     ");
    
//     $this->db->from('tbl_loans l');
    
//     $this->db->join('tbl_pay p', 'l.loan_id = p.loan_id AND l.date_show = p.date_data', 'left');

//     $this->db->where('l.date_show', $today);
//    

//     $query = $this->db->get();
//     return $query->result();
// }

// public function get_today_expected_collections($comp_id)
// {
//     $today = date('Y-m-d');

//     $this->db->select("
//         l.loan_id,
//         l.customer_id,
//         l.how_loan AS loan_amount,
//         l.restration,
//         l.date_show AS expected_date,
//         COALESCE(p.description, 0) AS amount_paid,
//         COALESCE(p.depost, 0) AS depost,
//         COALESCE(p.date_data, NULL) AS payment_date
//     ");

//     $this->db->from('tbl_loans l');

//     // LEFT JOIN so that loans still appear even if no payment has been made
//     $this->db->join('tbl_pay p', 'l.loan_id = p.loan_id AND p.date_data = l.date_show', 'left');

//     // Filter by today's expected collection date
//     $this->db->where('l.date_show', $today);

//     // Filter by company
//    

//     $query = $this->db->get();
//     return $query->result();
// }


public function get_customers_pending_payment()
{
    $today = date('Y-m-d');

    $this->db->select("
        l.loan_id,
        l.customer_id,
        l.loan_status,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        b.blanch_name,
        e.empl_name AS officer_name,
        cat.loan_name,
        l.loan_int AS loan_amount,
        o.loan_stat_date,
        o.loan_end_date,
        COALESCE(p.rem_debt, 0) AS rem_debt,
        p.latest_pay_id
    ");
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');

    // Join tbl_pay to get latest rem_debt and balance
    $this->db->join("(SELECT p1.loan_id, p1.rem_debt, p1.balance, p1.pay_id AS latest_pay_id
                      FROM tbl_pay p1
                      INNER JOIN (
                          SELECT loan_id, MAX(pay_id) AS latest_pay_id
                          FROM tbl_pay
                          WHERE description = 'CASH DEPOSIT'
                          GROUP BY loan_id
                      ) p2 ON p1.loan_id = p2.loan_id AND p1.pay_id = p2.latest_pay_id
                      WHERE p1.description = 'CASH DEPOSIT'
                     ) p", 
                     "l.loan_id = p.loan_id", 
                     "left");

    // Only withdrawal or out loans
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);

    // Exclude those who have paid today
    $this->db->where("l.loan_id NOT IN (
        SELECT loan_id
        FROM tbl_pay
        WHERE description = 'CASH DEPOSIT'
        AND DATE(pay_day) = '{$today}'
        AND depost > 0
    )", null, false);

    // Exclude loans disbursed today
    $this->db->where("DATE(l.disburse_day) !=", $today);

    // ✅ Exclude customers with prepaid balance (balance > 0)
    $this->db->where("(p.balance IS NULL OR p.balance <= 0)");

    $this->db->group_by('l.customer_id');

    // Ordering by latest payment first
    $this->db->order_by('p.latest_pay_id', 'DESC');
    $this->db->order_by('c.f_name', 'ASC');

    return $this->db->get()->result();
}




public function no_deposit_customers_today($comp_id)
{
    $today = date('Y-m-d');

    $this->db->select("
        l.loan_id,
        l.customer_id,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        b.blanch_name,
        e.empl_name AS officer_name,
        cat.loan_name,
        l.loan_int AS loan_amount,
        o.loan_stat_date,
        o.loan_end_date
    ");
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');

    // Only active/ongoing loans
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->where('l.comp_id', $comp_id);

    // Exclude customers who have deposited today
    $this->db->where("l.loan_id NOT IN (
        SELECT loan_id
        FROM tbl_pay
        WHERE description = 'CASH DEPOSIT'
        AND DATE(pay_day) = '{$today}'
        AND depost > 0
    )", null, false);

    $this->db->group_by('l.customer_id');
    $this->db->order_by('c.f_name', 'ASC');

    return $this->db->get()->result();
}


public function depost_balance($loan_id,$comp_id,$blanch_id,$customer_id,$new_depost,$sum_balance,$description,$role,$p_method,$group_id,$deposit_date,$dep_id,$wakala,$baki){
    $day = date("Y-m-d H:i:s");
    $this->db->query("INSERT INTO tbl_pay (`loan_id`,`blanch_id`,`comp_id`,`customer_id`,`depost`,`balance`,`description`,`pay_status`,`stat`,`date_pay`,`emply`,`p_method`,`group_id`,`date_data`,`dep_id`,`wakala`,`rem_debt`) 
    VALUES ('$loan_id','$blanch_id','$comp_id','$customer_id','$new_depost','$sum_balance','$description','1','1','$day','$role','$p_method','$group_id','$deposit_date','$dep_id','$wakala','$baki')");
    return $this->db->insert_id();
}


    public function get_active_loans_with_status() {
        $this->db->where_in('loan_status', ['withdrawal', 'out']);
        $query = $this->db->get('tbl_loans'); // replace with your actual loan table
        return $query->result();
    }


	public function get_no_deposit_customers_today($comp_id)
{
    $today = date('Y-m-d');

    // Subquery: all customers expected to pay (loan_status = withdrawal/out)
    $this->db->select('l.loan_id, l.customer_id');
    $this->db->from('tbl_loans l');
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->where('l.comp_id', $comp_id);
    $expected_loans = $this->db->get_compiled_select();

    // Main query: get all expected customers who DID NOT make a deposit today
    $this->db->select("
        l.loan_id,
        l.customer_id,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        b.blanch_name,
        e.empl_name AS officer_name,
        cat.loan_name,
        l.how_loan AS loan_amount,
        o.loan_stat_date,
        o.loan_end_date
    ");
    $this->db->from("($expected_loans) l");
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');

    // Exclude loans that made a deposit today
    $this->db->where("l.loan_id NOT IN (
        SELECT p.loan_id
        FROM tbl_pay p
        WHERE p.description = 'CASH DEPOSIT'
        AND DATE(p.pay_day) = '{$today}'
        AND p.depost > 0
    )", null, false);

    $this->db->group_by('l.customer_id');
    $this->db->order_by('c.f_name', 'ASC');

    return $this->db->get()->result();
}


public function get_expected_collections($comp_id)
{
    $today = date('Y-m-d'); // current date

    // Get detailed loan and payment info with one row per loan
    $this->db->select("
        l.loan_id,
        l.loan_status,
        l.customer_id,
        l.day,
        l.session,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        e.empl_name AS empl_name,
        l.how_loan AS loan_amount,
        l.restration,
        COALESCE(p.depost, 0) AS depost,
        COALESCE(p.rem_debt, 0) AS rem_debt,
        COALESCE(d.empl_username, '') AS depositor_username,
        cat.loan_name,
        o.loan_stat_date,
        o.loan_end_date,
        b.blanch_name
    ");
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');

    // Subquery to get latest deposit and rem_debt from tbl_pay
    $this->db->join(
        "(SELECT p1.loan_id, p1.depost, p1.rem_debt, p1.pay_day
          FROM tbl_pay p1
          INNER JOIN (
              SELECT loan_id, MAX(pay_day) AS latest_pay
              FROM tbl_pay
              WHERE description = 'CASH DEPOSIT'
              GROUP BY loan_id
          ) p2 ON p1.loan_id = p2.loan_id AND p1.pay_day = p2.latest_pay
          WHERE p1.description = 'CASH DEPOSIT'
        ) p",
        "l.loan_id = p.loan_id",
        'left'
    );

    // Subquery to get last depositor username per loan
    $this->db->join(
        "(SELECT loan_id, MAX(empl_username) AS empl_username
          FROM tbl_depost
          GROUP BY loan_id) d",
        'l.loan_id = d.loan_id',
        'left'
    );

    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');

    // Filter loans: either status is 'withdrawal'/'out' OR there is a deposit today
    $this->db->group_start();
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->or_where('DATE(p.pay_day)', $today);
    $this->db->group_end();

    $this->db->where('l.comp_id', $comp_id);

    $details = $this->db->get()->result();

    // Total restration for withdrawal/out loans
    $this->db->select('SUM(restration) AS total_restration');
    $this->db->from('tbl_loans');
    $this->db->where_in('loan_status', ['withdrawal', 'out']);
    $this->db->where('comp_id', $comp_id);
    $sum_restration = $this->db->get()->row();

    // Total deposit and rem_debt (latest per loan)
    $this->db->select('SUM(p.depost) AS total_depost, SUM(p.rem_debt) AS total_rem_debt');
    $this->db->from('tbl_loans l');
    $this->db->join(
        "(SELECT p1.loan_id, p1.depost, p1.rem_debt, p1.pay_day
          FROM tbl_pay p1
          INNER JOIN (
              SELECT loan_id, MAX(pay_day) AS latest_pay
              FROM tbl_pay
              WHERE description = 'CASH DEPOSIT'
              GROUP BY loan_id
          ) p2 ON p1.loan_id = p2.loan_id AND p1.pay_day = p2.latest_pay
          WHERE p1.description = 'CASH DEPOSIT'
        ) p",
        "l.loan_id = p.loan_id",
        'inner'
    );
    $this->db->where('l.comp_id', $comp_id);
    $sum_depost = $this->db->get()->row();

    // Count of total customers expected to pay (status withdrawal/out)
    $this->db->select('COUNT(DISTINCT customer_id) AS total_customers');
    $this->db->from('tbl_loans');
    $this->db->where_in('loan_status', ['withdrawal', 'out']);
    $this->db->where('comp_id', $comp_id);
    $total_customers = $this->db->get()->row();

    // Count of customers who made a deposit today
    $this->db->select('COUNT(DISTINCT l.customer_id) AS deposited_customers');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_pay p', "l.loan_id = p.loan_id AND p.description = 'CASH DEPOSIT' AND DATE(p.pay_day) = '{$today}'", 'inner');
    $this->db->where('l.comp_id', $comp_id);
    $this->db->where('p.depost >', 0);
    $deposited_customers = $this->db->get()->row();

    $no_deposit_customers = ($total_customers->total_customers ?? 0) - ($deposited_customers->deposited_customers ?? 0);

    return [
        'details' => $details,
        'total_restration' => $sum_restration->total_restration ?? 0,
        'total_depost' => $sum_depost->total_depost ?? 0,
        'total_rem_debt' => $sum_depost->total_rem_debt ?? 0,
        'total_customers' => $total_customers->total_customers ?? 0,
        'deposited_customers' => $deposited_customers->deposited_customers ?? 0,
        'no_deposit_customers' => $no_deposit_customers
    ];
}




	public function get_cash_transaction_by_officer($empl_id) {
		$date = date("Y-m-d");
	
		$data = $this->db->query("
			SELECT * 
			FROM tbl_prev_lecod pr 
			JOIN tbl_customer c ON c.customer_id = pr.customer_id 
			JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  
			WHERE pr.empl_id = '$empl_id' 
			AND pr.lecod_day >= '$date' 
			ORDER BY pr.prev_id DESC
		");
	
		return $data->result();
	}

	public function get_cash_transaction_by_blanch($blanch_id) {
		$date = date("Y-m-d");
	
		$data = $this->db->query("
			SELECT * 
			FROM tbl_prev_lecod pr 
			JOIN tbl_customer c ON c.customer_id = pr.customer_id 
			JOIN tbl_blanch b ON b.blanch_id = pr.blanch_id  
			WHERE pr.blanch_id = '$blanch_id'
			AND pr.lecod_day >= '$date' 
			ORDER BY pr.prev_id DESC
		");
	
		return $data->result();
	}


public function managerexpected_collections($blanch_id)
{
    $today = date('Y-m-d');

    // Get detailed loan and payment info with latest deposit/rem_debt per loan
    $this->db->select("
        l.loan_id,
        l.loan_status,
        l.customer_id,
        l.day,
        l.session,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        c.customer_code,
        l.empl_id,
        l.how_loan AS loan_amount,
        l.restration,
        l.date_show AS expected_date,
        COALESCE(p.depost, 0) AS depost,
        COALESCE(p.rem_debt, 0) AS rem_debt,
        p.wakala,
        p.p_method,
        COALESCE(d.empl_username, '') AS depositor_username,
        cat.loan_name,
        o.loan_stat_date,
        o.loan_end_date,
        b.blanch_name,
        at.account_name
    ");
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');

    // Latest deposit + rem_debt + wakala + pay_method per loan
    $this->db->join("
        (
            SELECT t1.loan_id,
                   t1.depost,
                   t1.rem_debt,
                   t1.wakala,
                   t1.p_method,
                   t1.pay_day
            FROM tbl_pay t1
            INNER JOIN (
                SELECT loan_id, MAX(pay_day) AS latest_pay
                FROM tbl_pay
                WHERE description = 'CASH DEPOSIT'
                GROUP BY loan_id
            ) t2 ON t1.loan_id = t2.loan_id AND t1.pay_day = t2.latest_pay
            WHERE t1.description = 'CASH DEPOSIT'
        ) p", "l.loan_id = p.loan_id", 'left'
    );

    // Last depositor username per loan today
    $this->db->join("
        (
            SELECT loan_id, MAX(empl_username) AS empl_username
            FROM tbl_depost
            WHERE depost_day = '{$today}'
            GROUP BY loan_id
        ) d", 'l.loan_id = d.loan_id', 'left'
    );

    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');
    $this->db->join('tbl_account_transaction at', 'at.trans_id = p.p_method', 'left');

    // Filter: either status withdrawal/out OR done with a deposit today
    $this->db->group_start();
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->or_group_start();
    $this->db->where('l.loan_status', 'done');
    $this->db->where('DATE(p.pay_day)', $today);
    $this->db->group_end();
    $this->db->group_end();

    // Branch filter using l.blanch_id
    $this->db->where('l.blanch_id', $blanch_id);

    $details = $this->db->get()->result();

    // Total restration for branch (status withdrawal/out)
    $this->db->select('SUM(restration) AS total_restration');
    $this->db->from('tbl_loans l');
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->where('l.blanch_id', $blanch_id);
    $sum_restration = $this->db->get()->row();

    // Total deposit and rem_debt (latest per loan)
    $this->db->select('SUM(p.depost) AS total_depost, SUM(p.rem_debt) AS total_rem_debt');
    $this->db->from('tbl_loans l');
    $this->db->join(
        "(SELECT t1.loan_id, t1.depost, t1.rem_debt
          FROM tbl_pay t1
          INNER JOIN (
              SELECT loan_id, MAX(pay_day) AS latest_pay
              FROM tbl_pay
              WHERE description = 'CASH DEPOSIT'
              GROUP BY loan_id
          ) t2 ON t1.loan_id = t2.loan_id AND t1.pay_day = t2.latest_pay
          WHERE t1.description = 'CASH DEPOSIT'
        ) p",
        "l.loan_id = p.loan_id",
        'left'
    );
    $this->db->where('l.blanch_id', $blanch_id);
    $sum_depost = $this->db->get()->row();

    // Total expected customers (status withdrawal/out)
    $this->db->select('COUNT(DISTINCT l.customer_id) AS total_customers');
    $this->db->from('tbl_loans l');
    $this->db->where_in('l.loan_status', ['withdrawal', 'out']);
    $this->db->where('l.blanch_id', $blanch_id);
    $total_customers = $this->db->get()->row();

    // Customers who deposited today
    $this->db->select('COUNT(DISTINCT l.customer_id) AS deposited_customers');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_pay p', "l.loan_id = p.loan_id AND p.description = 'CASH DEPOSIT' AND DATE(p.pay_day) = '{$today}'", 'inner');
    $this->db->where('l.blanch_id', $blanch_id);
    $this->db->where('p.depost >', 0);
    $deposited_customers = $this->db->get()->row();

    $no_deposit_customers = ($total_customers->total_customers ?? 0) - ($deposited_customers->deposited_customers ?? 0);

    return [
        'details' => $details,
        'total_restration' => $sum_restration->total_restration ?? 0,
        'total_depost' => $sum_depost->total_depost ?? 0,
        'total_rem_debt' => $sum_depost->total_rem_debt ?? 0,
        'total_customers' => $total_customers->total_customers ?? 0,
        'deposited_customers' => $deposited_customers->deposited_customers ?? 0,
        'no_deposit_customers' => $no_deposit_customers
    ];
}





public function get_today_offficerexpected_collections($blanch_id, $empl_id)
{
    $today = date('Y-m-d');

    // Get detailed loan and payment info with one row per loan
    $this->db->select("
        l.loan_id,
		l.loan_status,
        l.customer_id,
        l.day,
        l.session,
        CONCAT_WS(' ', c.f_name, c.m_name, c.l_name) AS full_name,
        c.phone_no,
        e.empl_id,
        e.empl_name AS empl_name,
        l.how_loan AS loan_amount,
        l.restration,
        l.date_show AS expected_date,
        COALESCE(p.total_depost, 0) AS depost,
        COALESCE(d.empl_username, '') AS depositor_username,
        cat.loan_name,
        o.loan_stat_date,
        o.loan_end_date,
        b.blanch_name
    ");
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_customer c', 'c.customer_id = l.customer_id', 'left');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->where('e.blanch_id', $blanch_id);
    $this->db->where('e.empl_id', $empl_id); // <-- NEW FILTER
    $this->db->where('l.date_show', $today);

    // Subquery for total deposit per loan
    $this->db->join("
        (
            SELECT loan_id, SUM(depost) AS total_depost
            FROM tbl_pay
            WHERE description = 'CASH DEPOSIT' AND date_data = '{$today}'
            GROUP BY loan_id
        ) p", "l.loan_id = p.loan_id", 'left');

    // Subquery to get last depositor username per loan for today
    $this->db->join("
        (
            SELECT loan_id, MAX(empl_username) AS empl_username
            FROM tbl_depost
            WHERE depost_day = '{$today}'
            GROUP BY loan_id
        ) d", 'l.loan_id = d.loan_id', 'left');

    $this->db->join('tbl_loan_category cat', 'cat.category_id = l.category_id', 'left');
    $this->db->join('tbl_outstand o', 'o.loan_id = l.loan_id', 'left');
    $this->db->join('tbl_blanch b', 'b.blanch_id = l.blanch_id', 'left');

    $details = $this->db->get()->result();

    // Total restration
    $this->db->select('SUM(restration) AS total_restration');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->where('l.date_show', $today);
    $this->db->where('e.blanch_id', $blanch_id);
    $this->db->where('e.empl_id', $empl_id);
    $sum_restration = $this->db->get()->row();

    // Total deposit
    $this->db->select('SUM(p.depost) AS total_depost');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_pay p', "l.loan_id = p.loan_id AND p.date_data = '{$today}' AND p.description = 'CASH DEPOSIT'", 'inner');
    $this->db->where('l.date_show', $today);
    $this->db->where('e.blanch_id', $blanch_id);
    $this->db->where('e.empl_id', $empl_id);
    $sum_depost = $this->db->get()->row();

    // Total expected customers
    $this->db->select('COUNT(DISTINCT l.customer_id) AS total_customers');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->where('l.date_show', $today);
    $this->db->where('e.blanch_id', $blanch_id);
    $this->db->where('e.empl_id', $empl_id);
    $total_customers = $this->db->get()->row();

    // Deposited customers
    $this->db->select('COUNT(DISTINCT l.customer_id) AS deposited_customers');
    $this->db->from('tbl_loans l');
    $this->db->join('tbl_employee e', 'e.empl_id = l.empl_id', 'left');
    $this->db->join('tbl_pay p', "l.loan_id = p.loan_id AND p.date_data = '{$today}' AND p.description = 'CASH DEPOSIT'", 'inner');
    $this->db->where('l.date_show', $today);
    $this->db->where('e.blanch_id', $blanch_id);
    $this->db->where('e.empl_id', $empl_id);
    $this->db->where('p.depost >', 0);
    $deposited_customers = $this->db->get()->row();

    $no_deposit_customers = ($total_customers->total_customers ?? 0) - ($deposited_customers->deposited_customers ?? 0);

    return [
        'details' => $details,
        'total_restration' => $sum_restration->total_restration ?? 0,
        'total_depost' => $sum_depost->total_depost ?? 0,
        'total_customers' => $total_customers->total_customers ?? 0,
        'deposited_customers' => $deposited_customers->deposited_customers ?? 0,
        'no_deposit_customers' => $no_deposit_customers
    ];
}






  public function get_deposit_data_record($pay_id){
 	$data = $this->db->query("SELECT * FROM tbl_prev_lecod pr WHERE pr.pay_id = $pay_id");
 	return $data->row();
 }

  public function get_remain_blanch_capital($blanch_id,$trans_id){
 	$data = $this->db->query("SELECT * FROM tbl_blanch_account WHERE blanch_id = '$blanch_id' AND receive_trans_id = '$trans_id' LIMIT 1");
 	return $data->row();
 }

 public function get_description_pay($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pay WHERE loan_id = '$loan_id' ORDER BY pay_id DESC");
 	return $data->row();
 }

  public function get_total_pend_data($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_pending_total WHERE loan_id = '$loan_id'");
 	return $data->row();
 }
 public function get_outstand_loan_depost($loan_id){
 	$data = $this->db->query("SELECT * FROM tbl_outstand_loan WHERE loan_id = '$loan_id'");
 	return $data->row();
 }

 public function get_outstand_deposit($blanch_id,$trans_id){
       	$data = $this->db->query("SELECT * FROM tbl_receve_outstand WHERE blanch_id = '$blanch_id' AND trans_id = '$trans_id' LIMIT 1");
       	return $data->row();
       }


       












 //Admin login
	public function user_data($comp_phone, $password){
		$data = $this->db->where(['comp_phone'=>$comp_phone,'password'=>$password])
    	        ->get('tbl_company');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }

        //Super Admin login
	public function super_user_data($email, $password){
		$data = $this->db->where(['email'=>$email,'password'=>$password])
    	        ->get('tbl_super_admin');
    	  if ($data->num_rows() > 0) {
    	  	return $data->row();
    	  	
    	  }
       }


       //Admin login
	   public function get_employee_links($empl_id)
	   {
		   $this->db->select('system_links.link_name');  // Only select link_name
		   $this->db->from('tbl_permission');
		   $this->db->join('system_links', 'system_links.id = tbl_permission.link_id');
		   $this->db->where('tbl_permission.employee_id', $empl_id);
		   $query = $this->db->get()->result();
	   
		   // Extract only link_name strings from result
		   return array_map(fn($row) => $row->link_name, $query);
	   }
	   

	   public function employee_user_data($empl_no)
	   {
		   $this->db->select('e.*, p.position');
		   $this->db->from('tbl_employee e');
		   $this->db->join('tbl_position p', 'p.position_id = e.position_id', 'left');
		   $this->db->where('e.empl_no', $empl_no);
		   return $this->db->get()->row();
	   }
	   


	   public function get_company_name_by_employee($comp_id) {
		$this->db->select('comp_name');
		$this->db->from('tbl_company');
		$this->db->where('comp_id', $comp_id);
		$query = $this->db->get();
	
		if ($query->num_rows() > 0) {
			return $query->row()->comp_name; // Return the company name
		} else {
			return 'Unknown'; // Return a default value if no match is found
		}
	}
	
	public function get_mycustomer($blanch_id){
		// Get the logged-in user's employee name
		$empl_name = $this->session->userdata('empl_name'); 
	
		// Query to fetch customers associated with the employee's name
		$customer = $this->db->query("
			SELECT * 
			FROM tbl_customer c 
			 
			LEFT JOIN tbl_sub_customer sc ON sc.customer_id = c.customer_id 
			LEFT JOIN tbl_account_type at ON at.account_id = sc.account_id 
			LEFT JOIN tbl_blanch b ON b.blanch_id = c.blanch_id 
			WHERE c.blanch_id = '$blanch_id' 
			AND c.empl_name = '$empl_name'  -- Filter by the employee's name
			ORDER BY c.customer_id DESC
		");
	
		return $customer->result(); 
	}
	
	
}