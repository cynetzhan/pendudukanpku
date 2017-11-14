<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_keluhan extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'keluhan';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_keluhan' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'email_keluhan' => array(
            'type'       => 'VARCHAR',
            'constraint' => 40,
            'null'       => true,
        ),
        'id_kecamatan' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'isi_keluhan' => array(
            'type'       => 'TEXT',
            'null'       => false,
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id_keluhan', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}