<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;

class StocksImport implements ToModel
{
    public function model(array $row)
    {
        // Assuming the Excel columns align with the order in the screenshot:
        return new Stock([
            'ticker' => $row[0],
            'company_name' => $row[1],
            'objective' => $row[2],
            'debt_ratio' => $row[3],
            'investment_ratio' => $row[4],
            'income_ratio' => $row[5],
            'illiquid_assets_ratio' => $row[6],
            'net_liquid_assets_ratio' => $row[7],
            'share_price' => $row[8],
            'final_shariah_status' => $row[9],
        ]);
    }
}

