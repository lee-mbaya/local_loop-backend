<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BusinessController extends Controller
{
    /**
     * Store a new business with geocoding.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string', // address instead of lat/lng
        ]);

        // Geocode the address to get latitude and longitude
        $coordinates = $this->geocodeAddress($validated['address']);

        if (!$coordinates) {
            return response()->json(['error' => 'Invalid address'], 400);
        }

        // Create a new business record
        $business = Business::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'latitude' => $coordinates['lat'],
            'longitude' => $coordinates['lng'],
        ]);

        return response()->json($business, 201); // Return the created business
    }

    /**
     * Geocode address to get latitude and longitude.
     */
    private function geocodeAddress($address)
    {
        $apiKey = 'YOUR_GOOGLE_API_KEY'; // Replace with your actual API key
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . $apiKey;

        // Send a request to Google Maps API
        $response = Http::get($url);

        // Check if the response is valid
        if ($response->successful() && isset($response['results'][0])) {
            $location = $response['results'][0]['geometry']['location'];
            return [
                'lat' => $location['lat'],
                'lng' => $location['lng'],
            ];
        }

        return null; // Return null if geocoding failed
    }
}
