<?php
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'egrid_model.php';
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'app_controller.php';
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'Egrids_List_Table.php';
class EgridsController extends AppController{
	private $EgridModel;

	public function __construct()
	{
		$this->EgridModel = new EgridModel();
		parent::__construct();
	}

	public function index()
	{
		//Prepare Table of elements
		$wp_list_table = new Egrids_List_Table();
		$wp_list_table->prepare_items();
		$this->render->view('egrids/index.php', array('wp_list_table'=>$wp_list_table));
	}

	public function add()
	{
		if(isset($_POST['data']) && !empty($_POST['data'])){
			$_POST['data']['expanding_height'] = intval($_POST['data']['resize_height']);
			if($this->EgridModel->insert_data($_POST['data'])){
				$this->set_flash(__('Data has been saved!'));
			}else{
				$this->set_flash(__('Something went wrong!'), 'error');
			}
			$url = admin_url('admin.php?page=elastic-grid');
			wp_redirect($url);
		}
		$this->render->view('egrids/add.php', null);
	}

	public function edit()
	{
		if(isset($_POST['data']) && !empty($_POST['data'])){
			$_POST['data']['expanding_height'] = intval($_POST['data']['resize_height']);
			$upd = $this->EgridModel->update_data($_POST['data']);
			$this->set_flash(__('Quiz has been saved!'));
			$url = admin_url('admin.php?page=elastic-grid');
			wp_redirect($url);
		}

		// check id parameter
		$id = (isset($_GET['egrid_id'])) ? $_GET['egrid_id'] : false;
		if(!$id){
			$url = admin_url('admin.php?page=elastic-grid');
			$this->set_flash(__('Invalid Id'), 'error');
			wp_redirect($url);
		}

		// get data by id, then bind to form
		$data = $this->EgridModel->get_data_by_id($id);

		$this->render->view('egrids/edit.php', $data);
	}

	public function delete()
	{
		if(isset($_POST['data']['id']) && !empty($_POST['data']['id'])){
			$upd = $this->EgridModel->delete_data($_POST['data']['id']);
			$this->set_flash(__('Data deleted!'));
			$url = admin_url('admin.php?page=elastic-grid');
			wp_redirect($url);
		}

		$id = (isset($_GET['egrid_id'])) ? $_GET['egrid_id'] : false;
		if(!$id){
			$url = admin_url('admin.php?page=elastic-grid');
			$this->set_flash(__('Invalid Id'), 'error');
			wp_redirect($url);
		}

		$data = $this->EgridModel->get_data_by_id($id);
		$this->render->view('egrids/delete.php', $data);
	}
}

?>