<?php
class Admin_Model extends CI_Model {
    public function __construct() {
       // parent::__construct();
	   $this->load->database();
    }
    
	public function update($id, $data){
		$this->db->where('ID', $id);
		$return=$this->db->update('tbl_admin', $data);
		return $return;
	}
	
	public function authenticate_admin($user_name, $password) {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('admin_username', $user_name);
		$this->db->where('admin_password', $password);
        $Q = $this->db->get();
        if ($Q->num_rows > 0) {
            $return = $Q->row();
        } else {
            $return = 0;
        }
        $Q->free_result();
        return $return;
    }
	
}
?>
