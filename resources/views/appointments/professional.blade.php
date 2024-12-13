<div class="container mx-auto px-4 mt-12 mb-12">
    <h1 class="text-3xl font-bold text-red-600 mb-6">View Appointments</h1>

    <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold text-red-600 mb-4">Pending Appointments</h2>
        @forelse ($schedules->where('status', 'Pending') as $schedule)
            <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                <div>
                    <strong class="text-red-600">{{ Carbon\Carbon::parse($schedule->date)->format('d F Y H:i') }}</strong><br>
                    <strong class="text-gray-800">Patient's Name:</strong> {{ $schedule->account->name }}<br>
                    <div class="mb-3"><strong class="text-gray-800">Reason:</strong> {{ $schedule->reason }}<br></div>
                    <span class="bg-yellow-100 text-yellow-800 py-1 px-2 rounded">{{ $schedule->status }}</span>
                </div>
                <div class="flex justify-end">
                    <form action="{{ route('accept.appointments', $schedule->id) }}" method="POST" class="mr-4">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white font-semibold py-1 px-2 rounded hover:bg-green-600">Accept</button>
                    </form>
                    <form action="{{ route('deny.appointments', $schedule->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white font-semibold py-1 px-2 rounded hover:bg-red-700">Deny</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have no pending appointments.</p>
        @endforelse

        <h2 class="text-2xl font-bold text-red-600 mt-8 mb-4">Accepted Appointments</h2>
        @forelse ($schedules->where('status', 'Accepted') as $schedule)
            <div class="border-b border-gray-200 py-4 flex justify-between items-center">
                <div>
                    <strong class="text-red-600">{{ Carbon\Carbon::parse($schedule->date)->format('d F Y H:i') }}</strong><br>
                    <strong class="text-gray-800">Patient's Name:</strong> {{ $schedule->account->name }}<br>
                    <div class="mb-3"><strong class="text-gray-800">Reason:</strong> {{ $schedule->reason }}<br></div>
                    <span class="bg-green-100 text-green-800 py-1 px-2 rounded">{{ $schedule->status }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have no accepted appointments.</p>
        @endforelse
    </div>
</div>
