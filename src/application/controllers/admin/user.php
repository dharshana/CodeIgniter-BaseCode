<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dharshana
 * Date: 6/1/13
 * Time: 5:36 PM
 * To change this template use File | Settings | File Templates.
 */
class User extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        //fetch all users from database
        $this->data['users'] = $this->user_m->get();

        // load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function edit($id = NULL){

        // Fetch a user or set a new one
        //$id == NULL || ($this->data['user'] = $this->user_m->get($id));
        if($id){
            $this->data['user'] = $this->user_m->get($id);
            count($this->data['user']) || $this->data['error'][] = 'User could not be found';
        }
        else{
            $this->data['user'] = $this->user_m->get_new();
        }

        // Set up the form and rules
        $rules = $this->user_m->rules_admin;  //loading admin rules from user_m model
        $id || $rules['password'] .= '|required'; //assiume $id is set, if not password is required. (new user or existing user)
        $this->form_validation->set_rules($rules);

        // process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->user_m->array_from_post(array('name','email','password'));
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data,$id);
            redirect('admin/user');
        }

        // Load the view
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function delete($id){
        $this->user_m->delete($id);
        redirect('admin/user'); // Redirecting to users list view
    }

    public function login(){

        // Redirect a user if he's already loggedin
        $dashboard = 'admin/dashboard';
        $this->user_m->logged_in() == FALSE || redirect($dashboard);

        // set form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);

        // process form
        if($this->form_validation->run() == TRUE){
            // can login and redirect it..
            if($this->user_m->login() == TRUE){
                redirect($dashboard);
            }
            else{
                $this->session->set_flashdata('error','That email/password combination does not exist');
                redirect('admin/user/login','refresh');
            }
        }

        // load the view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_modal',$this->data);
    }

    public function logout(){
        $this->user_m->logout();
        redirect('admin/user/login');
    }

    public function _unique_email($str)
    {
        // Do NOT validate if email already exists
        // UNLESS it's the email for the current user

        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id != ', $id);

        $user = $this->user_m->get();
        //echo $this->input->post('email');
        //should look for email but not for the current user. assiume don't have $id, if does add wehre statement do not include current user $id.

        if(count($user)){
            $this->form_validation->set_message('_unique_email','%s should be unique');
            return FALSE;
        }
        return TRUE;
    }
}
