<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Kecamatan controller
 */
class Kecamatan extends Front_Controller
{
    protected $permissionCreate = 'Kecamatan.Kecamatan.Create';
    protected $permissionDelete = 'Kecamatan.Kecamatan.Delete';
    protected $permissionEdit   = 'Kecamatan.Kecamatan.Edit';
    protected $permissionView   = 'Kecamatan.Kecamatan.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('kecamatan/kecamatan_model');
        $this->lang->load('kecamatan');
        
        

        Assets::add_module_js('kecamatan', 'kecamatan.js');
    }

    /**
     * Display a list of Kecamatan data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->kecamatan_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}