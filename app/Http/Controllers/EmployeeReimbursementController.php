<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeReimbursementController extends Controller
{
   public function index()
{
    $reimbursements = Reimbursement::where('employee_id', Auth::id())
        ->latest()
        ->get();

    return view('HR.reimbursements.employee-index', compact('reimbursements'));
}

    public function create()
    {
        return view('employee.reimbursements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount'   => 'required|numeric|min:0',
            'title'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'employee_receipt' => 'nullable|image|mimes:jpg,jpeg,png,pdf,webp|max:4096',
        ]);

        $receiptPath = null;

      if ($request->hasFile('employee_receipt')) {
    $file = $request->file('employee_receipt');
    
    // Generate unique filename
    $filename = time() . '_' . $file->getClientOriginalName();
    
    // Move directly to public/imagestorage/employeeReciept
    $file->move(public_path('imagestorage/employeeReciept'), $filename);
    
    // Store the path for database (relative path)
    $receiptPath = 'imagestorage/employeeReciept/' . $filename;
}
        Reimbursement::create([
            'employee_id'           => Auth::id(),
            'amount'                => $request->amount,
            'title'                 => $request->title,
            'description'           => $request->description,
            'employee_receipt_path' => $receiptPath,
            'status'                => 'pending',
        ]);

        return redirect()
            ->route('employee.reimbursements.index')
            ->with('success', 'Reimbursement request submitted and is now pending.');
    }

    public function show(Reimbursement $reimbursement)
    {
        // Make sure the employee can only see their own requests
        abort_unless($reimbursement->employee_id === Auth::id(), 403);

        return view('employee.reimbursements.show', compact('reimbursement'));
    }
}
