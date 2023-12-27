<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\SeatAllocation;
use App\Models\Ticket;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $trip = 1;
//        $trips = Trip::with('bus', 'tickets', 'seats')->get();
//        dd($trips->first()->seats->pluck('ticket_id', 'seat_number'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($trip)
    {
        $trip_id = decrypt($trip);
        $trip = Trip::with( 'bus', 'tickets', 'seats')->findOrFail($trip_id);
        $tickets = $trip->seats->pluck('id', 'seat_number');
        return view('front.tickets.create', compact('trip', 'tickets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $trip)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:200',
                'email' => 'required|email',
                'seat_number' => 'required',
                'trip_date' => 'required|date|after_or_equal:today',
                'address' => 'nullable|string|max:1000',
                'phone_number' => 'required|string'
            ]);

            $user_data = [
                'email' => $validated['email'],
                'name' => $validated['name'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
                'password' => Hash::make('password')
            ];

            $user = User::create($user_data);

            $ticket_data = [
                'trip_date' => $validated['trip_date'],
                'trip_id' => decrypt($trip),
                'quantity' => count($validated['seat_number']),
            ];

            $ticket = $user->tickets()->create($ticket_data);
            $seat_allocations = [];

            foreach($validated['seat_number'] as $key => $seat) {
                $seat_allocations[] = new SeatAllocation([
                    'seat_number' => $key
                ]);
            }

            if(count($seat_allocations)) {
                $ticket->seats()->saveMany($seat_allocations);
            }

            DB::commit();

            return to_route('search.index')->with('success', 'Ticket purchased successfully!');
        }catch(\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }

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
