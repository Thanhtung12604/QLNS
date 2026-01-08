<?php

class Permission extends Model
{
    protected $table = 'permissions';

    public function getByModule($module)
    {
        $sql = "SELECT * FROM {$this->table} WHERE module = ? ORDER BY name";
        return $this->db->query($sql, [$module]);
    }

    public function getAllGroupedByModule()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY module, name";
        $permissions = $this->db->query($sql);

        $grouped = [];
        foreach ($permissions as $permission) {
            $grouped[$permission['module']][] = $permission;
        }
        return $grouped;
    }
}
