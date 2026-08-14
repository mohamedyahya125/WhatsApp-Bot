<?php

namespace App\Http\Controllers;

use App\Services\WhatsappCustomerService;
use Illuminate\Http\Request;

class WhatsappCustomerController extends Controller
{
    public function store(Request $request, WhatsappCustomerService $whatsapp)
    {
        $data = $request->all();
        $create = $whatsapp->createWhatsappCustomer($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(WhatsappCustomerService $whatsapp)
    {
        $show = $whatsapp->getAllWhatsappCustomers();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, WhatsappCustomerService $whatsapp)
    {
        $idshow = $whatsapp->getWhatsappCustomerById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, WhatsappCustomerService $whatsapp)
    {
        $data = $request->all();
        $update = $whatsapp->updateWhatsappCustomer($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, WhatsappCustomerService $whatsapp)
    {
        $delete = $whatsapp->deleteWhatsappCustomer($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
