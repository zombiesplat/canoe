<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    /**
     * @param Client $client
     * @return Fund[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function clientFunds(Client $client)
    {
        $funds = Fund::all();
        $funds = $funds->map(function ($fund) use ($client) {
            /** @var Fund $fund */
            if (!$client->canViewFund($fund)) {
                return $fund->setRedacted(true);
            }
            return $fund;
        });
        return $funds;
    }
}
