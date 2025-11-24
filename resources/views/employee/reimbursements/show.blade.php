@extends('layouts.master')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Reimbursement #{{ $reimbursement->id }}</h1>

    <p><strong>Status:</strong>
        @include('partials._reimbursement_status_badge', ['status' => $reimbursement->status])
    </p>

    <p><strong>Amount:</strong> {{ number_format($reimbursement->amount, 2) }}</p>
    <p><strong>Title:</strong> {{ $reimbursement->title ?? '-' }}</p>
    <p><strong>Description:</strong> {{ $reimbursement->description ?? '-' }}</p>

    <hr class="my-4">

    <h3 class="font-bold mb-2">Your Receipt</h3>
    @if($reimbursement->employee_receipt_path)
        <a href="{{ asset('storage/' . $reimbursement->employee_receipt_path) }}" target="_blank" class="text-blue-600">
            View Uploaded Receipt
        </a>
    @else
        <p>No receipt uploaded.</p>
    @endif

    <hr class="my-4">

    <h3 class="font-bold mb-2">HR Payment Proof</h3>
    @if($reimbursement->status === 'paid' && $reimbursement->hr_receipt_path)
        <a href="{{ asset('storage/' . $reimbursement->hr_receipt_path) }}" target="_blank" class="text-blue-600">
            View Payment Receipt
        </a>
    @elseif($reimbursement->status === 'paid')
        <p>Marked as paid, but no receipt available.</p>
    @else
        <p>Not paid yet.</p>
    @endif
</div>
@endsection
