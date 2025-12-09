<?php

namespace App\Http\Controllers\User;

use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function dashboard()
    {
        $rooms = RoomType::all();
        return view('partials.user_page', [
            'title' => 'E-Hotel',
            'rooms' => $rooms
        ]);
    }

    public function create($id)
    {
        $room = RoomType::findOrFail($id);
        return view('user.booking', [
            'title' => 'Booking Room',
            'room' => $room
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:room_types,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        // cek apakah tanggal bentrok
        $isBooked = Reservation::where('room_id', $request->room_id)
            ->where(function ($query) use ($request) {
                $query->whereDate('checkin_date', '<=', $request->checkout_date)
                    ->whereDate('checkout_date', '>=', $request->checkin_date);
            })
            ->where('reservation_status', '!=', 'cancel') // ignore cancelled booking
            ->exists();

        if ($isBooked) {
            return redirect()->back()->with('error', 'Tanggal yang Anda pilih sudah dibooking.');
        }

        Reservation::create([
            'room_id' => $request->room_id,
            'guest_name' => Auth::user()->name,
            'guest_email' => Auth::user()->email,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'reservation_status' => 'pending',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Booking berhasil!');
    }

    public function historyUser()
    {
        $userEmail = auth()->user()->email; // jika user login

        // Jika user tidak login, kamu bisa ambil dari session
        // $userEmail = session('user_email');

        $reservations = Reservation::where('guest_email', $userEmail)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', [
            'title' => 'Riwayat Pemesanan',
            'reservations' => $reservations
        ]);
    }
}
