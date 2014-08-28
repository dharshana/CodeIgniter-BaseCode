<?php
/**
 * Page Controller
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <me@geewantha.com>
 * @copyright  2014 Dharshana Jayamaha
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Page extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('page_m');
    }

    public function index()
    {
        var_dump($this->page_m->get(1));
    }

    public function save(){
        $data = array(
            'order' => '3',
        );
        $id = $this->page_m->save($data,3);
        var_dump($id);
    }
}