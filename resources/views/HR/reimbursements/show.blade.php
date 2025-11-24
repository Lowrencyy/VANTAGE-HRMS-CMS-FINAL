@extends('layouts.master')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Reimbursement #{{ $reimbursement->id }}</h1>

    <p><strong>Employee:</strong> {{ $reimbursement->employee->name ?? 'N/A' }}</p>
    <p><strong>Amount:</strong> {{ number_format($reimbursement->amount, 2) }}</p>
    <p><strong>Status:</strong>
        @include('partials._reimbursement_status_badge', ['status' => $reimbursement->status])
    </p>
    <p><strong>Description:</strong> {{ $reimbursement->description ?? '-' }}</p>

    <hr class="my-4">

    <h3 class="font-bold mb-2">Employee Receipt</h3>
    @if($reimbursement->employee_receipt_path)
        <a href="{{ asset('storage/' . $reimbursement->employee_receipt_path) }}" target="_blank" class="text-blue-600">
            View Employee Receipt
        </a>
    @else
        <p>No receipt uploaded by employee.</p>
    @endif

    <hr class="my-4">

    {{-- Approve / Deny --}}
    <div class="mb-6">
        <h3 class="font-bold mb-2">Approve / Deny</h3>
        <form action="{{ route('hr.reimbursements.approve', $reimbursement) }}" method="POST" class="inline-block">
            @csrf
            <input type="hidden" name="hr_note" value="{{ $reimbursement->hr_note }}">
            <button class="btn btn-success">Approve</button>
        </form>

        <form action="{{ route('hr.reimbursements.deny', $reimbursement) }}" method="POST" class="inline-block ml-2">
            @csrf
            <input type="hidden" name="hr_note" value="{{ $reimbursement->hr_note }}">
            <button class="btn btn-danger">Deny</button>
        </form>
    </div>

    {{-- Mark as Paid --}}
    <div class="mb-6">
        <h3 class="font-bold mb-2">Mark as Paid</h3>

        <form action="{{ route('hr.reimbursements.markPaid', $reimbursement) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="block font-medium">Upload Payment Proof (optional)</label>
                <input type="file" name="hr_receipt" class="form-input w-full">
            </div>

            <div class="mb-3">
                <label class="block font-medium">HR Note (optional)</label>
                <textarea name="hr_note" rows="3" class="form-input w-full">{{ $reimbursement->hr_note }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Mark as Paid</button>
        </form>

        @if($reimbursement->hr_receipt_path)
            <p class="mt-3">
                Existing payment receipt:
                <a href="{{ asset('storage/' . $reimbursement->hr_receipt_path) }}" target="_blank" class="text-blue-600">
                    View HR Receipt
                </a>
            </p>
        @endif
    </div>
</div>
@endsection
