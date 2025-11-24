<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeReimbursementController extends Controller
{
    // Employee list + submit form page
    public function index()
    {
        $user = Auth::user();

        $reimbursements = Reimbursement::where('employee_id', $user->id)
            ->latest()
            ->get();

        return view('reimbursements.employee-index', compact('reimbursements'));
    }

    // Store new reimbursement from employee
    public function store(Request $request)
    {
        $request->validate([
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'amount'            => 'required|numeric|min:0',
            'employee_receipt'  => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:4096',
        ]);

        $path = null;
        if ($request->hasFile('employee_receipt')) {
            // goes to storage/app/public/reimbursements/employee
            $path = $request->file('employee_receipt')
                ->store('reimbursements/employee', 'public');
        }

        Reimbursement::create([
            'employee_id'            => Auth::id(),
            'title'                  => $request->title,
            'description'            => $request->description,
            'amount'                 => $request->amount,
            'status'                 => 'pending',
            'employee_receipt_path'  => $path,
        ]);

        return back()->with('success', 'Reimbursement submitted and is now Pending.');
    }
}
