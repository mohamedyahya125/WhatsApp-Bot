<?php

namespace App\Http\Controllers;

use App\Services\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request, ServiceService $service)
    {
        $data = $request->all();
        $create = $service->createService($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(ServiceService $service)
    {
        $show = $service->getAllServices();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, ServiceService $service)
    {
        $idshow = $service->getServiceById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, ServiceService $service)
    {
        $data = $request->all();
        $update = $service->updateService($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, ServiceService $service)
    {
        $delete = $service->deleteService($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
