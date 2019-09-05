<?php
class Jobs_Model extends CI_Model {
	
	private $table_name = 'tbl_jobs';
	
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
	
	public function get_active_record_by_id($id) {
       $Q = $this->db->query("SELECT tbl_jobs.*, tbl_job_types.type_name
FROM tbl_jobs
LEFT JOIN tbl_job_types ON tbl_jobs.job_type_ID=tbl_job_types.ID
WHERE tbl_jobs.ID='$id' AND sts='active'");
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
       $Q = $this->db->query("SELECT tbl_jobs.*, tbl_job_types.type_name,
(SELECT COUNT(*) FROM tbl_applied_jobs WHERE job_ID=tbl_jobs.ID) AS total_appications
FROM tbl_jobs
LEFT JOIN tbl_job_types ON tbl_jobs.job_type_ID=tbl_job_types.ID
ORDER BY tbl_jobs.ID DESC
LIMIT $number,$per_page");
        if ($Q->num_rows > 0) {
            $return = $Q->result();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
	public function get_all_active_records($per_page='', $number='') {
         $Q = $this->db->query("SELECT tbl_jobs.*, tbl_job_types.type_name
FROM tbl_jobs
LEFT JOIN tbl_job_types ON tbl_jobs.job_type_ID=tbl_job_types.ID
WHERE sts='active'
ORDER BY tbl_jobs.ID DESC
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