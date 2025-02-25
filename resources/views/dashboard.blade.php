<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Set Alert Thresholds</h2>
            <form action="{{ route('user.preferences.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-2">Precipitation Threshold (mm):</label>
                    <input type="number" name="precipitation_threshold"
                           value="{{ auth()->user()->preferences->precipitation_threshold ?? '' }}"
                           class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium mb-2">UV Index Threshold:</label>
                    <input type="number" name="uv_index_threshold"
                           value="{{ auth()->user()->preferences->uv_index_threshold ?? '' }}"
                           class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md">
                    Save
                </button>
            </form>
        </div>
            <div class="container mx-auto p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Check Weather</h1>

                <div class="bg-white shadow-lg rounded-lg p-6">
                    <form action="{{ route('weather.check') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold text-lg mb-3">Select Cities:</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <!-- Example cities -->
                                @foreach (['London', 'New York', 'Paris', 'Tokyo', 'Berlin', 'Sydney'] as $city)
                                    <label class="flex items-center bg-gray-100 p-3 rounded-lg shadow-sm hover:bg-gray-200 cursor-pointer">
                                        <input type="checkbox" name="cities[]" value="{{ $city }}"
                                               class="rounded border-gray-300 text-blue-500 focus:ring focus:ring-blue-300">
                                        <span class="ml-3 text-gray-800 font-medium">{{ $city }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition">
                            Check Weather
                        </button>
                    </form>
                </div>
            </div>
    </div>
</x-app-layout>
