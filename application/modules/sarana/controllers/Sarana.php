<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Sarana controller
 */
class Sarana extends Front_Controller
{
    protected $permissionCreate = 'Sarana.Sarana.Create';
    protected $permissionDelete = 'Sarana.Sarana.Delete';
    protected $permissionEdit   = 'Sarana.Sarana.Edit';
    protected $permissionView   = 'Sarana.Sarana.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('sarana/sarana_model');
        $this->lang->load('sarana');
        
        

        Assets::add_module_js('sarana', 'sarana.js');
    }

    /**
     * Display a list of Sarana data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->sarana_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}