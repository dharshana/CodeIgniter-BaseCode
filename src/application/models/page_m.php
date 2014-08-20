<?php
/**
 * Page Model
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <me@geewantha.com>
 * @copyright  2014 Dharshana Jayamaha
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
    protected $_order_by = 'order';
    public    $rules = array();
    protected $_timestamps = FALSE;


}