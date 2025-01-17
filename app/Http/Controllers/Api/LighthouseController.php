<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class LighthouseController extends Controller
{
    public function testPerformance(Request $request)
    {
        // Validate the incoming request parameters.
        $validated = $request->validate([
            'url' => 'required|url', // The 'url' field is required and must be a valid URL.
            'platform' => 'required|in:Mobile,Desktop', // The 'platform' field must be either 'Mobile' or 'Desktop'.
        ]);

        // Determine the strategy based on the 'platform' input.
        $strategy = $validated['platform'] === 'Mobile' ? 'mobile' : 'desktop';

        // Initialize the Guzzle HTTP client.
        $client = new Client();

        // Send a GET request to the Google PageSpeed Insights API.
        $response = $client->get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed', [
            'query' => [
                'url' => $validated['url'], // The URL to test.
                'strategy' => $strategy, // The strategy (mobile or desktop).
                'key' => env('GOOGLE_API_KEY'), // API key from environment configuration.
            ],
        ]);

        // Decode the JSON response from the API.
        $data = json_decode($response->getBody(), true);

        // Extract and return the performance score as a percentage.
        return response()->json([
            'performance_score' => $data['lighthouseResult']['categories']['performance']['score'] * 100,
        ]);
    }
}
