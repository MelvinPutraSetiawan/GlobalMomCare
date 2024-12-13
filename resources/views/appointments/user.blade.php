<div class="container mx-auto px-4 mt-12 mb-12">
    <h1 class="text-3xl font-bold text-red-600 mb-6">Add Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('add.appointments') }}" method="POST">
            @csrf
            <label for="doctor" class="block text-sm font-medium text-gray-700">Choose Doctor:</label>
            <select name="doctor" id="doctor" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500">
                @foreach ($professionals as $professional)
                    <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                @endforeach
            </select>

            <label for="reason" class="block text-sm font-medium text-gray-700 mt-4">Reason for Appointment:</label>
            <textarea name="reason" id="reason" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500"></textarea>

            <label for="appointment_date" class="block text-sm font-medium text-gray-700 mt-4">Appointment Time:</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" required class="mt-1 block border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500" min="{{ now()->format('Y-m-d\TH:i') }}">

            <button type="submit" class="mt-4 bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-500">Add Appointment</button>
        </form>
    </div>

    <h1 class="text-3xl font-bold text-red-600 mb-4">Your Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
        @forelse ($schedules as $schedule)
            <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                <div>
                    <strong class="text-red-600">{{ Carbon\Carbon::parse($schedule->date)->format('d F Y H:i') }}</strong><br>
                    <strong class="text-gray-800">Doctor:</strong> {{ $schedule->professional->name }}<br>
                    <div class="mb-3"><strong class="text-gray-800">Reason:</strong> {{ $schedule->reason }}<br></div>
                    @if ($schedule->status == 'Pending')
                        <span class="bg-yellow-100 text-yellow-800 py-1 px-2 rounded">{{ $schedule->status }}</span>
                    @elseif ($schedule->status == 'Accepted')
                        <span class="bg-green-100 text-green-800 py-1 px-2 rounded">{{ $schedule->status }}</span>
                    @elseif ($schedule->status == 'Denied')
                        <span class="bg-red-100 text-red-800 py-1 px-2 rounded">{{ $schedule->status }}</span>
                    @endif
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
