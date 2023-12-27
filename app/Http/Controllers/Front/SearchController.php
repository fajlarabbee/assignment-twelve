<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SearchController extends Controller
{
    public function index()
    {
        $locations = Location::get();

        return view('front.index', compact('locations'));
    }

    public function search(Request $request)
    {
        $origin = $request->origin;
        $destination = $request->destination;
        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        if(Carbon::today() > $date) {
            return back()->with('error', 'Past date not allowed');
        }
        $day = strtolower($date->dayName);




        $trip = Trip::query();

        if($origin) {
            $trip->where('departure_location_id', '=', $origin);
        }

        if($destination) {
            $trip->where('destination_location_id', '=', $destination);
        }

        if($day) {
            $trip->whereJsonContains("available_days->{$day}", 'on');
        }

        $results = $trip->with('bus', 'tickets')->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('front.search-results', compact('results'));
    }
}
