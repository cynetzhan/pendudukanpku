<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_artikel extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'artikel';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id_artikel' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'judul_artikel' => array(
            'type'       => 'VARCHAR',
            'constraint' => 35,
            'null'       => false,
        ),
        'tgl_terbit_artikel' => array(
            'type'       => 'DATE',
            'null'       => true,
            'default'    => '0000-00-00',
        ),
        'isi_artikel' => array(
            'type'       => 'TEXT',
            'null'       => true,
        ),
        'kategori_artikel' => array(
            'type'       => 'VARCHAR',
            'constraint' => 15,
            'null'       => true,
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
		$this->dbforge->add_key('id_artikel', true);
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