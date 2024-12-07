@extends('layouts.main')

@section('title', 'Pregnancy Calendar')

@section('content')

<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md border border-red-300 mt-12">
    <form action="{{ route('pregnancy.calculate') }}" method="POST" class="space-y-4">
        @csrf
        <div class="flex flex-col">
            <label for="last_period" class="text-lg font-semibold text-gray-700">First Day of Last Menstrual Period:</label>
            <input type="date" id="last_period" name="last_period" class="border p-2 rounded-md mt-2" required>
        </div>

        <div>
            <button type="submit" class="w-full bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                Calculate
            </button>
        </div>
    </form>

    @if (isset($dueDate) && isset($pregnancyWeeks) && isset($pregnancyDays))
        <div class="mt-8">
            <p class="text-xl font-semibold text-gray-800">Due Date: <span class="text-red-500">{{ $dueDate->format('F j, Y') }}</span></p>
            
            <p class="text-lg text-gray-700 mt-2">
                Current Pregnancy Stage: 
                <span class="font-semibold text-red-500">{{ $pregnancyWeeks }} weeks and {{ $pregnancyDays }} days</span>
            </p>
        </div>
    @endif
</div>

@endsection
