<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function login()
	{
		$data = $this->db->where('username', $this->input->post('nama'))
				 ->where('pass', sha1($this->input->post('pass')))
				 ->get('user');

		if ($this->db->affected_rows() > 0) {
			$row = $data->row();

			$array = array(
				'nama' => $row->username,
				'pass' => $row->pass,
				'login' => true
			);
			
			$this->session->set_userdata( $array );

			return true;
		} else {
			return false;
		}
	}	

	public function insert_pemilihan()
	{
		$object = array(
			'pemilu' => $this->input->post('pemilu'),
			'nama_calon' => $this->input->post('nama_calon'),
			'jumlah' => $this->input->post('jumlah') 
		);

		$this->db->where('id', '1')->update('nama_pemilu', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getNamaPemilu()
	{
		return $this->db->where('id', '1')->get('nama_pemilu')->row();
	}

	public function insert_calon($object)
	{
		$this->db->insert('calon', $object);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_calon()
	{
		$this->db->empty_table('calon');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_suara()
	{
		$this->db->empty_table('surat_suara');

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function gen_id(){
		do{
			$id=rand(100, 999999);
			$object = array('id' => $id );
			$this->db->insert('surat_suara', $object);
			$num = $this->db->select('id')->get('surat_suara')->num_rows();
		}while($num<370);
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */