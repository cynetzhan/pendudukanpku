<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Keluhan controller
 */
class Keluhan extends Front_Controller
{
    protected $permissionCreate = 'Keluhan.Keluhan.Create';
    protected $permissionDelete = 'Keluhan.Keluhan.Delete';
    protected $permissionEdit   = 'Keluhan.Keluhan.Edit';
    protected $permissionView   = 'Keluhan.Keluhan.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('keluhan/keluhan_model');
        $this->lang->load('keluhan');
        
        

        Assets::add_module_js('keluhan', 'keluhan.js');
    }

    /**
     * Display a list of Keluhan data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->keluhan_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}