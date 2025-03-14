@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h3>Income Purification Calculator</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('purification.calculate') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="stock_id" class="form-label">Select Stock</label>
                    <select class="form-select" id="stock_id" name="stock_id" required>
                        <option value="">Choose Stock</option>
                        @foreach($stocks as $stock)
                            <option value="{{ $stock->id }}">{{ $stock->company_name }} - ({{ $stock->ticker }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="total_shares" class="form-label">Total Number of Shares in Company</label>
                    <input type="number" class="form-control" id="total_shares" name="total_shares" step="1" min="1" required>
                </div>

                <div class="mb-3">
                    <label for="capital_gain" class="form-label">Capital Gain</label>
                    <input type="number" class="form-control" id="capital_gain" name="capital_gain" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="dividend" class="form-label">Dividend</label>
                    <input type="number" class="form-control" id="dividend" name="dividend" step="0.01">
                </div>

                <div class="mb-3">
                    <label for="total_income" class="form-label">Total Income</label>
                    <input type="number" class="form-control" id="total_income" name="total_income" step="0.01" disabled>
                </div>

                <button type="submit" class="btn btn-primary">Calculate Purification</button>
            </form>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 on the stock dropdown
        $('#stock_id').select2({
            placeholder: 'Choose Stock',
            allowClear: true,
            width: '100%' // Ensure it matches the form-control style
        });

        // $('#stock_id').addClass('form-control');

        // Enforce only one of Capital Gain or Dividend is entered
        $('#capital_gain, #dividend').on('input', function() {
            if ($(this).val() !== '') {
                $(this).siblings('input').prop('disabled', true);
            } else {
                $(this).siblings('input').prop('disabled', false);
            }
        });

        // Update total income based on capital gain, total shares, and dividend
        $('#dividend, #capital_gain, #total_shares').on('input', function() {
            const capitalGain = parseFloat($('#capital_gain').val());
            const totalShares = parseFloat($('#total_shares').val());
            const dividend = parseFloat($('#dividend').val());

            // Check if capitalGain and totalShares are numbers, and calculate total income accordingly
            if (!isNaN(capitalGain) && !isNaN(totalShares)) {
                const totalIncome = (capitalGain * totalShares) + (isNaN(dividend) ? 0 : dividend);
                $('#total_income').val(totalIncome.toFixed(2)); // Update the total income field
            } else {
                $('#total_income').val(''); // Clear if any input is invalid
            }
        });
    });
</script>
@endsection
