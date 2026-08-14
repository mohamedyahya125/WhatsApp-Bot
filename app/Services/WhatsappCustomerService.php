<?php

namespace App\Services;

use App\Models\WhatsappCustomer;

class WhatsappCustomerService
{
    public function createWhatsappCustomer($data)
    {
        $whatsappCustomer = WhatsappCustomer::create($data);
        return $whatsappCustomer;
    }
    public function getAllWhatsappCustomers()
    {

        return WhatsappCustomer::paginate(10);
    }
    public function getWhatsappCustomerById($id)
    {
        $show = WhatsappCustomer::find($id);
        return $show;
    }
    public function updateWhatsappCustomer($id, $data)
    {
        $update = WhatsappCustomer::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteWhatsappCustomer($id)
    {
        $delete = WhatsappCustomer::find($id);
        $delete->delete();
        return true;
    }
}
