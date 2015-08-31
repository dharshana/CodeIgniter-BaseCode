<?php
/**
 * Download Controller
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Download extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('download_m');
        $this->load->model('download_type_m');
        $this->load->library('pagination');
    }

    public function index(){

        $this->data['download_type_list'] = $this->download_type_m->dropdown_list('download_type','Please Select',array('enable'=>'1'),0);
        
        $config['base_url'] = base_url('admin/download/index/');
        //$config['total_rows'] = sizeof($this->event_m->get_by(/*$query*/));
        $config['total_rows'] = sizeof($this->download_m->get());
        $config['per_page'] = 20;
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        // catch page number
        $pageNumber = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['downloadLists'] = $this->download_m->pagination($config['per_page'], $pageNumber/*, $query*/);
        $this->data['paginationLinks'] = $this->pagination->create_links();

        // load view
        $this->data['subview'] = 'admin/download/index';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function search()
    {
        //        $branch_id = $this->input->post('branch_name');
        //        ($branch_id=='')?$branch_id=$this->input->get('branch_name'):'';
        //        $enable = $this->input->post('enable');
        //        ($enable=='')?$enable=$this->input->get('enable'):'';

        $download_type = isset($_REQUEST['download_type'])?$_REQUEST['download_type']:'';

        
        //$this->data['branch_list'] = $this->branch_m->dropdown_list('branch_name');
        $this->data['download_type_list'] = $this->download_type_m->dropdown_list('download_type','Please Select',array('enable'=>'1'),0);


        $query = array(
            'download_type_id'=>$download_type
        );

         
        $config['base_url'] = base_url('admin/download/search/');
        $config['total_rows'] = empty($download_type)?sizeof($this->download_m->get()):sizeof($this->download_m->get_by($query));
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $config['suffix'] = '?download_type='.$download_type;

        $this->pagination->initialize($config);

        // catch page number
        $pageNumber = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->data['downloadLists'] = empty($download_type)?$this->download_m->pagination($config['per_page'], $pageNumber):$this->download_m->pagination($config['per_page'], $pageNumber, $query,'desc');
        $this->data['paginationLinks'] = $this->pagination->create_links();

        //print_r($this->data['student']);

        $this->data['subview'] = 'admin/download/index';
        $this->load->view('admin/_layout_main',$this->data);
    }



    public function edit($id = NULL){

        // Fetch a page or set a new one
        //$id == NULL || ($this->data['user'] = $this->user_m->get($id));
        //$this->data['event_type_list'] = $this->event_type_m->dropdown_list('type_name');
        // $this->data['download_types'] = $this->download_type_m->dropdown_list('download_type');

        if($id){
            $this->data['download'] = $this->download_m->get($id);

            count($this->data['download']) || ($this->data['error'][] = 'Gallery could not be found');
        }
        else{
            $this->data['download'] = $this->download_m->get_new();
        }

        // Set up the form and rules
        $rules = $this->download_m->rules;  //loading admin rules from user_m model
        // $id || $rules['password'] .= '|required'; //assiume $id is set, if not password is required. (new user or existing user)
        $this->form_validation->set_rules($rules);

        // process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->download_m->array_from_post(array('title','download_type_id','enable','path'));

            $this->download_m->save($data,$id);
            //redirect('admin/download');
            ($id)?redirect('admin/download?updated=true'):redirect('admin/download?inserted=true');

            // EOF file upload
        }

        // Load the view
        $this->data['subview'] = 'admin/download/edit';
        $this->load->view('admin/_layout_main',$this->data);
    }

    public function delete($id)
    {
        $this->download_m->delete($id);
        redirect('admin/download?deleted=true');
    }


    /*
    * Ajax file uploader 
    * upload image and video and audio, uniquly identify the type 
    * and manage folder path 
    */
    public function do_upload()
    {
        $upload_data = $_FILES['fileupload']['type'];
        // identify the file type
        // if download type is music and uploded file type is mp3
        if($upload_data == 'audio/mp3'){ 
            $download_type_id = '1';
            $upload_path = './uploads/download/audio';
            $allowed_types = 'mp3';
            $max_size = '10000';

        }
        // if download type is vedio and vedio is uploaded
        else if(($upload_data == 'video/mp4')){
            $download_type_id = '2';
            $upload_path = './uploads/download/video';
            $allowed_types = 'mp4|wmv';
            $max_size = '10000000';
            
        }
        // if download type is image and image uploaded
        else if(($upload_data == 'image/jpeg' || $upload_data == 'image/gif' || $upload_data == 'image/png')){
            $download_type_id = '3';
            $upload_path            = './uploads/download/image';
            $allowed_types          = 'gif|jpg|png';
            $max_size               = '0';
        }
        // other file type 
        else
        {
            // return json object 
            echo json_encode(array('status'=>'error','ci_error' => 'This file type not allowed'));
            exit();
        }
        // set configurations
        $config['upload_path']      = $upload_path;
        $config['allowed_types']    = $allowed_types;
        $config['max_size']         = $max_size;
        $config['max_width']        = '0';
        $config['max_height']       = '0';


        $this->load->library('upload', $config);

        // error while upload
        if (!$this->upload->do_upload('fileupload'))
        {  
            // return json object
            echo json_encode(array('status'=>'error','ci_error' => $this->upload->display_errors()));
            exit();

        }
        else
        {
            $data = array('upload_data' => $this->upload->data()); 
            
            // concatenate file type with file name
            $datapath = explode('/',$data['upload_data']['file_path']); 
            $fileName = ($datapath[9].'/'.$data['upload_data']['file_name']);
            // return json object
            echo json_encode(array('status'=>'success','file_name'=>$fileName,'download_type_id'=>$download_type_id));
            exit();
        }
    }

}

?>