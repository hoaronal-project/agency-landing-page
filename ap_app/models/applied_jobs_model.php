<?php
class Applied_Jobs_Model extends CI_Model {
	
	private $table_name = 'tbl_applied_jobs';
	
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
	
	public function get_all_records($limit='', $number='') {
        $this->db->select('*');
        $this->db->from($this->table_name);
		$this->db->limit($limit, $number);
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
	
	public function record_count($table_name) {
		return $this->db->count_all($table_name);
    }
	
	public function get_jobseekers_by_job_id($job_id, $per_page, $page) {
        $Q = $this->db->query("select tbl_applied_jobs.job_seeker_ID, tbl_applied_jobs.job_ID, tbl_jobseeker.*, tbl_jobs.job_title
from tbl_applied_jobs
inner JOIN tbl_jobseeker ON tbl_jobseeker.ID=tbl_applied_jobs.job_seeker_ID
inner JOIN tbl_jobs ON tbl_jobs.ID=tbl_applied_jobs.job_ID
WHERE tbl_applied_jobs.job_ID='$job_id' ORDER BY tbl_applied_jobs.ID LIMIT $page, $per_page");
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_jobs_by_jobseeker_id($jobseeker_id, $per_page, $page) {
         $Q = $this->db->query("select tbl_applied_jobs.job_seeker_ID, tbl_applied_jobs.job_ID, tbl_jobs.*, tbl_jobseeker.f_name,tbl_jobseeker.l_name
from tbl_applied_jobs
inner JOIN tbl_jobs ON tbl_jobs.ID=tbl_applied_jobs.job_ID
inner JOIN tbl_jobseeker ON tbl_jobseeker.ID=tbl_applied_jobs.job_seeker_ID
WHERE tbl_applied_jobs.job_seeker_ID='$jobseeker_id' ORDER BY tbl_applied_jobs.ID LIMIT $page, $per_page");
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
	public function count_jobseekers_by_job_id($job_id) {
        $Q = $this->db->query("select COUNT(*) as total from tbl_applied_jobs WHERE tbl_applied_jobs.job_ID='$job_id'");
        if ($Q->num_rows > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function count_jobs_by_jobseeker_id($jobseeker_id) {
         $Q = $this->db->query("select COUNT(*) as total from tbl_applied_jobs WHERE tbl_applied_jobs.job_seeker_ID='$jobseeker_id'");
        if ($Q->num_rows > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function is_already_applied($seeker_id, $job_id) {
        $Q = $this->db->query("select COUNT(*) as total FROM $this->table_name WHERE job_seeker_ID='$seeker_id' AND job_ID='$job_id'");
        if ($Q->num_rows > 0) {
            $return = $Q->row('total');
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	
}