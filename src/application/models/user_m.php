<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Dharshana
 * Date: 6/1/13
 * Time: 6:04 PM
 * To change this template use File | Settings | File Templates.
 */
class User_m  extends MY_Model
{
    protected $_table_name = 'users';
    protected $_order_by = 'name';
    public    $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|required'
        ),
    );
    public    $rules_admin = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
        ),
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'trim|matches[password_confirm]'
        ),
        'password_confirm' => array(
            'field' => 'password_confirm',
            'label' => 'confirm_password',
            'rules' => 'trim|matches[password]'
        ),
    );

    function __construct(){
        parent::__construct();
    }

    public function login(){
        //echo 'login model';
        $user = $this->get_by(array(
            'email' => $this->input->post('email'),
            //'password' => $this->hash($this->input->post('password')),
            'password' => $this->hash($this->input->post('password')),
        ), TRUE); // true, because we want's single use object NOT array of objects

        //print_r($user);
        if(count($user)){
            //echo 'user counted';
            // log in user
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
        }
        else{
            //echo 'user not counted';
            //return FALSE;
        }
    }
    public function logout(){
        $this->session->sess_destroy();
    }

    public function logged_in(){
        return (bool) $this->session->userdata('loggedin');
    }

    public function get_new(){
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->password = '';
        return $user;
    }

    public function hash($string){
        return hash('sha512', $string.config_item('encryption_key'));
        //return hash('sha1', $string.config_item('encryption_key'));
        //return $string;
    }

}
