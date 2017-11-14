<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Keluhan.Content.Create';
    protected $permissionDelete = 'Keluhan.Content.Delete';
    protected $permissionEdit   = 'Keluhan.Content.Edit';
    protected $permissionView   = 'Keluhan.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model(array('keluhan/keluhan_model','kecamatan/kecamatan_model'));
        $this->lang->load('keluhan');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('keluhan', 'keluhan.js');
    }

    /**
     * Display a list of Keluhan data.
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
                    $deleted = $this->keluhan_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('keluhan_delete_success'), 'success');
                } else {
                    Template::set_message(lang('keluhan_delete_failure') . $this->keluhan_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->keluhan_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('keluhan_manage'));

        Template::render();
    }
    
    /**
     * Create a Keluhan object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_keluhan()) {
                log_activity($this->auth->user_id(), lang('keluhan_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'keluhan');
                Template::set_message(lang('keluhan_create_success'), 'success');

                redirect(SITE_AREA . '/content/keluhan');
            }

            // Not validation error
            if ( ! empty($this->keluhan_model->error)) {
                Template::set_message(lang('keluhan_create_failure') . $this->keluhan_model->error, 'error');
            }
        }

        Template::set('kecamatan',$this->kecamatan_model->find_all());
        Template::set('toolbar_title', lang('keluhan_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Keluhan data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('keluhan_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/keluhan');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_keluhan('update', $id)) {
                log_activity($this->auth->user_id(), lang('keluhan_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'keluhan');
                Template::set_message(lang('keluhan_edit_success'), 'success');
                redirect(SITE_AREA . '/content/keluhan');
            }

            // Not validation error
            if ( ! empty($this->keluhan_model->error)) {
                Template::set_message(lang('keluhan_edit_failure') . $this->keluhan_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->keluhan_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('keluhan_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'keluhan');
                Template::set_message(lang('keluhan_delete_success'), 'success');

                redirect(SITE_AREA . '/content/keluhan');
            }

            Template::set_message(lang('keluhan_delete_failure') . $this->keluhan_model->error, 'error');
        }
        
        Template::set('keluhan', $this->keluhan_model->find($id));

        Template::set('toolbar_title', lang('keluhan_edit_heading'));
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
    private function save_keluhan($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id_keluhan'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->keluhan_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->keluhan_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->keluhan_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->keluhan_model->update($id, $data);
        }

        return $return;
    }
}