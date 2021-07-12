<?php


namespace Modules\AdminRbac\Services;


use Modules\AdminRbac\Models\AdminGroup;

class UpdateGroupService
{
    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function handle(array $data, int $id)
    {
        try {
            AdminGroup::find($id)->update($data);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
