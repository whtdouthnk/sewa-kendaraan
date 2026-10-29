<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $log = LogAktivitas::with('user')->latest()->get();
    
        return view('admin.log_aktivitas', compact('log'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogAktivitas $logAktivitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogAktivitas $logAktivitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogAktivitas $logAktivitas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogAktivitas $logAktivitas)
    {
        //
    }
}
