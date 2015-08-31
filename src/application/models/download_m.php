<?php
/**
 * Option Model
 *
 * @author     Eranga Athapaththu <eranga@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Download_m extends MY_Model
{
    protected $_table_name = 'download';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    public    $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[250]|xss_clean'
        ),
        'download_type_id' => array(
            'field' => 'download_type_id',
            'label' => 'Download Type',
            'rules' => 'trim|required|max_length[10]|xss_clean'
        ),
        'enable' => array(
            'field' => 'enable',
            'label' => 'Status',
            'rules' => 'trim|required|max_length[3]'
        ),       
        'path' => array(
            'field' => 'path',
            'label' => 'Path',
            'rules' => 'trim|required|max_length[65000]'
        ),       
    );


    function __construct(){
        parent::__construct();
    }

    public function get_new(){
        $download = new stdClass();
        $download->title = '';
        $download->download_type_id = '';
        $download->path = '';
        $download->enable = '';
        return $download;
    }
}