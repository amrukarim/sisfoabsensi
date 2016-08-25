<?php
class Guru_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function set_guru()
	{

		$data = array(
			'guru_id' => '',
			'guru_email' => $this->input->post('guru_email'),
			'guru_pass' => md5($this->input->post('guru_tgllahir')),
			'guru_nama' => $this->input->post('guru_nama'),
			'guru_jk' => $this->input->post('guru_jk'),
			'guru_tgllahir' => $this->input->post('guru_tgllahir'),
			'guru_telp' => '0'.$this->input->post('guru_telp'),
			'guru_status' => '',
			'guru_lv' => $this->input->post('guru_lv')

		);

		return $this->db->insert('guru', $data);
	}

	public function delete_guru($guru_id)
	{
		$this->db->where('guru_id', $guru_id);
		$this->db->delete('guru');
	}

	public function update_guru()
	{
		$data = array(
		        'guru_nama' => $this->input->post('guru_nama'),
		        'guru_jk' => $this->input->post('guru_jk'),
		        'guru_tgllahir' => $this->input->post('guru_tgllahir'),
		        'guru_telp' => $this->input->post('guru_telp'),
		        'guru_lv' => $this->input->post('guru_lv')
		);

		$this->db->where('guru_id', $this->input->post('guru_id'));
		$this->db->update('guru', $data);
	}

	public function get_guru($guru_id = FALSE)
	{
	        if ($guru_id === FALSE)
	        {
	                $query = $this->db->get('guru');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('guru', array('guru_id' => $guru_id));
	        return $query->row_array();
	}
	
	function Datatables($dt)
	{
		$columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

		//$join = $dt['join'];

		$sql  = "SELECT {$columns} FROM {$dt['table']}";


		$data = $this->db->query($sql);

		$rowCount = $data->num_rows();

		$data->free_result();

		// pengkondisian aksi seperti next, search dan limit
		$columnd = $dt['col-display'];
		$count_c = count($columnd);

		// search
		$search = $dt['search']['value'];

		/**
		 * Search Global
		 * pencarian global pada pojok kanan atas
		 */
		$where = '';
		if ($search != '') {   
			for ($i=0; $i < $count_c ; $i++) {
				$where .= $columnd[$i] .' LIKE "%'. $search .'%"';
				
				if ($i < $count_c - 1) {
					$where .= ' OR ';
				}
			}
		}
		
		/**
		 * Search Individual Kolom
		 * pencarian dibawah kolom
		 */
		for ($i=0; $i < $count_c; $i++) { 
			$searchCol = $dt['columns'][$i]['search']['value'];
			if ($searchCol != '') {
				$where = $columnd[$i] . ' LIKE "%' . $searchCol . '%" ';
				break;
			}
		}

		/**
		 * pengecekan Form pencarian
		 * pencarian aktif jika ada karakter masuk pada kolom pencarian.
		 */
		if ($where != '') {
			$sql .= " WHERE " . $where;
			
		}
		
		// sorting
		$sql .= " ORDER BY {$columnd[$dt['order'][0]['column']]} {$dt['order'][0]['dir']}";
		
		// limit
		$start  = $dt['start'];
		$length = $dt['length'];

		$sql .= " LIMIT {$start}, {$length}";
		
		$list = $this->db->query($sql);

		/**
		 * convert to json
		 */
		$option['draw']            = $dt['draw'];
		$option['recordsTotal']    = $rowCount;
		$option['recordsFiltered'] = $rowCount;
		$option['data']            = array();

		foreach ($list->result() as $row) {
		/**
		 * custom gunakan
		 * $option['data'][] = array(
		 *                       $row->columnd[0],
		 *                       $row->columnd[1],
		 *                       $row->columnd[2],
		 *                       $row->columnd[3],
		 *                       $row->columnd[4],
		 *                       .....
		 *                     );
		 */
		   $rows = array();
		   for ($i=0; $i < $count_c; $i++) { 
			   $rows[] = $row->$columnd[$i];
		   }
		   $option['data'][] = $rows;
		}

		// eksekusi json
		echo json_encode($option);

	}

	function cek_email($guru_email)
	{
	    $this->db->where('guru_email',$guru_email);
	    $query = $this->db->get('guru');
	    if ($query->num_rows() > 0)
	    {
	        return 1;
	    }
	    else
	    {
	        return 0;
	    }
	}
}

