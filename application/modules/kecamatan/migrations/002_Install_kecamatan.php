<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_kecamatan extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'kecamatan';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_kecamatan' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'nama_kecamatan' => array(
            'type'       => 'VARCHAR',
            'constraint' => 25,
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
		$this->dbforge->add_key('id_kecamatan', true);
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