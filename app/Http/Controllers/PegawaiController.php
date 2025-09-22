<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Data yang akan dikirimkan ke view
        $data = [];

        // Nama
        $data['name'] = 'Heroku'; // Ganti dengan nama sesuai kebutuhan

        // Umur (dihitung berdasarkan tanggal lahir)
        $tanggal_lahir = '2000-01-01'; // Ganti dengan tanggal lahir yang sesuai
        $umur = date_diff(date_create($tanggal_lahir), date_create('today'))->y;
        $data['my_age'] = $umur;

        // Hobi (minimal 5 item)
        $data['hobbies'] = ['Membaca', 'Berenang', 'Bermain Game', 'Fotografi', 'Berjalan-jalan'];

        // Tanggal Harus Wisuda
        $data['tgl_harus_wisuda'] = '2025-07-01'; // Ganti dengan tanggal wisuda yang sesuai
        $tgl_harus_wisuda = new DateTime($data['tgl_harus_wisuda']);
        $hari_ini = new DateTime();
        $interval = $hari_ini->diff($tgl_harus_wisuda);
        $data['time_to_study_left'] = $interval->days;

        // Semester saat ini
        $data['current_semester'] = 4; // Ganti dengan semester saat ini
        if ($data['current_semester'] < 3) {
            $data['study_message'] = "Masih Awal, Kejar TAK";
        } else {
            $data['study_message'] = "Jangan main-main, kurang-kurangi main game!";
        }

        // Cita-cita
        $data['future_goal'] = 'Menjadi Developer yang handal';

        // Menampilkan data ke view
        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Implementasi logika untuk halaman form create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementasi logika untuk menyimpan data
    }
}
