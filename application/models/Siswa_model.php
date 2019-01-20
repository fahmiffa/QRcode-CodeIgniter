<?php 

class Siswa_model extends CI_Model
{
	function get_all_siswa(){
		$hasil=$this->db->get('siswa');
		return $hasil;
	}

	function view_all($table)
	{
				$query = $this->db->get($table);
		return $query->result();
	}

	public function check_all($table,$where,$limit)
	{
	  	$query = $this->db->get_where($table,$where,$limit);
	    if($query->num_rows()==1)
	    {
	      return $query->result();
	    }
	    else 
	    {
	      return false;
	    }

	}

		//update data
	public function update_all($where,$data,$table) 
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	//delete data
	public function delete_all($table,$data)  
    {
    	$this->db->delete($table,$data);       
    }
    
	function simpan_siswa($nim,$nama,$jurusan,$image_name)
	{
		$data = array(
			'nim'		=> $nim,
			'nama'		=> $nama,
			'jurusan'	=> $jurusan,
			'qr_code'	=> $image_name
		);
		$this->db->insert('siswa',$data);
	}
}
?>