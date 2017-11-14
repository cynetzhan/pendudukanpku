<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_sarana extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'sarana';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_sarana' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'id_kecamatan' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'krit1_sarana' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'krit2_sarana' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'krit3_sarana' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'krit4_sarana' => array(
            'type'       => 'INT',
            'constraint' => 11,
            'null'       => false,
        ),
        'krit5_sarana' => array(
            'type'       => 'INT',
            'constraint' => 11,
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
		$this->dbforge->add_key('id_sarana', true);
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