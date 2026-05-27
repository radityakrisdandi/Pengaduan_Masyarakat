<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user');

        // Jika admin
        if (auth()->user()->role == 'admin') {

            // FILTER ROLE
            if ($request->role != '') {

                $query->whereHas('user', function ($q) use ($request) {

                    $q->where('role', $request->role);
                });
            }

            // SEARCH AKTIVITAS
            if ($request->search != '') {

                $query->whereHas('user', function ($q) use ($request) {

                    $q->where('name', 'like', '%' . $request->search . '%');
                });
            }

            $logs = $query->latest('created_at')->get();
        } else {

            // User & Petugas hanya log sendiri
            $logs = $query->where('user_id', auth()->id())
                ->latest('created_at')
                ->get();
        }

        return view('log.index', compact('logs'));
    }
}
