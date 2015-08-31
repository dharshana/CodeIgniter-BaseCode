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
class Migration_Parent_id_to_parent extends CI_Migration {

    public function up()
    {
        $fields = (array(
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0
            ),
        ));
        $this->dbforge->add_column('pages', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('pages', 'parent_id');
    }
}