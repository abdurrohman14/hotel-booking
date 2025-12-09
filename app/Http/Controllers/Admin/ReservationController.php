<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        $reservation = Reservation::all();
        return view('reservation.index', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmation,cancel'
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->reservation_status = $request->status;
        $reservation->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
