@extends('front.app')


@section('content')

    <div class="mx-auto max-w-xl">
        <x-custom.form-messages/>
        <!-- form controls -->
        <form action="{{ route('ticket.store', encrypt($trip->id)) }}" class="space-y-5 border p-6 rounded" method="POST">
            @csrf
            <div>
                <label for="name">Your Name <span class="text-danger">required</span></label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-input" />
            </div>
            <div>
                <label for="email">Email <span class="text-danger">required</span></label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" />
            </div>

            <div>
                <label for="phone_number">Contact Number <span class="text-danger">required</span></label>
                <input id="phone_number" name="phone_number" type="text" value="{{ old('phone') }}" class="form-input" />
            </div>

            <div>
                <label for="address">Address</label>
                <textarea id="address" name="address" class="form-input">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="fare">Fare</label>
                <p class="form-input">{{ $trip->price }}</p>
            </div>


            <div>
                <p class="pb-3">Select your seats <span class="text-danger">required</span></p>
                <div class="grid grid-cols-4" x-data="{
                    price: {{ $trip->price }}
                    count: 0
            }">
                    @for($i = 1; $i <= (int) $trip->bus->seat_capacity; $i++)
                        <x-custom.form.checkbox
                            :label="$i"
                            :name="'seat_number[' . $i . ']'"
                            :id="'seat_number_'.$i"
                            :disable="($tickets->has($i) ? 'disabled': '')"
                            :check="(is_array(old('seat_number')) && array_key_exists($i, old('seat_number'))) ? 'checked': ''"
                        />
                    @endfor
                </div>
            </div>

            <div>
                <label for="trip_date">Date:</label>
                <input id="trip_date" name="trip_date" type="date" value="{{ old('trip_date') }}" class="form-input" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    Buy
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style type="text/css">
        .peer:disabled~.peer-checked\:bg-primary {
            background: rgb(255 0 0 / var(--tw-bg-opacity)) !important;
        }
        .peer:disabled~.peer-checked\:bg-primary::before {
            left: 1.75rem;
        }
    </style>
@endpush
