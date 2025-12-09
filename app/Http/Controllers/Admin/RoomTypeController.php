<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    public function dashboard(Request $request) {
        $query = Reservation::query();

        if ($request->reservation_status) {
            $query->where('reservation_status', $request->reservation_status);
        }
        $reservations = $query->paginate(10);

        return view('partials.admin_dashboard', [
            'title' => 'Admin Dashboard',
            'reservations' => $reservations
        ]);
    }

    public function index() {
        $roomType = RoomType::all();
        return view('room.index', [
            'title' => 'Room Type',
            'roomType' => $roomType
        ]);
    }

    public function create() {
        return view('room.create', [
            'title' => 'Create Room'
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'rates' => 'required|string|max:255',
            'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:5248',
        ]);

        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('rooms'), $filename);
        } else {
            $filename = null;
        }

        RoomType::create([
            'room_name' => $request->input('room_name'),
            'rates' => $request->input('rates'),
            'image_url' => $filename,
        ]);

        return redirect()->route('room.index')->with('success', 'Data SKP berhasil disimpan.');
    }

    public function edit($id) {
        $roomType = RoomType::findOrFail($id);
        return view('room.edit', [
            'title' => 'Edit Room',
            'roomType' => $roomType
        ]);
    }

    public function update(Request $request, $id) {
         $request->validate([
            'room_name' => 'required|string|max:255',
            'rates' => 'required|string|max:255',
            'image_url' => 'nullable|file|mimes:jpg,jpeg,png|max:5248',
        ]);

        $roomType = RoomType::findOrFail($id);

        // Jika ada file baru diunggah file lama bisa dihapus
        if ($request->hasFile('image_url')) {
            // Hapus file lama jika ada
            if ($roomType->image_url && file_exists(public_path('rooms/' . $roomType->image_url))) {
                unlink(public_path('rooms/' . $roomType->image_url));
            }

            $file = $request->file('image_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('rooms'), $filename);
            $roomType->image_url = $filename;
        }
    }

    public function destroy($id) {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();

        return redirect()->route('room.index');
    }
}
