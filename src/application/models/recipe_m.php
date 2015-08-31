<?php
/**
 * Recipe Model
 *
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */

class Recipe_m extends MY_Model
{
    protected $_table_name = 'recipe';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'order_column';
    protected $_timestamps = TRUE;
    public    $rules = array(
        'recipe_title' => array(
            'field' => 'recipe_title',
            'label' => 'Recipe Title',
            'rules' => 'trim|required|max_length[50]|xss_clean'
        ),
        'status' => array(
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required|max_length[3]'
        ),
        'recipe_image' => array(
            'field' => 'recipe_image',
            'label' => 'Recipe Image',
            'rules' => 'trim|max_length[65000]'
        ),

    );

    function __construct(){
        parent::__construct();
    }

    public function get_new(){
        $recipe = new stdClass();
        $recipe->recipe_title = '';
        $recipe->recipe_image = '';
        $recipe->status = '';
        return $recipe;
    }
}