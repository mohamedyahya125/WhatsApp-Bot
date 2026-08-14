<?php

namespace App\Services;

use App\Models\Business;

class BusinessService
{
    public function createBusiness($data)
    {
        $business = Business::create($data);
        return $business;
    }
    public function getAllBusinesses()
    {

        return Business::paginate(10);
    }
    public function getBusinessById($id)
    {
        $show = Business::find($id);
        return $show;
    }
    public function updateBusiness($id, $data)
    {
        $update = Business::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteBusiness($id)
    {
        $delete = Business::find($id);
        $delete->delete();
        return true;
    }
}
