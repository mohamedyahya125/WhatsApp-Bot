<?php

namespace App\Http\Controllers;

use App\Services\UnavailableSlotService;
use Illuminate\Http\Request;

class UnavailableSlotController extends Controller
{
    public function store(Request $request, UnavailableSlotService $unavailable)
    {
        $data = $request->all();
        $create = $unavailable->createUnavailableSlot($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(UnavailableSlotService $unavailable)
    {
        $show = $unavailable->getAllUnavailableSlots();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, UnavailableSlotService $unavailable)
    {
        $idshow = $unavailable->getUnavailableSlotById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, UnavailableSlotService $unavailable)
    {
        $data = $request->all();
        $update = $unavailable->updateUnavailableSlot($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, UnavailableSlotService $unavailable)
    {
        $delete = $unavailable->deleteUnavailableSlot($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
