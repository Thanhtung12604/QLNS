<?php

/**
 * Position Model - Quản lý chức danh
 */
class Position extends Model
{
    protected $table = 'chuc_danh';

    /**
     * Lấy tất cả chức danh
     */
    public function getAll($orderBy = 'ten_chuc_danh ASC')
    {
        return parent::getAll($orderBy);
    }
}
