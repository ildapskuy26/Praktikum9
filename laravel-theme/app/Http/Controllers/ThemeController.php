<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tema dari session atau cookie
        $theme = session('theme', $request->cookie('theme', 'light'));

        return view('theme.index', compact('theme'));
    }

    public function setTheme(Request $request, $theme)
    {
        // Validasi input tema (hanya light atau dark yang diperbolehkan)
        if (!in_array($theme, ['light', 'dark'])) {
            abort(400, 'Tema tidak valid.');
        }

        // Simpan tema ke session
        session(['theme' => $theme]);

        // Simpan tema ke cookie selama 30 hari
        return redirect('/')->withCookie(cookie('theme', $theme, 43200));
    }
}