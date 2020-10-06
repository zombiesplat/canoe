<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use App\Models\Client;
use App\Models\Fund;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CashFlowController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'client_id' => 'required|exists:clients,id',
            'fund_type' => 'required|in:'.join(',', Fund::TYPES),
            'investment_id' => 'required|exists:investments,id',
            'return' => 'required|numeric',
            'date' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);

        $validator->after(function($validator) {
            $data = $validator->getData();
            $client = Client::find($data['client_id']);
            $investment = Investment::find($data['investment_id']);
            if ($investment->client_id !== $client->id) {
                $validator->errors()->add('investment_id', 'Investment does not belong to client');
            }
        });

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            CashFlow::create([
                'investment_id' => $request->input('investment_id'),
                'date' => $request->input('date'),
                'return' => $request->input('return'),
            ]);
            return response()->json([], 201);
        } catch (\Exception $exception) {
            return response()->json($exception, 500);
        }
    }
}
