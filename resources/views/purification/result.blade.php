@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-success text-white">
            <h3>Purification Result</h3>
        </div>
        <div class="card-body">
            <h5>Stock: {{ $stock->company_name }}</h5>
            <p><strong>Ticker:</strong> {{ $stock->ticker }}</p>
            <p><strong>Objective:</strong> {{ $stock->objective }}</p>

            <hr>

            <p><strong>Income Type:</strong> {{ $incomeType }}</p>
            <p><strong>Income Amount per Share:</strong> {{ number_format($incomeAmount, 3) }}</p>
            <p><strong>Total Number of Shares:</strong> {{ $totalShares }}</p>
            <p><strong>Total Income (Capital Gain or Dividend × Shares):</strong> {{ number_format($totalIncome, 2) }}</p>
            <p><strong>Non-Compliant Income Ratio (%):</strong> {{ number_format($stock->income_ratio, 4) }}%</p>
            <p><strong>Income to be Purified:</strong> {{ number_format($incomeToBePurified, 3) }}</p>
            <p><strong>Purified Income:</strong> {{ number_format($purifiedIncome, 3) }}</p>
            <p><strong>Final-Shariah-Compliant:</strong> {{ $stock->final_shariah_status }}</p>

        </div>
    </div>
</div>
@endsection
