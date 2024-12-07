@extends('layouts.main')

@section('title', 'Appointments')

@section('content')

<div class="container mx-auto px-4 mt-12 mb-12">
    <h1 class="text-3xl font-bold text-red-600 mb-6">Add Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('add.appointments') }}" method="POST">
            @csrf
            <label for="hospital_name" class="block text-sm font-medium text-gray-700">Hospital Name:</label>
            <input type="text" name="hospital_name" id="hospital_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <label for="hospital_address" class="block text-sm font-medium text-gray-700 mt-4">Hospital Address:</label>
            <input type="text" name="hospital_address" id="hospital_address" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mt-4">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" required class="mt-1 block border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">

            <button type="submit" class="mt-4 bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-500">Add Appointment</button>
        </form>
    </div>

    <h1 class="text-3xl font-bold text-red-600 mb-4">Your Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
        @forelse ($schedules as $schedule)
            <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                <div>
                    <strong class="text-red-600">{{ Carbon\Carbon::parse($schedule->date)->format('d F Y') }}</strong><br>
                    <strong class="text-gray-800">Hospital Name:</strong> {{ $schedule->hospital->name }}<br>
                    <strong class="text-gray-800">Hospital Address:</strong> {{ $schedule->hospital->address }}
                </div>
                <form action="{{ route('delete.appointments', $schedule->id) }}" method="POST" class="ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-500 font-semibold">Remove</button>
                </form>
            </div>
        @empty
            <p class="text-gray-500">You have no appointments.</p>
        @endforelse
    </div>
</div>

@endsection