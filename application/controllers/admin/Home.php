<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends Admin_Controller {

    public function __construct()
    {
         parent::__construct();

         $this->load->model('project_model');
         $this->load->model('task_model');
    }

	public function index()
    {
       $data=array();

       if($this->user_info['group_id'] == 1)
       {
           $this->project_model->_table_name = 'projects';
           $admin_projects = $this->project_model->get('status=0');
           $data['admin_projects'] = $admin_projects;
       }
       elseif($this->user_info['group_id'] == 2)
       {
           $this->project_model->_table_name = 'projects';
           $this->task_model->_table_name = 'tasks';

           // your projects
           $projects = $this->project_model->get('status=0 AND user_id='.$this->user_info['id'] );
           $data['projects'] = $projects;

           // waiting tasks
           $waiting_tasks = $this->task_model->get('user_id='.$this->user_info['id'] .' AND status=1 ','5','0',' created_at ASC ');
           $data['waiting_tasks'] = $waiting_tasks;

           // in progress tasks
           $progress_tasks = $this->task_model->get('user_id='.$this->user_info['id'] .' AND status=2 ');
           $data['progress_tasks'] = $progress_tasks;

       }
       elseif($this->user_info['group_id'] == 3)
       {

           $this->task_model->_table_name = 'tasks';
           $this->project_model->_table_name = 'projects';

           // your projects
           $projects_ids = $this->project_model->get_projects_ids_by_emp_user_id($this->user_info['id']);
           $projects_ids_coma = implode(',', $projects_ids );
           $projects = $this->project_model->get('status=0 AND id IN ('.$projects_ids_coma.')' );
           $data['projects'] = $projects;

           // waiting tasks
           $waiting_tasks = $this->task_model->get('user_id='.$this->user_info['id'] .' AND status=1 ','5','0',' created_at ASC ');
           $data['waiting_tasks'] = $waiting_tasks;

           // in progress tasks
           $progress_tasks = $this->task_model->get('user_id='.$this->user_info['id'] .' AND status=2 ');
           $data['progress_tasks'] = $progress_tasks;
       }

       $data['subview'] = $this->load->view(admin_dir().'/home/home', $data , TRUE);
       $this->load->view(admin_dir().'/layout_main', $data);
    }
}

