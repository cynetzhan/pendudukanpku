<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Artikel controller
 */
class Artikel extends Front_Controller
{
    protected $permissionCreate = 'Artikel.Artikel.Create';
    protected $permissionDelete = 'Artikel.Artikel.Delete';
    protected $permissionEdit   = 'Artikel.Artikel.Edit';
    protected $permissionView   = 'Artikel.Artikel.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('artikel/artikel_model');
        $this->lang->load('artikel');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
        

        Assets::add_module_js('artikel', 'artikel.js');
    }

    /**
     * Display a list of Artikel data.
     *
     * @return void
     */
    public function index()
    {
        
        
        
        
        $records = $this->artikel_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
}