<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Artikel.Content.Create';
    protected $permissionDelete = 'Artikel.Content.Delete';
    protected $permissionEdit   = 'Artikel.Content.Edit';
    protected $permissionView   = 'Artikel.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('artikel/artikel_model');
        $this->lang->load('artikel');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('artikel', 'artikel.js');
    }

    /**
     * Display a list of Artikel data.
     *
     * @return void
     */
    public function index()
    {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

                $result = true;
                foreach ($checked as $pid) {
                    $deleted = $this->artikel_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('artikel_delete_success'), 'success');
                } else {
                    Template::set_message(lang('artikel_delete_failure') . $this->artikel_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->artikel_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('artikel_manage'));

        Template::render();
    }
    
    /**
     * Create a Artikel object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_artikel()) {
                log_activity($this->auth->user_id(), lang('artikel_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'artikel');
                Template::set_message(lang('artikel_create_success'), 'success');

                redirect(SITE_AREA . '/content/artikel');
            }

            // Not validation error
            if ( ! empty($this->artikel_model->error)) {
                Template::set_message(lang('artikel_create_failure') . $this->artikel_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('artikel_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Artikel data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('artikel_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/artikel');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_artikel('update', $id)) {
                log_activity($this->auth->user_id(), lang('artikel_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'artikel');
                Template::set_message(lang('artikel_edit_success'), 'success');
                redirect(SITE_AREA . '/content/artikel');
            }

            // Not validation error
            if ( ! empty($this->artikel_model->error)) {
                Template::set_message(lang('artikel_edit_failure') . $this->artikel_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->artikel_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('artikel_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'artikel');
                Template::set_message(lang('artikel_delete_success'), 'success');

                redirect(SITE_AREA . '/content/artikel');
            }

            Template::set_message(lang('artikel_delete_failure') . $this->artikel_model->error, 'error');
        }
        
        Template::set('artikel', $this->artikel_model->find($id));

        Template::set('toolbar_title', lang('artikel_edit_heading'));
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    private function save_artikel($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id_artikel'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->artikel_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->artikel_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['tgl_terbit_artikel']	= $this->input->post('tgl_terbit_artikel') ? $this->input->post('tgl_terbit_artikel') : '0000-00-00';

        $return = false;
        if ($type == 'insert') {
            $id = $this->artikel_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $old_data = $this->artikel_model->find($id);
            $return = $this->artikel_model->update($id, $data);
        }
        if($type == 'insert'){
         $id=$this->db->insert_id();
        }
        $data = array();
        $config['upload_path']   = 'data/images/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 10240;
        $config['file_name']     = "Info-".$id;
        $this->load->library('upload', $config);

        if($this->upload->data() !== null) {
         if ( ! $this->upload->do_upload('images') && ! $this->upload->data('is_image') ){
           $error = array('error' => $this->upload->display_errors());
           if($error['error'] == "You did not select a file to upload."){
            $this->flashMsg($this->upload->display_errors(),"","");
            //echo $this->upload->display_errors();
           }
           if($type != 'update'){
            $data['foto_informasi'] = '';
           }
         } else {
           $data['foto_informasi'] = $this->upload->data('file_name');
           if($type == 'update'){
            unlink($config['upload_path'].$old_data->foto_informasi);
           }
           $return = $this->artikel_model->update($id,$data);
         }
        }

        return $return;
    }
}