<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Alert;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::all();
        return view('leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all()->mapWithKeys(fn($e) => [$e->id => $e->name])->toArray();
        return view('leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason'      => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $employeeId = $request->employee_id;
        // Validasi: Tanggal mulai harus minimal 3 hari ke depan
        if ($startDate->lt(now()->addDays(2))) {
            return back()->with('error', 'Tanggal mulai cuti minimal harus 3 hari ke depan.');
        }

        // Validasi: Durasi cuti hanya boleh 1 hari
        if ($startDate->diffInDays($endDate) > 0) {
            return back()->with('error', 'Durasi cuti hanya boleh 1 hari.');
        }

        // Validasi: Total cuti pegawai dalam tahun berjalan <= 12 hari
        $year = $startDate->year;
        $totalDaysThisYear = Leave::where('employee_id', $employeeId)
            ->whereYear('start_date', $year)
            ->get()
            ->sum(fn($leave) => Carbon::parse($leave->start_date)->diffInDays(Carbon::parse($leave->end_date)) + 1);

        if ($totalDaysThisYear >= 12) {
            return back()->with('error', 'Pegawai ini sudah menggunakan maksimal 12 hari cuti tahun ini.');
        }

        // Validasi: 1 hari saja dalam bulan yang sama
        $month = $startDate->month;
        $hasTakenLeaveThisMonth = Leave::where('employee_id', $employeeId)
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->exists();

        if ($hasTakenLeaveThisMonth) {
            return back()->with('error', 'Pegawai ini sudah mengambil cuti bulan ini.');
        }

        // Jika lolos semua, simpan
        Leave::create($request->all());

        return redirect()->route('leaves.index')->with('success', 'Data cuti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        $employees = Employee::all()->mapWithKeys(fn($e) => [$e->id => $e->name])->toArray();
        return view('leaves.edit', compact('leave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'reason'      => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
        ]);

        $leave = Leave::findOrFail($id);
        $employeeId = $leave->employee->id;
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Validasi: Tanggal mulai minimal 3 hari ke depan
        if ($startDate->lt(now()->addDays(2))) {
            return back()->with('error', 'Tanggal mulai cuti minimal harus 3 hari ke depan.');
        }

        // Validasi: Tanggal selesai tidak boleh sebelum tanggal mulai (sudah dijaga `after_or_equal`)
        // Validasi: Durasi cuti hanya boleh 1 hari
        if ($startDate->diffInDays($endDate) > 0) {
            return back()->with('error', 'Durasi cuti hanya boleh 1 hari.');
        }

        $year = $startDate->year;
        $month = $startDate->month;

        // Validasi: Total cuti dalam 1 tahun tidak lebih dari 12 hari (exclude cuti yang sedang diupdate)
        $totalDaysThisYear = Leave::where('employee_id', $employeeId)
            ->whereYear('start_date', $year)
            ->where('id', '!=', $leave->id)
            ->get()
            ->sum(fn($l) => Carbon::parse($l->start_date)->diffInDays(Carbon::parse($l->end_date)) + 1);

        if ($totalDaysThisYear >= 12) {
            return back()->with('error', 'Pegawai ini sudah menggunakan maksimal 12 hari cuti tahun ini.');
        }

        // Validasi: Tidak boleh lebih dari 1 cuti dalam bulan yang sama (exclude cuti saat ini)
        $hasTakenLeaveThisMonth = Leave::where('employee_id', $employeeId)
            ->whereMonth('start_date', $month)
            ->whereYear('start_date', $year)
            ->where('id', '!=', $leave->id)
            ->exists();

        if ($hasTakenLeaveThisMonth) {
            return back()->with('error', 'Pegawai ini sudah mengambil cuti bulan ini.');
        }

        // Semua validasi lolos, update data
        $leave->update($request->all());

        return redirect()->route('leaves.index')->with('success', 'Data cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->route('leaves.index')->with('success', 'Data cuti berhasil dihapus.');
    }
}
