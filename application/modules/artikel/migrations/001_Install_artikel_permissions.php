<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_artikel_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Artikel.Content.View',
			'description' => 'View Artikel Content',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Content.Create',
			'description' => 'Create Artikel Content',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Content.Edit',
			'description' => 'Edit Artikel Content',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Content.Delete',
			'description' => 'Delete Artikel Content',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Reports.View',
			'description' => 'View Artikel Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Reports.Create',
			'description' => 'Create Artikel Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Reports.Edit',
			'description' => 'Edit Artikel Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Reports.Delete',
			'description' => 'Delete Artikel Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Settings.View',
			'description' => 'View Artikel Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Settings.Create',
			'description' => 'Create Artikel Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Settings.Edit',
			'description' => 'Edit Artikel Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Settings.Delete',
			'description' => 'Delete Artikel Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Developer.View',
			'description' => 'View Artikel Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Developer.Create',
			'description' => 'Create Artikel Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Developer.Edit',
			'description' => 'Edit Artikel Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Artikel.Developer.Delete',
			'description' => 'Delete Artikel Developer',
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