<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan landing page beserta daftar layanan.
     */
    public function index(): View
    {
        return view('welcome', [
            'services' => Service::orderBy('name')->get(),
        ]);
    }

    /**
     * Simpan pesan dari form "Hubungi Sekarang".
     */
    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:8', 'max:20'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.min' => 'Nomor HP minimal 8 karakter.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.');
    }

    /**
     * Simpan pengajuan booking servis.
     */
    public function storeBooking(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:100'],
            'whatsapp_number' => ['required', 'string', 'min:8', 'max:20'],
            'plate_number' => ['required', 'string', 'max:15'],
            'service_date' => ['required', 'date', 'after_or_equal:today'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
        ], [
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.min' => 'Nomor WhatsApp minimal 8 karakter.',
            'plate_number.required' => 'Plat nomor wajib diisi.',
            'service_date.required' => 'Tanggal servis wajib diisi.',
            'service_date.after_or_equal' => 'Tanggal servis tidak boleh di masa lalu.',
            'service_id.required' => 'Jenis servis wajib dipilih.',
            'service_id.exists' => 'Jenis servis yang dipilih tidak tersedia.',
        ]);

        $validated['plate_number'] = strtoupper($validated['plate_number']);
        $validated['status'] = 'pending';

        Booking::create($validated);

        return back()->with('success', 'Booking berhasil dikirim! Kami akan mengonfirmasi jadwal servis Anda.');
    }
}
