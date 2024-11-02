<?php

namespace App\Http\Controllers;

use App\Imports\StocksImport;
use App\Models\Stock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StockController extends Controller
{

    public function index(Request $request)
    {
        $stocks = Stock::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $stocks->where('ticker', 'LIKE', "%{$search}%")
                   ->orWhere('company_name', 'LIKE', "%{$search}%");
        }

        $stocks = $stocks->paginate(10); // Modify this to change items per page

        return view('stocks.index', compact('stocks'));
    }

    // Add a new method for AJAX search
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->input('search');
            $stocks = Stock::query();

            if ($search) {
                $stocks->where('ticker', 'LIKE', "%{$search}%")
                       ->orWhere('company_name', 'LIKE', "%{$search}%");
            }

            $stocks = $stocks->paginate(10);
            return view('stocks.partials.stock_table', compact('stocks'));
        }

        return response()->json(['error' => 'Invalid Request'], 400);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new StocksImport, $request->file('file'));

        return redirect()->back()->with('success', 'Stocks imported successfully!');
    }
}
