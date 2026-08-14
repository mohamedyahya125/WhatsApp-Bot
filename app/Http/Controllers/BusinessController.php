<?php

namespace App\Http\Controllers;

use App\Services\BusinessService;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function store(Request $request, BusinessService $business)
    {
        $data = $request->all();
        $create = $business->createBusiness($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(BusinessService $business)
    {
        $show = $business->getAllBusinesses();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, BusinessService $business)
    {
        $idshow = $business->getBusinessById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, BusinessService $business)
    {
        $data = $request->all();
        $update = $business->updateBusiness($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, BusinessService $business)
    {
        $delete = $business->deleteBusiness($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
