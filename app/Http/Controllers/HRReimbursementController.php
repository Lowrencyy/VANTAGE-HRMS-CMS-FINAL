<?php

namespace App\Http\Controllers;

use App\Models\Reimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // ✅ kailangan para sa Str::random()

class HRReimbursementController extends Controller
{
    // HR list page
    public function index()
    {
        $all = Reimbursement::with('employee')->latest()->get();

        $pending = Reimbursement::with('employee')
            ->where('status', 'pending')
            ->latest()
            ->get();

        $approved = Reimbursement::with('employee')
            ->where('status', 'approved')
            ->latest()
            ->get();

        $denied = Reimbursement::with('employee')
            ->where('status', 'denied')
            ->latest()
            ->get();

        $paid = Reimbursement::with('employee')
            ->where('status', 'paid')
            ->latest()
            ->get();

        $totalRequest = $all->count();
        $todayRequest = Reimbursement::whereDate('created_at', today())->count();
        $approvedCount = $approved->count();
        $pendingCount = $pending->count();
        $unpaidCount = Reimbursement::where('status', 'approved')
            ->whereNull('hr_receipt_path')
            ->count();

        return view('HR.reimbursements.hr-index', compact(
            'all',
            'pending',
            'approved',
            'denied',
            'paid',
            'totalRequest',
            'todayRequest',
            'approvedCount',
            'pendingCount',
            'unpaidCount',
        ));
    }

    public function approve(Reimbursement $reimbursement)
    {
        if ($reimbursement->status === 'paid') {
            return back()->with('error', 'Already marked as paid.');
        }

        $reimbursement->status = 'approved';
        $reimbursement->approved_by = Auth::id() ?? null;
        $reimbursement->decision_at = now();
        $reimbursement->save();

        return back()->with('success', 'Reimbursement approved.');
    }

    public function deny(Reimbursement $reimbursement)
    {
        if ($reimbursement->status === 'paid') {
            return back()->with('error', 'Paid reimbursements cannot be denied.');
        }

        $reimbursement->status = 'denied';
        $reimbursement->approved_by = Auth::id() ?? null;
        $reimbursement->decision_at = now();
        $reimbursement->save();

        return back()->with('success', 'Reimbursement denied.');
    }

    // ✅ NEW: generic “Edit Status” (HR + upload receipt sa public/imagestorage/HRReciept)
    public function updateStatus(Request $request, Reimbursement $reimbursement)
    {
        $request->validate([
            'status'             => 'required|in:pending,approved,denied,paid',
            'hr_payment_receipt' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        // update status
        $reimbursement->status = $request->status;

        // ===== HR RECEIPT: PAREHO STYLE NG EMPLOYEE (gamit public/imagestorage/HRReciept) =====
        if ($request->hasFile('hr_payment_receipt')) {
            $file = $request->file('hr_payment_receipt');

            // Target folder: public/imagestorage/HRReciept
            $folderPath = public_path('imagestorage/HRReciept');

            // Gumawa ng folder kung wala pa (pure PHP, walang File facade)
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            // Optional: burahin yung luma kung meron
            if (!empty($reimbursement->hr_receipt_path)) {
                $oldFullPath = public_path($reimbursement->hr_receipt_path);
                if (file_exists($oldFullPath)) {
                    @unlink($oldFullPath);
                }
            }

            // Generate unique filename (para safe)
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Move directly to public/imagestorage/HRReciept
            $file->move($folderPath, $filename);

            // Store the path for database (relative path, same style as employee)
            // ex: imagestorage/HRReciept/1234567890_abcd1234.jpg
            $reimbursement->hr_receipt_path = 'imagestorage/HRReciept/' . $filename;
        }
        // =====================================================================

        if (in_array($request->status, ['approved', 'denied', 'paid'])) {
            $reimbursement->approved_by = Auth::id();
            $reimbursement->decision_at = now();
        }

        $reimbursement->save();

        return back()->with('success', 'Reimbursement status updated.');
    }
}
