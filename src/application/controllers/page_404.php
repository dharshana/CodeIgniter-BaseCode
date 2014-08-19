<?php
class Page_404 extends Frontend_Controller{

    public function __construct(){
        parent::__construct();

    }

    public function index(){
        $this->data['page_title'] = 'Page Not Found';
        $this->data['subview'] = 'front/404/index';
        $this->load->view('front/layout_common',$this->data);
    }
}