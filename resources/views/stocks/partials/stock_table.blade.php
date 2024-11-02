<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Ticker</th>
            <th>Company Name</th>
            <th>Objective</th>
            <th>Debt Ratio (%)</th>
            <th>Investment Ratio (%)</th>
            <th>Income Ratio (%)</th>
            <th>Illiquid Assets Ratio (%)</th>
            <th>Net Liquid Assets Ratio</th>
            <th>Share Price</th>
            <th>Final Shariah Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $stock)
        <tr>
            <td>{{ $loop->iteration + ($stocks->currentPage() - 1) * $stocks->perPage() }}</td>
            <td>{{ $stock->ticker }}</td>
            <td>{{ $stock->company_name }}</td>
            <td>{{ $stock->objective }}</td>
            <td>{{ $stock->debt_ratio }}</td>
            <td>{{ $stock->investment_ratio }}</td>
            <td>{{ $stock->income_ratio }}</td>
            <td>{{ $stock->illiquid_assets_ratio }}</td>
            <td>{{ $stock->net_liquid_assets_ratio }}</td>
            <td>{{ $stock->share_price }}</td>
            <td>{{ $stock->final_shariah_status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="mt-3">
    {{ $stocks->links() }} <!-- This will generate the pagination links -->
</div>
