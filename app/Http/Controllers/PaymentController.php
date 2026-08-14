<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, PaymentService $payment)
    {
        $data = $request->all();
        $create = $payment->createPayment($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(PaymentService $payment)
    {
        $show = $payment->getAllPayments();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, PaymentService $payment)
    {
        $idshow = $payment->getPaymentById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, PaymentService $payment)
    {
        $data = $request->all();
        $update = $payment->updatePayment($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, PaymentService $payment)
    {
        $delete = $payment->deletePayment($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
    public function processPayment(Request $request, PaymentService $payment)
    {
        $booking = $request->input('booking_id');
        $amount = $request->input('amount');
        $result = $payment->processPaymentForBooking($booking, $amount);
        return response()->json([
            'result' => $result
        ]);
    }
}
