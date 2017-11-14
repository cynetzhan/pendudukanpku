<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_keluhan_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Keluhan.Content.View',
			'description' => 'View Keluhan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Content.Create',
			'description' => 'Create Keluhan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Content.Edit',
			'description' => 'Edit Keluhan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Content.Delete',
			'description' => 'Delete Keluhan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Reports.View',
			'description' => 'View Keluhan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Reports.Create',
			'description' => 'Create Keluhan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Reports.Edit',
			'description' => 'Edit Keluhan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Reports.Delete',
			'description' => 'Delete Keluhan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Settings.View',
			'description' => 'View Keluhan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Settings.Create',
			'description' => 'Create Keluhan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Settings.Edit',
			'description' => 'Edit Keluhan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Settings.Delete',
			'description' => 'Delete Keluhan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Developer.View',
			'description' => 'View Keluhan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Developer.Create',
			'description' => 'Create Keluhan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Developer.Edit',
			'description' => 'Edit Keluhan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Keluhan.Developer.Delete',
			'description' => 'Delete Keluhan Developer',
			'status' => 'active',
		),
    );

    /**
     * @var string The name of the permission key in the role_permissions table
     */
    private $permissionKey = 'permission_id';

    /**
     * @var string The name of the permission name field in the permissions table
     */
    private $permissionNameField = 'name';

	/**
	 * @var string The name of the role/permissions ref table
	 */
	private $rolePermissionsTable = 'role_permissions';

    /**
     * @var numeric The role id to which the permissions will be applied
     */
    private $roleId = '1';

    /**
     * @var string The name of the role key in the role_permissions table
     */
    private $roleKey = 'role_id';

	/**
	 * @var string The name of the permissions table
	 */
	private $tableName = 'permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$rolePermissionsData = array();
		foreach ($this->permissionValues as $permissionValue) {
			$this->db->insert($this->tableName, $permissionValue);

			$rolePermissionsData[] = array(
                $this->roleKey       => $this->roleId,
                $this->permissionKey => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->rolePermissionsTable, $rolePermissionsData);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
        $permissionNames = array();
		foreach ($this->permissionValues as $permissionValue) {
            $permissionNames[] = $permissionValue[$this->permissionNameField];
        }

        $query = $this->db->select($this->permissionKey)
                          ->where_in($this->permissionNameField, $permissionNames)
                          ->get($this->tableName);

        if ( ! $query->num_rows()) {
            return;
        }

        $permissionIds = array();
        foreach ($query->result() as $row) {
            $permissionIds[] = $row->{$this->permissionKey};
        }

        $this->db->where_in($this->permissionKey, $permissionIds)
                 ->delete($this->rolePermissionsTable);

        $this->db->where_in($this->permissionNameField, $permissionNames)
                 ->delete($this->tableName);
	}
}