<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_kecamatan_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Kecamatan.Content.View',
			'description' => 'View Kecamatan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Content.Create',
			'description' => 'Create Kecamatan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Content.Edit',
			'description' => 'Edit Kecamatan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Content.Delete',
			'description' => 'Delete Kecamatan Content',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Reports.View',
			'description' => 'View Kecamatan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Reports.Create',
			'description' => 'Create Kecamatan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Reports.Edit',
			'description' => 'Edit Kecamatan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Reports.Delete',
			'description' => 'Delete Kecamatan Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Settings.View',
			'description' => 'View Kecamatan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Settings.Create',
			'description' => 'Create Kecamatan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Settings.Edit',
			'description' => 'Edit Kecamatan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Settings.Delete',
			'description' => 'Delete Kecamatan Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Developer.View',
			'description' => 'View Kecamatan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Developer.Create',
			'description' => 'Create Kecamatan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Developer.Edit',
			'description' => 'Edit Kecamatan Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Kecamatan.Developer.Delete',
			'description' => 'Delete Kecamatan Developer',
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