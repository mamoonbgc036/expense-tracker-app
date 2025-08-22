@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Expense
    </a>
</div>

<div class="row">
    <!-- Monthly Summary -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ date('F Y') }} Expenses
                </h5>
            </div>
            <div class="card-body">
                @if($monthlyExpenses->count() > 0)
                    @foreach($monthlyExpenses as $expense)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge" style="background-color: {{ $expense->category->color }}">
                                {{ $expense->category->name }}
                            </span>
                            <strong>${{ number_format($expense->total, 2) }}</strong>
                        </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total:</strong>
                        <strong class="text-primary">${{ number_format($monthlyTotal, 2) }}</strong>
                    </div>
                @else
                    <p class="text-muted">No expenses recorded for this month.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie me-2"></i>
                    Category Breakdown
                </h5>
            </div>
            <div class="card-body">
                @if($chartData->count() > 0)
                    <canvas id="expenseChart" width="400" height="400"></canvas>
                @else
                    <p class="text-muted text-center">No data to display</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Expenses -->
@if($recentExpenses->count() > 0)
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-clock me-2"></i>
            Recent Expenses
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentExpenses as $expense)
                    <tr>
                        <td>{{ $expense->date->format('M d, Y') }}</td>
                        <td>{{ $expense->title }}</td>
                        <td>
                            <span class="badge" style="background-color: {{ $expense->category->color }}">
                                {{ $expense->category->name }}
                            </span>
                        </td>
                        <td>${{ number_format($expense->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-end">
            <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-outline-primary">
                View All Expenses
            </a>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
@if($chartData->count() > 0)
<script>
const ctx = document.getElementById('expenseChart').getContext('2d');
const chartData = @json($chartData->values());
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: chartData.map(item => item.name),
        datasets: [{
            data: chartData.map(item => item.amount),
            backgroundColor: chartData.map(item => item.color),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endif
@endsection