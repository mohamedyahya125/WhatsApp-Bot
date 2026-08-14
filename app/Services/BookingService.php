<?php

namespace App\Services;

use App\Models\Booking;

class BookingService
{
    public function createBooking($data)
    {
        $booking = Booking::create($data);
        return $booking;
    }
    public function getAllBookings()
    {

        return Booking::paginate(10);
    }
    public function getBookingById($id)
    {
        $show = Booking::find($id);
        return $show;
    }
    public function updateBooking($id, $data)
    {
        $update = Booking::find($id);
        $update->update($data);
        return $update;
    }
    public function deleteBooking($id)
    {
        $delete = Booking::find($id);
        $delete->delete();
        return true;
    }
}
