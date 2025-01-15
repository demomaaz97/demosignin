<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LighthouseController extends Controller
{
    public function testPerformance(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|url',
            'platform' => 'required|in:Mobile,Desktop',
        ]);

        $strategy = $validated['platform'] === 'Mobile' ? 'mobile' : 'desktop';

        $client = new Client();
        $response = $client->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
            'query' => [
                'url' => $validated['url'],
                'strategy' => $strategy,
                'key' => env('GOOGLE_API_KEY'),
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        return response()->json([
            'performance_score' => $data['lighthouseResult']['categories']['performance']['score'] * 100,
        ]);
    }
}
