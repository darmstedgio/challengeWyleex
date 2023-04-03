<?php

namespace App\Console\Commands;

use App\Models\DailyBalance;
use App\Models\MoneyMovement;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SaveDailyCashWalletMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:daily-money-movement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save the balance of the day in daily_balances';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $yesterday_start = $yesterday . ' 00:00:00';
        $yesterday_end = $yesterday . ' 23:59:59';
        $money_movements = MoneyMovement::where('created_at', '>=' , $yesterday_start)
                                    ->where('created_at', '<=' , $yesterday_end)
                                    ->get();

        $data = [
            'debit' => 0,
            'credit' => 0,
            'balance' => 0,
            'datetime' => $yesterday_end
        ];

        foreach ($money_movements as $item) {
            $data['debit'] += $item->debit;
            $data['credit'] += $item->credit;
            $data['balance'] += $item->balance;
        }

        DailyBalance::create(
            $data
        );

        return Command::SUCCESS;
    }
}
