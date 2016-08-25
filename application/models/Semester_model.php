<?php
class Semester_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function set_semester()
	{
		$taw = $this->input->post('semester_tahunawal');
		$tak = $this->input->post('semester_tahunawal')+1;
		$nama = $taw." / ".$tak;

		$data = array(
			'semester_id' => '',
			'semester_nama' => $nama,
			'semester_hari' => $this->input->post('semester_hari'),
			'semester_status' => '0',
			'semester_tipe' => $this->input->post('semester_tipe'),
			'semester_tahunawal' => $this->input->post('semester_tahunawal'),
			'semester_tahunakhir' => $this->input->post('semester_tahunawal')+1

		);

		return $this->db->insert('semester', $data);
	}

	public function delete_semester($semester_id)
	{
		$this->db->where('semester_id', $semester_id);
		$this->db->delete('semester');
	}

	public function update_semester()
	{
		$data = array(
		        'semester_nama' => $this->input->post('semester_nama'),
				'semester_hari' => $this->input->post('semester_hari'),
				'semester_status' => $this->input->post('semester_status')
		);

		$this->db->where('semester_id', $this->input->post('semester_id'));
		$this->db->update('semester', $data);
	}

	public function get_semester($semester_id = FALSE)
	{
	        if ($semester_id === FALSE)
	        {
	                $query = $this->db->get('semester');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('semester', array('semester_id' => $semester_id));
	        return $query->row_array();
	}

	public function aktivasi_semester($semester_id)
	{
		$data = array(
		        'semester_status' => '1'
		);

		$this->db->where('semester_id', $semester_id);
		$this->db->update('semester', $data);
	}

	public function nonaktivasi_semester($semester_id)
	{
		$data = array(
		        'semester_status' => '0'
		);

		$this->db->where('semester_id !=', $semester_id);
		$this->db->update('semester', $data);
	}

	public function get_semesteraktif()
	{
	    $query = $this->db->get_where('semester', array('semester_status' => '1'));
	    return $query->row_array();
	}
}

