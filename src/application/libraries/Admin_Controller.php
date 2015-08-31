<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Admin_Controller extends MY_Controller
{
    function __construct(){
        parent::__construct();
        $this->data['meta_title'] = 'OpenPHP';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_m');

        //login check
        $exception_urls = array(
            'admin/user/login',
            'admin/user/logout'
        );
        if(in_array(uri_string(), $exception_urls) == FALSE){ // if we are not in exception URLs do the check
            if($this->user_m->logged_in() == FALSE){
                redirect('admin/user/login');
            }
        }

    }
}
