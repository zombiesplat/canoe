<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Client[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Client::with(['investments.cashFlows'])->get();
    }
}
