<?php

namespace App\Services;

class MockPaymentGateway
{
    public function processPayment($amount, $reference)
    {
        $inSuccess = rand(10, 100) > 20;
        if (!$inSuccess) {
            return [
                'status' => 'failed',
                'reference' => $reference,
                'message' => 'فشل الدفع'
            ];
        } else {
            return [
                'status' => 'completed',
                'reference' => $reference,
                'message' => 'نجح الدفع'
            ];
        }
    }
    public function verifyPayment($reference)
    {
        if ($reference) {
            return true;
        } else {
            return false;
        }
    }
    public function generateReference()
    {
        $randomNumber = rand(100000, 999999);
        $reference = "REF_" . $randomNumber;
        return $reference;
    }
}
