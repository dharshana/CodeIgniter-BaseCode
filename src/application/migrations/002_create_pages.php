<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 * @author     Dharshana Jayamaha <me@geewantha.com>
 * @copyright  2014 Dharshana Jayamaha
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class Migration_Create_Pages extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
            'meta_keywords' => array(
                'type' => 'TEXT',
            ),
            'meta_description' => array(
                'type' => 'TEXT',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);

        $this->dbforge->create_table('pages');
    }

    public function down()
    {
        $this->dbforge->drop_table('pages');
    }
}