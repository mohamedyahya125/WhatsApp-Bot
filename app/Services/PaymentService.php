<?php

namespace App\Services;

use App\Models\Payment;

class PaymentService
{
    public function createPayment($data)
    {
        $payment = Payment::create($data);
        return $payment;
    }
    public function getAllPayments()
    {

        return Payment::paginate(10);
    }
    public function getPaymentById($id)
    {
        $show = Payment::find($id);
        return $show;
    }
    public function updatePayment($id, $data)
    {
        $update = Payment::find($id);
        $update->update($data);
        return $update;
    }
    public function deletePayment($id)
    {
        $delete = Payment::find($id);
        $delete->delete();
        return true;
    }
    public function processPaymentForBooking($bookingId, $amount)
    {
        $gateway = new MockPaymentGateway();
        $reference = $gateway->generateReference();
        $paymentResult = $gateway->processPayment($amount, $reference);
        $this->createPayment([
            'booking_id' => $bookingId,
            'amount' => $amount,
            'payment_reference' => $reference,
            'status' => $paymentResult['status'],
        ]);
        return $paymentResult;
    }
}
