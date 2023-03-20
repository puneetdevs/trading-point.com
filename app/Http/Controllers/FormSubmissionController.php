<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Events\FormSubmissionCreated;
use App\Http\Requests\FormSubmissionRequest;

class FormSubmissionController extends Controller
{

    public function index()
    {
        try {
            $companies = Company::pluck('Symbol');

            return view('index', compact('companies'));
        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }


    public function submit(FormSubmissionRequest $request)
    {
        try {
            $data = $request->validated();



            $company_name = Company::where('Symbol', $data['company_symbol'])->first();

            $data['company_name'] = $company_name->company_name ?? 'NA';

            event(new FormSubmissionCreated($data));

            return redirect()->route('historicalQuotes', $data)->with('success', 'Form submitted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function historicalQuotes(Request $request)
    {
        try {
            $symbol = $request->input('company_symbol');
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            $key = config('app.rapid_api_key');

            $response = Http::withHeaders([
                'X-RapidAPI-Key' => $key
            ])->get('https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data', [
                'symbol' => $symbol,
                'region' => 'US',
                'from' => $start_date,
                'to' => $end_date
            ]);

            $data = $response->json()['prices'];

            return view('view', [
                'symbol' => $symbol,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
