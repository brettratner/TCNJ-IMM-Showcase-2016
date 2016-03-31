<?php
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'project_model.php';
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'egrid_model.php';
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.'app_controller.php';
require WP_EGRIDS_PATH.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.'Projects_List_Table.php';
class ProjectsController extends AppController{
	private $Project;

	public function __construct()
	{
		$this->Project = new ProjectModel();
		parent::__construct();
	}

	public function index()
	{
		$id = (isset($_GET['egrid_id'])) ? $_GET['egrid_id'] : false;
		if(!$id){
			$url = admin_url('admin.php?page=elastic-grid');
			$this->set_flash(__('Invalid Id'), 'error');
			wp_redirect($url);
		}
		$egridModel = new EgridModel();
		$data = $egridModel->get_data_by_id($id);
		//Prepare Table of elements
		$wp_list_table = new Projects_List_Table($id);
		$wp_list_table->prepare_items();
		$this->render->view('projects/index.php', array('wp_list_table'=>$wp_list_table, 'data'=>$data));
	}

	public function add()
	{
		if(isset($_POST['data']) && !empty($_POST['data'])){
			$_POST = stripslashes_deep($_POST);

			if(isset($_POST['data']['button_list']) && !empty($_POST['data']['button_list'])){
				$_POST['data']['button_list'] = json_encode($_POST['data']['button_list']);
			}
			$lastInsertId = $this->Project->insert_data($_POST['data']);
			if($lastInsertId){
				$this->set_flash(__('Data has been saved!'));
			}else{
				$this->set_flash(__('Something went wrong!'), 'error');
			}
			$url = admin_url('admin.php?page=elastic-grid&controller=projects&action=edit&project_id='.$lastInsertId.'&egrid_id='.$_GET['egrid_id']);
			wp_redirect($url);
		}
		$this->render->view('projects/add.php', null);
	}

	public function edit()
	{
		if(isset($_POST['data']) && !empty($_POST['data'])){
			$_POST = stripslashes_deep($_POST);

			if(isset($_POST['data']['button_list']) && !empty($_POST['data']['button_list'])){
				$_POST['data']['button_list'] = json_encode($_POST['data']['button_list']);
			}
			$_POST['data']['egrid_id'] = $_GET['egrid_id'];
			$upd = $this->Project->update_data($_POST['data']);
			$this->set_flash(__('Project has been saved!'));
			$url = admin_url('admin.php?page=elastic-grid&controller=projects&action=index&egrid_id='.$_GET['egrid_id']);
			wp_redirect($url);
		}

		// check id parameter
		$id = (isset($_GET['project_id'])) ? $_GET['project_id'] : false;
		if(!$id){
			$url = admin_url('admin.php?page=elastic-grid&controller=projects&action=index&egrid_id='.$_GET['egrid_id']);
			$this->set_flash(__('Invalid Id'), 'error');
		}

		// get data by id, then bind to form
		$data = $this->Project->get_data_by_id($id);

		//get grid config
		$egridModel = new EgridModel();
		$gridConfig = $egridModel->get_data_by_id($_GET['egrid_id']);

		$this->render->view('projects/edit.php', array($data, $gridConfig) );
	}

	public function delete()
	{
		if(isset($_POST['data']['id']) && !empty($_POST['data']['id'])){
			$upd = $this->Project->delete_data($_POST);
			$this->set_flash(__('Data deleted!'));
			$url = admin_url('admin.php?page=elastic-grid&controller=projects&action=index&egrid_id='.$_GET['egrid_id']);
			wp_redirect($url);
		}

		$id = (isset($_GET['project_id'])) ? $_GET['project_id'] : false;
		if(!$id){
			$url = admin_url('admin.php?page=elastic-grid&controller=projects&action=index&egrid_id='.$_GET['egrid_id']);
			$this->set_flash(__('Invalid Id'), 'error');
			wp_redirect($url);
		}

		$data = $this->Project->get_data_by_id($id);
		$this->render->view('projects/delete.php', $data);
	}
}

?>