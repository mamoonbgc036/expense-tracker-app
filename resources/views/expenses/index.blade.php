@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Expenses</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Expense
    </a>
</div>

@if($expenses->count() > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->date->format('M d, Y') }}</td>
                            <td>{{ $expense->title }}</td>
                            <td>
                                <span class="badge" style="background-color: {{ $expense->category->color }}">
                                    {{ $expense->category->name }}
                                </span>
                            </td>
                            <td>${{ number_format($expense->amount, 2) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $expenses->links() }}
    </div>
@else
    <div class="card">
        <div class="card-body text-center">
            <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
            <h5>No expenses recorded yet</h5>
            <p class="text-muted">Start tracking your expenses by adding your first entry.</p>
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Your First Expense
            </a>
        </div>
    </div>
@endif
@endsection