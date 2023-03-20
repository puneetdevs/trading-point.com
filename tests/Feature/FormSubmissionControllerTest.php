<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FormSubmissionControllerTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('companies');
    }

    public function testSubmit()
    {
        $response = $this->post('/submit', [
            'company_symbol' => 'AAPL',
            'email' => 'test@yopmail.com',
            'start_date' => '2021-01-01',
            'end_date' => '2022-01-31'
        ]);
        
        $response->assertStatus(302);
    }

    public function testSubmitValidationErrors()
    {
        $response = $this->post('/submit', [
            'name' => 'John Doe',
            'email' => '',
            'company_symbol' => 'AAPL',
            'start_date' => '2021-01-01',
            'end_date' => '2022-02-01'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email', 'end_date']);

        $response->assertRedirect('/');
    }




    public function testHistoricalQuotes()
    {
        Http::fake([
            'yh-finance.p.rapidapi.com/*' => Http::response(['prices' => []], 200)
        ]);

        $response = $this->get('/historical-quotes?company_symbol=AAPL&start_date=2022-01-01&end_date=2022-01-31');

        $response->assertStatus(200);
        $response->assertViewHas(['symbol', 'start_date', 'end_date', 'data']);
    }

    public function testHistoricalQuotesApiError()
    {
        Http::fake([
            'yh-finance.p.rapidapi.com/*' => Http::response([], 500)
        ]);

        $response = $this->get('/historical-quotes?company_symbol=AAPL&start_date=2022-01-01&end_date=2022-01-31');

        $response->assertStatus(302);
        $response->assertSessionHas('error');
    }
}
