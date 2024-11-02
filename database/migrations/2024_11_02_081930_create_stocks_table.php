<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('ticker')->unique(); // Stock ticker symbol
            $table->string('company_name'); // Company name
            $table->string('objective'); // Compliance objective (e.g., Compliant, Non-Compliant)
            $table->string('debt_ratio'); // Debt Ratio (D/A < 37%)
            $table->string('investment_ratio'); // Investment Ratio (NCInv/TA < 33%)
            $table->string('income_ratio'); // Income Ratio (NCInc/TR < 5%)
            $table->string('illiquid_assets_ratio'); // Illiquid Assets Ratio (IA/TA >= 25%)
            $table->string('net_liquid_assets_ratio'); // Net Liquid Assets Ratio (NLA < P)
            $table->string('share_price'); // Share Price as of December 29, 2023
            $table->string('final_shariah_status'); // Final Shariah Status
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
