<?php

namespace App\Services;

use App\Models\WorkingHour;

class WorkingHourService
{
    public function createWorkingHour($data)
    {
        $workingHour = WorkingHour::create($data);
        return $workingHour;
    }
    public function getAllWorkingHours()
    {

        return WorkingHour::paginate(10);
    }
    public function getWorkingHourById($id)
    {
        $show = WorkingHour::find($id);
        return $show;
    }
    public function updateWorkingHour($id, $data)
    {
        $update = WorkingHour::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteWorkingHour($id)
    {
        $delete = WorkingHour::find($id);
        $delete->delete();
        return true;
    }
}
