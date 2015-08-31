<?php
/**
 * Recipe Controller
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <eranga@openarc.lk>
 * @copyright  2014 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Recipe extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('recipe_m');
    }

    public function index(){

//        $config['base_url'] = base_url('admin/recipe/index/');
//        $config['total_rows'] = sizeof($this->recipe_m->get());
//        $config['per_page'] = 2;
//        $config["uri_segment"] = 4;
//
//        $this->pagination->initialize($config);

        // catch page number
//        $pageNumber = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['recipes'] = $this->recipe_m->get();
//        $this->data['recipes'] = $this->recipe_m->pagination($config['per_page'], $pageNumber);
//        $this->data['paginationLinks'] = $this->pagination->create_links();

        // load view
        $this->data['subview'] = 'admin/recipe/index';
        //print_r($this->data['event_types'] );exit();
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function edit($id = NULL){

        // Fetch a event_types or set a new one
        // $id == NULL || ($this->data['user'] = $this->user_m->get($id));
        if($id){
            $recipes_images = $this->data['recipes'] = $this->recipe_m->get($id);
            count($this->data['recipes']) || redirect('admin/recipe');
        }
        else{
            $this->data['recipes'] = $this->recipe_m->get_new();
        }
        /*$this->data['recepiTypes'] = $this->recipe_type_m->dropdown_list('recipe_type','Select Type',array(
        'status' => '1'
        ));*/

        // Set up the form and rules
        $rules = $this->recipe_m->rules;  // loading admin rules from user_m model
        // $id || $rules['password'] .= '|required'; //assiume $id is set, if not password is required. (new user or existing user)
        $this->form_validation->set_rules($rules);

        // process the form
        if($this->form_validation->run() == TRUE){
            //$data = $this->recipe_m->array_from_post(array('recipe_type','recipe_vedio','recipe_title','recipe_description','status'));
            $data = $this->recipe_m->array_from_post(array('recipe_title','status','recipe_image'));
            //$data['password'] = $this->user_m->hash($data['password']);


            // if a new record order will be added
            if($id == NULL){
                $newRecipeOrder = $this->recipe_m->get_max('order_column',null)->order_column;

                $data['order_column'] = $newRecipeOrder + 1;
            }


            //save data
            $this->recipe_m->save($data,$id);
            ($id)?redirect('admin/recipe?updated=true'):redirect('admin/recipe?inserted=true');
            // EOF file upload

           
        }

        // Load the view
        $this->data['subview'] = 'admin/recipe/edit';
        $this->load->view('admin/_layout_main',$this->data);
    }

/*    public function view($id = NULL){
        
        if ($id){
            $this->data['recipes']  =   $this->recipe_m->get($id);
            // $this->data['exam_types'] = $this->exam_type_m->get($this->data['exam']->exam_type_id);
            //   $this->data['exam_status'] = $this->exam_status_m->get($this->data['exam']->status);
            //   $this->data['student_course'] = $this->course_m->get($this->data['exam']->stu_course_id);
            
            count($this->data['recipes']) || redirect('admin/recipe');
            
        }
        else
        {
            redirect('admin/recipe/edit/');
        }
        $this->data['subview'] = 'admin/recipe/view';
        $this->load->view('admin/_layout_main',$this->data);
    }

*/
    public function delete($id)
    {
        $this->recipe_m->delete($id);
        redirect('admin/recipe?deleted=true');
    }

    function do_upload()
    {
        
        $config['upload_path'] = './uploads/recipes/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '600';
        $config['max_width']  = '160';
        $config['max_height']  = '110';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('fileupload'))
        {  
            echo json_encode(array('status'=>'error','ci_error' => $this->upload->display_errors()));

        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            echo json_encode(array('status'=>'success','image_name'=>$data['upload_data']['client_name']));
        }
    }
    
}