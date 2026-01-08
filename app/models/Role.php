<?php

class Role extends Model
{
    protected $table = 'roles';

    public function getPermissions($roleId)
    {
        $sql = "SELECT p.* FROM permissions p
                INNER JOIN role_permissions rp ON p.id = rp.permission_id
                WHERE rp.role_id = ?";
        return parent::query($sql, [$roleId]);
    }

    public function hasPermission($roleId, $permissionName)
    {
        $sql = "SELECT COUNT(*) as count FROM permissions p
                INNER JOIN role_permissions rp ON p.id = rp.permission_id
                WHERE rp.role_id = ? AND p.name = ?";
        $result = parent::query($sql, [$roleId, $permissionName]);
        return $result[0]['count'] > 0;
    }

    public function assignPermission($roleId, $permissionId)
    {
        $sql = "INSERT IGNORE INTO role_permissions (role_id, permission_id) VALUES (?, ?)";
        return parent::execute($sql, [$roleId, $permissionId]);
    }

    public function removePermission($roleId, $permissionId)
    {
        $sql = "DELETE FROM role_permissions WHERE role_id = ? AND permission_id = ?";
        return parent::execute($sql, [$roleId, $permissionId]);
    }
}
