<?php


namespace Modules\AdminRbac\Services;


use Modules\AdminRbac\Models\AdminGroup;

class CreateGroupService
{
    /**
     * @param array $data
     * @return object|bool
     */
    public function handle(array $data)
    {
        try {
            AdminGroup::create($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
