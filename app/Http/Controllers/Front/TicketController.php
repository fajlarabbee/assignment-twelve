<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($trip)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($trip)
    {
        $trip_id = decrypt($trip);
        $trip = Trip::with( 'bus', 'tickets')->findOrFail($trip_id);
        return view('front.tickets.create', compact('trip'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $trip)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email',
            'seat_number' => 'required',
            'date' => 'required|date',
            'address' => 'nullable|string|max:1000',
            'phone_number' => 'required|string'
        ]);

        $user_data = [
            'email' => $validated->email,
            'name' => $validated->name,
            'address' => $validated->address,
            'phone_number' => $validated->phone_number
        ];

        $ticket_data = [
            'user_id',
            'trip_id' => decrypt($trip),
            'number_of_tickets' => count($validated->seat_number),
        ];
        
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
