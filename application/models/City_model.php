<?php

class City_model extends CI_Model {

	public function select() {
		$this->db->select('*');
		$this->db->from('city');
		$this->db->order_by('name', 'asc');
		$data = $this->db->get('');
		return $data;
	}

	public function entry($data) {
		$this->db->insert('city', $data);
	}

	public function update($data,$id) {
		$this->db->update('city', $data,['id'=>$id]);
	}


	public function get_data($id) {
		$data = $this->db->where(['id' => $id])->get("city");
		if ($data->num_rows() > 0) {
			return $data->row();
		}
	}

	public function delete_entry($id){
		$this->db->where('id', $id);
		$this->db->delete('city');
	}

}

