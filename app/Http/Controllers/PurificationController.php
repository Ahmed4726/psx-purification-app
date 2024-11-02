<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock; // Assuming you have a Stock model

class PurificationController extends Controller
{
    public function index()
    {
        // Fetch all stocks to populate the dropdown in the form
        $stocks = Stock::all();
        return view('purification.index', compact('stocks'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'capital_gain' => 'nullable|numeric|min:0',
            'dividend' => 'nullable|numeric|min:0',
            'total_shares' => 'required|integer|min:1',
        ]);

        // Retrieve stock details and user inputs
        $stock = Stock::findOrFail($request->stock_id);
        $capitalGain = $request->capital_gain ?? 0;
        $dividend = $request->dividend ?? 0;
        $totalShares = $request->total_shares;

        // Determine which income type to use (Capital Gain or Dividend)
        $incomeType = $capitalGain > 0 ? $capitalGain : $dividend;

        // Non-Compliant Income Ratio (income_ratio) from the stock
        $nonCompliantRatio = $stock->income_ratio / 100; // Convert to decimal

        // Calculate Total Income based on number of shares and income type
        $totalIncome = $incomeType * $totalShares;

        // Calculate Income to be Purified
        $incomeToBePurified = $totalIncome * $nonCompliantRatio;

        // Calculate Purified Income
        $purifiedIncome = $totalIncome - $incomeToBePurified;

        return view('purification.result', [
            'stock' => $stock,
            'incomeType' => $capitalGain > 0 ? 'Capital Gain' : 'Dividend',
            'incomeAmount' => $incomeType,
            'totalShares' => $totalShares,
            'totalIncome' => $totalIncome,
            'incomeToBePurified' => $incomeToBePurified,
            'purifiedIncome' => $purifiedIncome,
        ]);
    }

}

