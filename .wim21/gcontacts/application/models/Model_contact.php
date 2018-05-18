<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_contact extends CI_Model {
	public function __construct(){
	$this->load->database();
	}
	public function set_contact($contact){
		$id = $contact['id'];
		$data = array(
		//	'id'=>$id,
			'nom' => $contact['nom'],
			'prenom' => $contact['prenom'],
			'email' => $contact['email']
		);

		$this->db->where('id', $id);
		return $this->db->update('contacts', $data);
		//return $this->db->replace('contacts',$data);

	}
public function get_contact_page($page,$total){
			$this->db->select('*')
				->from('contacts')
				->limit($total,$total*($page-1));
			$query = $this->db->get();
			return $query->result();
	}

	public function get_contact($id=null){
		if (isset($id)){
			$this->db->select('*')
				->from('contacts')
				->where('id', $id)
				->limit(1);
			$query = $this->db->get();

			if($query->num_rows() == 1)
				return $query->row();
			else
				return false;
		}else{
			$this->db->select('*')
				->from('contacts');
			$query = $this->db->get();
			return $query->result();
		}
	}
	public function create_contact($data){
		return	$this->db->insert('contacts', $data);	

	}
	public function delete_contact($id){
		return $this->db
			->where('id',$id)
			->delete("contacts");

	}
	public function check_email($email){
	$this->db->select('email')
		->from('contacts')
		->where('email',$email);
	$query = $this->db->get();
	return ($query->num_rows() <= 1); 

	}
}
