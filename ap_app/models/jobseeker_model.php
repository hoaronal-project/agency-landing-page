<?php
class Jobseeker_Model extends CI_Model {
	
	private $table_name = 'tbl_jobseeker';
	
    public function __construct() {
	   $this->load->database();
    }
    
	public function add($data){
  
            $return = $this->db->insert($this->table_name, $data);
            if ((bool) $return === TRUE) {
                return $this->db->insert_id();
            } else {
                return $return;
            }       
	}	
	
	public function update($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update($this->table_name, $data);
		return $return;
	}
	
	public function delete($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table_name);
	}
	
	public function authenticate_user($email,$passcode){
		$this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('email_address', $email);
		$this->db->where('passcode', $passcode);
		$this->db->where('sts', 'active');
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
	}
	
	public function get_record_by_id($id) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('ID', $id);
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_record_by_email($email) {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->where('email_address', $email);
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_records($per_page='', $number='') {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->limit($per_page, $number);
		$this->db->order_by("ID", "DESC");
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_records_admin_listing($per_page='', $number='') {
       $Q = $this->db->query("SELECT tbl_jobseeker.*,
(SELECT COUNT(*) FROM tbl_applied_jobs WHERE job_seeker_ID=tbl_jobseeker.ID) AS total_applied_jobs
FROM tbl_jobseeker
ORDER BY ID DESC
LIMIT $number,$per_page");
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	
	public function record_count($table_name) {
		return $this->db->count_all($table_name);
    }
}