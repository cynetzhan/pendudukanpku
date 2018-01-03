<?php defined('BASEPATH') || exit('No direct script access allowed');

class Keluhan_model extends BF_Model
{
    protected $table_name	= 'keluhan';
	protected $key			= 'id_keluhan';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= false;
	protected $set_modified = false;
	protected $soft_deletes	= false;


	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'id_user',
			'label' => 'Pelapor',
			'rules' => 'required|numeric',
		),
		array(
			'field' => 'id_kecamatan',
			'label' => 'lang:keluhan_field_id_kecamatan',
			'rules' => 'required|numeric',
		),
		array(
			'field' => 'isi_keluhan',
			'label' => 'lang:keluhan_field_isi_keluhan',
			'rules' => 'required',
		),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function find_all_joined(){
     $this->db->select('bf_keluhan.*,bf_users.username,bf_users.display_name,bf_kecamatan.nama_kecamatan');
     $this->db->where("bf_keluhan.id_user = bf_users.id and bf_keluhan.id_kecamatan = bf_kecamatan.id_kecamatan");
     return $this->db->get('bf_keluhan, bf_users, bf_kecamatan')->result();
    }
    
    public function find_joined($id){
     $this->db->select('bf_keluhan.*,bf_users.username,bf_users.display_name,bf_kecamatan.nama_kecamatan');
     $this->db->where("bf_keluhan.id_user = bf_users.id and bf_keluhan.id_kecamatan = bf_kecamatan.id_kecamatan");
     $this->db->where("bf_keluhan.id_keluhan",$id);
     return $this->db->get('bf_keluhan, bf_users, bf_kecamatan')->row();
    }
}