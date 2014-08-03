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

class Migration_Create_Sessions extends CI_Migration {

    public function up()
    {
        $fields = array(
            'session_id VARCHAR(40) DEFAULT \'0\' NOT NULL',
            'ip_address VARCHAR(44) DEFAULT \'0\' NOT NULL',
            'user_agent VARCHAR(120) DEFAULT \'0\' NOT NULL',
            'last_activity INT(10) unsigned DEFAULT 0 NOT NULL',
            'user_data text NOT NULL'
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('session_id', TRUE);
        $this->dbforge->create_table('ci_sessions');
    }

    public function down()
    {
        $this->dbforge->drop_table('ci_sessions');
    }
}