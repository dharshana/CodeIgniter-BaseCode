<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <me@geewantha.com>
 * @copyright  2013 Dharshana Jayamaha
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class MY_Model extends CI_Model
{
    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public    $rules = array();
    protected $_timestamps = FALSE;

    function __construct()
    {
        parent::__construct();
    }

    public function array_from_post($fields)
    {
        $data = array();
        foreach($fields as $field)
        {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    /**
     * Purpose of the function is to return a specific record if '$id' is set which is the table primary key,
     * or return all records in specific table.
     * this function also used by the 'get_by' methods which will return single result as a row or
     * lines of result as a result set.
     *
     * @param  Integer  $id     ID of the table row which is looking for
     * @param  Boolean  $single construct to help get_by method, If 'TRUE' meaning return single row, ELSE return result set
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return row / all rows in the specific table
     */
    public function get($id = NULL, $single = NULL)
    {
    	if ($id != NULL)
        {
    		$filter = $this->_primary_filter;
    		$id = $filter($id);  // Added Security
    		$this->db->where($this->_primary_key, $id);
    		$method = 'row'; // single record
    	}
        elseif($single == TRUE)
        {
    		$method = 'row'; // single record
    	}
        else
        {
    		$method = 'result'; // all record
    	}

    	// if not order set in the out-side
    	if (!count($this->db->ar_orderby))
        {
    	    $this->db->order_by($this->_order_by); // order the result
    	} 
    	// return as row or result set according to value of $single
    	return $this->db->get($this->_table_name)->$method();
    }

    /**
     * Purpose of the function is to return a specific record/records based on the $where condition.
     * default $single value set to 'FALSE' so that function returns result set. when retrieving single
     * row data $single can be set to 'TRUE' which returns an ROW.
     *
     * @param  Integer  $where  Array() or content which mentioning the scope of filtering
     * @param  Boolean  $single construct to help get_by method, If 'TRUE' meaning return single row, ELSE return result set
     * @return row / all rows in the specific table
     */
    public function get_by($where, $single = FALSE)
    {
    	$this->db->where($where);
    	return $this->get(NULL, $single);
    }

    /**
     * Both 'SAVE' and 'INSERT' operations been handled from this function.
     * logic behind is, if $id is set then it will UPDATE and if '$id' set to NULL it will INSERT
     *
     * @param  STDobject  $data Array() of data.
     * @param  Integer    $id   Page ID
     * @return id value of the updated/inserted row
     */
    public function save($data, $id = NULL)
    {
    	//if timestamp is TRUE, set Timestamp
    	if($this->_timestamps == TRUE)
        {
    		$now = date('Y-m-d H:i:s');
    		$id || $data['created'] = $now; // if ID is set leave, else set $data['created'] = $now
    		$data['modified'] = $now;
    	}
        //insert
        if($id === NULL)
        {
        	!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id(); // fetch the ID of the newly inserted row
        }
        //update
        else
        {
        	$filter = $this->_primary_filter;
        	$id = $filter($id);
        	$this->db->set($data);
        	$this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
        return $id;
    }

    public function delete($id)
    {
    	$filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id)
        {
        	return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

}