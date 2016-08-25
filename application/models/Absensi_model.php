<?php
class Absensi_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function get_kelas($kelas_id = FALSE)
	{
	        if ($kelas_id === FALSE)
	        {
	                $query = $this->db->get('kelas');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('kelas', array('kelas_id' => $kelas_id));
	        return $query->row_array();
	}

	public function get_absensidata($absensi_id)
	{
		$query = $this->db->get_where('absensi', array('absensi_id' => $absensi_id));
        return $query->result_array();
	}

	public function get_absensi($siswa_id = FALSE)
	{
	        if ($siswa_id === FALSE)
	        {
	                $query = $this->db->get('absensi');
	                return $query->result_array();
	        }

	        // Menentukan Semester Aktif
	        $querysem = $this->db->query("SELECT semester_id FROM semester WHERE semester_status = 1");
	        $row = $querysem->row();

	        $semester_id = $row->semester_id;

			$query = $this->db->query("SELECT * FROM absensi WHERE siswa_id = '$siswa_id' AND semester_id = '$semester_id'");
			return $query->result_array();
	}

	public function set_absensi($securitykey)
	{
		$this->load->model('semester_model');

		if ($this->input->post('action')=='Alpha') {
			$absensi_status = '1';
		}
		elseif ($this->input->post('action')=='Sakit') {
			$absensi_status = '2';
		}
		elseif ($this->input->post('action')=='Izin') {
			$absensi_status = '3';
		}

		$semester_item = $this->semester_model->get_semesteraktif();

		$data = array(
			'absensi_id' => '',
			'absensi_status' => $absensi_status,
			//'absensi_waktu' => '(NOW())',
			'absensi_sk' => $securitykey,
			'semester_id' => $semester_item['semester_id'],
			'siswa_id' => $this->input->post('siswa_id'),
			'guru_id' => $this->session->userdata('guru_id'),
			'kelas_id' => $this->input->post('kelas_id')

		);

		$this->db->set('absensi_waktu', 'NOW()', FALSE);

		return $this->db->insert('absensi', $data);
	}

	public function delete_absensi()
	{
		$this->db->where('absensi_id', $this->input->post('absensi_id'));
		$this->db->delete('absensi');
	}

	public function get_absensikelas($kelas_id = FALSE)
	{		

		$date = date("Y-m-d");

			$this->db->select('absensi.absensi_id,absensi.absensi_sk, absensi.absensi_waktu, absensi.absensi_status, siswa.siswa_id, siswa.siswa_emailortu, siswa.siswa_telportu, siswa.siswa_nama, absensi.kelas_id');
			$this->db->join('siswa', 'absensi.siswa_id = siswa.siswa_id', 'inner');
			$this->db->where("absensi.kelas_id = '$kelas_id' AND DATE(absensi_waktu) = '$date'");
			$query = $this->db->get('absensi');

	        return $query->result_array();
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
}