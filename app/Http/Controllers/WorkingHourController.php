<?php

namespace App\Http\Controllers;

use App\Services\WorkingHourService;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    public function store(Request $request, WorkingHourService $working)
    {
        $data = $request->all();
        $create = $working->createWorkingHour($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(WorkingHourService $working)
    {
        $show = $working->getAllWorkingHours();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, WorkingHourService $working)
    {
        $idshow = $working->getWorkingHourById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, WorkingHourService $working)
    {
        $data = $request->all();
        $update = $working->updateWorkingHour($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, WorkingHourService $working)
    {
        $delete = $working->deleteWorkingHour($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
