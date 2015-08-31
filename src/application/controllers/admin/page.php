<?php
/**
 * Page Controller
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Page extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('page_m');
        $this->load->library('pagination');
    }

    public function index(){
        //fetch all pages from database
        $this->data['pages'] = $this->page_m->get($id = NULL, $single = NULL, $AsOrder = "asc", $limit= NULL);

        //
        // Pagination  : Getting All records with paginations
        //
        $config['base_url'] = base_url('admin/page/index/');
        $config['total_rows'] = sizeof($this->page_m->get());
        $config['per_page'] = 50;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        // catch page number
        $pageNumber = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['pages'] = $this->page_m->pagination($config['per_page'], $pageNumber);
        $this->data['paginationLinks'] = $this->pagination->create_links();

        //
        // Pagination with WHERE condition
        //
//        $query = array(
//            'parent_id'=>'5',
//        );
//        $config['base_url'] = base_url('admin/page/index/');
//        $config['total_rows'] = sizeof($this->page_m->get_by($query));
//        $config['per_page'] = 10;
//        $config["uri_segment"] = 4;
//
//        $this->pagination->initialize($config);
//
//        // catch page number
//        $pageNumber = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
//
//        $this->data['pages'] = $this->page_m->pagination($config['per_page'], $pageNumber, $query);
//        $this->data['paginationLinks'] = $this->pagination->create_links();

        // load view
        $this->data['subview'] = 'admin/page/index';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function edit($id = NULL){

        // Fetch a page or set a new one
        //$id == NULL || ($this->data['user'] = $this->user_m->get($id));
        $this->data['pages_no_parents'] = $this->page_m->dropdown_list('title','No Parent',array(
            'parent_id' => 0,
        ));
        if($id){
            $this->data['page'] = $this->page_m->get($id);

            count($this->data['page']) || ($this->data['error'][] = 'page could not be found');
        }
        else{
            $this->data['page'] = $this->page_m->get_new();
        }

        // Set up the form and rules
        $rules = $this->page_m->rules;  //loading admin rules from user_m model
        // $id || $rules['password'] .= '|required'; //assiume $id is set, if not password is required. (new user or existing user)
        $this->form_validation->set_rules($rules);

        // process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->page_m->array_from_post(array('parent_id','title','slug','order','body','meta_keywords','meta_description'));
            //$data['password'] = $this->user_m->hash($data['password']);
            $this->page_m->save($data,$id);
            redirect('admin/page');
        }

        // Load the view
        $this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function delete($id){
        $this->page_m->delete($id);


        redirect('admin/page');
    }


    public function _unique_slug($str)
    {
        //Do NOT validate if slug already exists
        // UNLESS it's the slug for the current user

        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id != ', $id);

        $user = $this->page_m->get();
        //echo $this->input->post('email');
        //should look for email but not for the current user. assiume don't have $id, if does add wehre statement do not include current user $id.

        if(count($user)){
            $this->form_validation->set_message('_unique_slug','%s should be unique');
            return FALSE;
        }
        return TRUE;
    }
}