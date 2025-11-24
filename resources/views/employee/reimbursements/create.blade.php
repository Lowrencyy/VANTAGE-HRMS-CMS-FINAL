@extends('layouts.master')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">New Reimbursement</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employee.reimbursements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Amount</label>
            <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Title (optional)</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-input w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium">Description (optional)</label>
            <textarea name="description" rows="4" class="form-input w-full">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Receipt (image/PDF, optional)</label>
            <input type="file" name="employee_receipt" class="form-input w-full">
        </div>

        <button type="submit" class="btn btn-primary">Submit Reimbursement</button>
    </form>
</div>
@endsection
