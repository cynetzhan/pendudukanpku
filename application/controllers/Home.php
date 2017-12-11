<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Home controller
 *
 * The base controller which displays the homepage of the Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');

        $this->load->library('installer_lib');
        if (! $this->installer_lib->is_installed()) {
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available, since
        // we're not extending from a Bonfire controller
        // and it's not done for us.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
        Assets::add_css(array('bootstrap.min.css', 'bootflat.min.css','site.css','font-awesome.min.css'));
        Assets::add_js(array('jquery.min.js','bootstrap.min.js'));
	}

	//--------------------------------------------------------------------

	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('users/auth');
		$this->set_current_user();
  Assets::add_css(array('leaflet.css','MarkerCluster.css','MarkerCluster.Default.css','L.Control.Locate.css','leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.css','app.css'));
  Assets::add_js(array('Chart.min.js','typeahead.bundle.min.js','handlebars.min.js','list.min.js','leaflet.js','leaflet.markercluster.js','L.Control.Locate.min.js','leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.js','app.js')); 
  
  $this->load->model('sarana/sarana_model');
  $records = $this->sarana_model->find_all_joined();
  $sarana=array();
  $warna=array();
  foreach($records as $record){
   $data = array(hitungBobot($record->krit1_sarana,1),
             hitungBobot($record->krit2_sarana,2),
             hitungBobot($record->krit3_sarana,3),
             hitungBobot($record->krit4_sarana,4),
             hitungBobot($record->krit5_sarana,5)
   );
   $hasilBobot = hitungHasil($data);
   $warna[$record->nama_kecamatan] = $record->warna_peta;
   $sarana[$record->nama_kecamatan] = $hasilBobot;
  }
  Assets::add_js("var ctx=document.getElementById('chartaja').getContext('2d');window.myBar=new Chart(ctx,{type:'bar',data:barChartData,options:{responsive:true,legend:{display:false,position:'top',},title:{display:true,text:'Kondisi Sarana'}}});", 'inline');
  Template::set('sarana',$sarana);
  Template::set('warna', $warna);
		Template::render();
	}//end index()
 
 public function gis()
 {
  $this->load->library('users/auth');
  $this->set_current_user(); 
   
  Template::render();
 }
 
 public function profil($id){
  $this->load->library('users/auth');
  $this->set_current_user();
  $this->load->model('artikel/artikel_model');
  $profil=$this->artikel_model->find($id);
  $prolist=$this->artikel_model->find_all();
  //echo var_dump($profil);
  Template::set('profil',$profil);
  Template::set('prolist',$prolist);
  Template::render();
 }
 
 public function apicamat(){
  $nama = $this->input->get('kecamatan');
  $this->load->model('kecamatan/kecamatan_model');
  $hasil = $this->kecamatan_model->find_by('nama_kecamatan',$nama);
  echo json_encode($hasil);
 }
 

	//--------------------------------------------------------------------

	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded. By not requiring
	 * this to be executed and loaded for every command, we can speed up calls
	 * that don't need users at all, or rely on a different type of auth, like
	 * an API or cronjob.
	 *
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
        if (class_exists('Auth')) {
			// Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
				$this->current_user = clone $this->auth->user();

				$this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

				// if the user has a language setting then use it
                if (isset($this->current_user->language)) {
					$this->config->set_item('language', $this->current_user->language);
				}
            } else {
				$this->current_user = null;
			}

			// Make the current user available in the views
            if (! class_exists('Template')) {
				$this->load->library('Template');
			}
			Template::set('current_user', $this->current_user);
		}
	}
}
/* end ./application/controllers/home.php */
