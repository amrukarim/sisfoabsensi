<?php
class Siswa_model extends CI_Model {

	public function __construct()
	{
		//$this->load->database();
	}

	public function set_siswa()
	{

		$data = array(
			'siswa_id' => '',
			'siswa_nama' => $this->input->post('siswa_nama'),
			'siswa_jk' => $this->input->post('siswa_jk'),
			'siswa_telportu' => $this->input->post('siswa_telportu'),
			'siswa_emailortu' => $this->input->post('siswa_emailortu'),
			'kelas_id' => $this->input->post('kelas_id')

		);

		return $this->db->insert('siswa', $data);
	}

	public function delete_siswa($siswa_id)
	{
		$this->db->where('siswa_id', $siswa_id);
		$this->db->delete('siswa');
	}

	public function update_siswa()
	{
		$data = array(
            'siswa_nama' => $this->input->post('siswa_nama'),
            'siswa_jk' => $this->input->post('siswa_jk'),
            'siswa_telportu' => $this->input->post('siswa_telportu'),
            'siswa_emailortu' => $this->input->post('siswa_emailortu'),
            'kelas_id' => $this->input->post('kelas_id')
		);

		$this->db->where('siswa_id', $this->input->post('siswa_id'));
		$this->db->update('siswa', $data);
	}

	public function get_siswa($siswa_id = FALSE)
	{
        if ($siswa_id === FALSE)
        {
            $query = $this->db->get('siswa');
            return $query->result_array();
        }

        $this->db->join('kelas', 'kelas.kelas_id = siswa.kelas_id', 'inner');
        $query = $this->db->get_where('siswa', array('siswa_id' => $siswa_id));
        return $query->row_array();
	}

	public function get_siswakelas($kelas_id = FALSE)
	{		
			$this->db->select('siswa_id, siswa_nama, siswa_emailortu, siswa_telportu');
			$this->db->where("kelas_id = '$kelas_id'");
			$query = $this->db->get('siswa');

	        return $query->result_array();
	}
	
	function Datatables($dt)
    {
        $columns = implode(', ', $dt['col-display']) . ', ' . $dt['id-table'];

        $join = $dt['join'];

        $sql  = "SELECT {$columns} FROM {$dt['table']} {$join}";


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

