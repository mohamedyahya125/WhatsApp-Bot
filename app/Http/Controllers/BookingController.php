<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, BookingService $booking)
    {
        $data = $request->all();
        $create = $booking->createBooking($data);
        return response()->json([
            'message' => 'تم الانشاء'

        ], 201);
    }
    public function index(BookingService $booking)
    {
        $show = $booking->getAllBookings();
        return response()->json([
            'show' => $show
        ], 200);
    }
    public function show($id, BookingService $booking)
    {
        $idshow = $booking->getBookingById($id);
        return response()->json([
            'idshow' => $idshow
        ], 200);
    }
    public function update($id, Request $request, BookingService $booking)
    {
        $data = $request->all();
        $update = $booking->updateBooking($id, $data);
        return response()->json([
            'message' => 'تم التعديل بنجاح',
            'update' => $update
        ], 200);
    }
    public function destroy($id, BookingService $booking)
    {
        $delete = $booking->deleteBooking($id);
        return response()->json([
            'message' => 'تم الحذف',
            'delete' => $delete
        ], 200);
    }
}
