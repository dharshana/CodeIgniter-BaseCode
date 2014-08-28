<?php
/**
 * 404 Controller
 *
 * when 404 error occers, will redirect to this controller..
 * @author     Dharshana Jayamaha <me@geewantha.com>
 * @copyright  2014 Dharshana Jayamaha
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

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