<?php

namespace App\Services;

use App\Models\Service;

class ServiceService
{
    public function createService($data)
    {
        $service = Service::create($data);
        return $service;
    }
    public function getAllServices()
    {

        return Service::paginate(10);
    }
    public function getServiceById($id)
    {
        $show = Service::find($id);
        return $show;
    }
    public function updateService($id, $data)
    {
        $update = Service::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteService($id)
    {
        $delete = Service::find($id);
        $delete->delete();
        return true;
    }
}
