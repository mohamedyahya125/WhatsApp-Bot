<?php

namespace App\Services;

use App\Models\UnavailableSlot;

class UnavailableSlotService
{
    public function createUnavailableSlot($data)
    {
        $unavailableSlot = UnavailableSlot::create($data);
        return $unavailableSlot;
    }
    public function getAllUnavailableSlots()
    {

        return UnavailableSlot::paginate(10);
    }
    public function getUnavailableSlotById($id)
    {
        $show = UnavailableSlot::find($id);
        return $show;
    }
    public function updateUnavailableSlot($id, $data)
    {
        $update = UnavailableSlot::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteUnavailableSlot($id)
    {
        $delete = UnavailableSlot::find($id);
        $delete->delete();
        return true;
    }
}
