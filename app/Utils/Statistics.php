<?php
namespace App\Utils;
use App\Models\Client;
use App\Models\Account;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

trait Statistics{

    private function contentRow(){
        $content_row = [];

        $content_row['amount'] = $this->amountStat();
        $content_row['accounts'] = $this->accountNumber();
        $content_row['profiles'] = $this->profiles();
        $content_row['clients'] = $this->clients();
        $content_row['free_profiles'] = $this->freeProfiles($content_row['profiles']);

        return $content_row;
    }

    private function clientsSub()
    {
        $all_month = [];
        for ($i = 1; $i <= 12; $i++) {
            $all_month[] = DB::table("clients")
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i)
                ->get()
                ->count();
        }

        return $all_month;
    }

    private function amountStat()
    {
        return  DB::table('payments')
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('n') - 1)
            ->select("amount")
            ->get()
            ->sum();
    }

    private function accountNumber(){
        return count(Account::all());
    }

    private function profiles()
    {
        return count(Profile::all());
    }

    private function clients()
    {
        return count(Client::all());
    }

    private function freeProfiles($all)
    {
        return  count(Profile::whereClientId(null)->get()) * 100 / $all;
    }

}
