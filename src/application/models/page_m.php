<?php
/**
 * Page Model
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Page_m extends MY_Model
{
    protected $_table_name = 'pages';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'order_column';
    public    $rules = array(
        'parent_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent page',
            'rules' => 'trim|intval'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
        ),

        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ),
    );
    protected $_timestamps = TRUE;

    function __construct(){
        parent::__construct();
    }

    public function get_new(){
        $page = new stdClass();
        $page->title = '';
        $page->slug = '';
        $page->order = '';
        $page->body = '';
        $page->meta_keywords = '';
        $page->meta_description = '';
        $page->created = '';
        $page->modified = '';
        $page->parent_id = '0';
        return $page;
    }
}