<?php
/**
 * Download Type Model
 *
 * @author     Eranga Athapaththu <eranga@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Download_type_m extends MY_Model
{
    protected $_table_name = 'download_type';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    public    $rules = array(
        'download_type' => array(
            'field' => 'download_type',
            'label' => 'Download Type',
            'rules' => 'trim|required|max_length[50]|xss_clean'
        ),
        'enable' => array(
            'field' => 'enable',
            'label' => 'Status',
            'rules' => 'trim|required|xss_clean'
        ),       
    );


    function __construct(){
        parent::__construct();
    }

    public function get_new(){
        $download_type = new stdClass();
        $download_type->download_type = '';
        $download_type->enable = '';
        return $download_type;
    }
}