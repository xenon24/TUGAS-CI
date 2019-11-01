<?php

class Province_model extends CI_Model {


	// public function get_province($id = FALSE) {
	// 	if ($id === FALSE) {
	// 		$query = $this->db->get('province');
	// 		return $query->result_array();
	// 	}

	// 	$query = $this->db->get_where('province', array('id' => $id));
	// 	return $query->row_array();
	// }

	public function select() {
		$this->db->select('*');
		$this->db->from('province');
		$this->db->order_by('name_province', 'asc');
		$data = $this->db->get('');
		return $data;
	}

	public function entry($data) {
		$this->db->insert('province', $data);
	}

	public function update($data,$id) {
		$this->db->update('province', $data,['id'=>$id]);
	}


	public function get_data($id) {
		$data = $this->db->where(['id' => $id])->get("province");
		if ($data->num_rows() > 0) {
			return $data->row();
		}
	}

	public function delete_entry($id){
		$this->db->where('id', $id);
		$this->db->delete('province');
	}


}

