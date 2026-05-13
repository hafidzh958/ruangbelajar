<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Program;
use Illuminate\Http\Request;

/**
 * RegistrationController: CRUD data pendaftar siswa.
 * Admin bisa melihat, mengubah status, dan menghapus data pendaftaran.
 * Pendaftar mengisi form dari sisi user (UserRegisterController).
 */
class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = Registration::with('program')->latestFirst();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan program
        if ($request->filled('program_id')) {
            $query->where('program_id', $request->program_id);
        }

        // Pencarian nama siswa / nama wali
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('parent_name', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(20)->withQueryString();
        $programs      = Program::active()->get();
        $statuses      = Registration::STATUSES;

        // Hitung ringkasan per status untuk header card
        $summary = Registration::selectRaw('status, count(*) as total')
                               ->groupBy('status')
                               ->pluck('total', 'status');

        return view('admin.register.registrations.index', compact(
            'registrations', 'programs', 'statuses', 'summary'
        ));
    }

    public function show(Registration $registration)
    {
        $registration->load('program');
        $statuses = Registration::STATUSES;

        return view('admin.register.registrations.show', compact('registration', 'statuses'));
    }

    public function edit(Registration $registration)
    {
        $registration->load('program');
        $programs = Program::active()->get();
        $statuses = Registration::STATUSES;

        return view('admin.register.registrations.edit', compact('registration', 'programs', 'statuses'));
    }

    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'age'          => 'nullable|integer|min:1|max:99',
            'class_name'   => 'nullable|string|max:100',
            'parent_name'  => 'required|string|max:255',
            'whatsapp'     => 'required|string|max:20',
            'program_id'   => 'nullable|exists:programs,id',
            'notes'        => 'nullable|string',
            'status'       => 'required|in:' . implode(',', array_keys(Registration::STATUSES)),
            'admin_notes'  => 'nullable|string',
        ]);

        $data = $request->only([
            'student_name', 'age', 'class_name', 'parent_name',
            'whatsapp', 'program_id', 'notes', 'status', 'admin_notes',
        ]);

        // Catat waktu pertama kali status berubah menjadi 'contacted'
        if ($request->status === 'contacted' && !$registration->contacted_at) {
            $data['contacted_at'] = now();
        }

        $registration->update($data);

        return redirect()->route('admin.register.registrations.show', $registration)
            ->with('success', '✅ Data pendaftaran berhasil diperbarui!');
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()->route('admin.register.registrations.index')
            ->with('success', '🗑️ Data pendaftaran berhasil dihapus!');
    }

    /**
     * Update status saja (AJAX-friendly endpoint).
     * Digunakan untuk quick-action di index table.
     */
    public function updateStatus(Request $request, Registration $registration)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_keys(Registration::STATUSES)),
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'contacted' && !$registration->contacted_at) {
            $data['contacted_at'] = now();
        }

        $registration->update($data);

        return redirect()->back()
            ->with('success', "✅ Status diubah ke: " . Registration::STATUSES[$request->status]);
    }
}
