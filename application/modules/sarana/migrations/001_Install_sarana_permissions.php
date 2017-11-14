<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_sarana_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Sarana.Content.View',
			'description' => 'View Sarana Content',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Content.Create',
			'description' => 'Create Sarana Content',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Content.Edit',
			'description' => 'Edit Sarana Content',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Content.Delete',
			'description' => 'Delete Sarana Content',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Reports.View',
			'description' => 'View Sarana Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Reports.Create',
			'description' => 'Create Sarana Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Reports.Edit',
			'description' => 'Edit Sarana Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Reports.Delete',
			'description' => 'Delete Sarana Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Settings.View',
			'description' => 'View Sarana Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Settings.Create',
			'description' => 'Create Sarana Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Settings.Edit',
			'description' => 'Edit Sarana Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Settings.Delete',
			'description' => 'Delete Sarana Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Developer.View',
			'description' => 'View Sarana Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Developer.Create',
			'description' => 'Create Sarana Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Developer.Edit',
			'description' => 'Edit Sarana Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Sarana.Developer.Delete',
			'description' => 'Delete Sarana Developer',
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