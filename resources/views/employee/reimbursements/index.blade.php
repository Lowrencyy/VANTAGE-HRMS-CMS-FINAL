@extends('layouts.master')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">My Reimbursements</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('employee.reimbursements.create') }}" class="btn btn-primary mb-4">
        New Reimbursement
    </a>

    @if($reimbursements->isEmpty())
        <p>No reimbursement requests yet.</p>
    @else
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                    <th class="px-3 py-2">ID</th>
                    <th class="px-3 py-2">Title</th>
                    <th class="px-3 py-2">Amount</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Created</th>
                    <th class="px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reimbursements as $r)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $r->id }}</td>
                        <td class="px-3 py-2">{{ $r->title ?? '-' }}</td>
                        <td class="px-3 py-2">{{ number_format($r->amount, 2) }}</td>
                        <td class="px-3 py-2">
                            @include('partials._reimbursement_status_badge', ['status' => $r->status])
                        </td>
                        <td class="px-3 py-2">{{ $r->created_at->format('Y-m-d') }}</td>
                        <td class="px-3 py-2">
                            <a href="{{ route('employee.reimbursements.show', $r) }}" class="text-blue-600">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
