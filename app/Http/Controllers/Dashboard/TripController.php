<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Models\Location;
use App\Models\Route;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::with( 'route', 'departureLocation', 'destinationLocation')->latest('id')->paginate(10);
        return view('backend.trips.index', compact('trips'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::get();
        $routes = Route::where('status', '=', Status::ACTIVE->value)->get();
        $buses = Route::where('status', '=', Status::ACTIVE->value)->get();
        return view('backend.trips.create', compact('locations', 'routes', 'buses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        Trip::create($request->validated());

        return back()->with('success', 'Trip added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
