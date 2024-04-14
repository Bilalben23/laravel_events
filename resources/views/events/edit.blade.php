<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Rdit Your Event') }}
        </h2>
    </x-slot>
    {{-- Alphine.js --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('events.update', $event) }}" method="POST" x-data="{
                country: null,
                cityId: @js($event->city_id),
                cities: @js($event->country->cities),
                onCountryChange(event) {
                    axios.get(`/countries/${event.target.value}`).then(res => {
                        this.cities = res.data
                    })
                }
            }"
                enctype="multipart/form-data" class="p-4 bg-white dark:bg-slate-800 rounded-md">
                @csrf
                @method('PUT')
                <div class="grid gap-6 md:grid-cols-2">
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Laravel Event...">
                    @error('title')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="country_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        an option</label>

                    <select id="country_id" name="country_id" x-on:change="onCountryChange"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500">
                        <option>Choose a country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}" @selected($country->id === $event->country_id)>{{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="city_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        an option</label>
                    <select id="city_id" name="city_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500">
                        <template x-for="city in cities" :key="city.id">
                            <option x-bind:value="city.id" x-text="city.name" :selected=city.id===cityId">
                            </option>
                        </template>
                    </select>
                    @error('city_id')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                    <input type="text" id="addresss" name="address" value="{{ old('address', $event->address) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Address...">
                    @error('address')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                        File</label>
                    <input type="file" id="file_input" name="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Address...">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                        Date</label>
                    <input type="date" id="start_date" name="start_date"
                        value="{{ old('start_date', $event->start_date) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Start Date...">
                    @error('start_date')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                        Date</label>
                    <input type="date" id="end_date" name="end_date"
                        value="{{ old('end_date', $event->end_date) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="End Date...">
                    @error('end_date')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                        Time:</label>
                    <input type="time" id="start_time" name="start_time"
                        value="{{ old('start_time', $event->start_time) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Start Time...">
                    @error('start_time')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="num_tickets" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Number
                        Of Tickets:</label>
                    <input type="number" id="num_tickets" name="num_tickets"
                        value="{{ old('num_tickets', $event->num_tickets) }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Number of Tickets...">
                    @error('num_tickets')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description:</label>
                    <textarea type="text" id="description" name="description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Type your thoughts here...">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Tags</h3>
                    <ul class="items-center w-full text-medium text-gray-900 bg-white border-gray-200 rounded-sm">
                        @foreach ($tags as $tag)
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="vue-checkbox-list" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}" @checked($event->hasTag($tag)) class="w-4">
                                    <label for="vue-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900">{{ $tag->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @error('tags')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5">
                    <button type="submit"
                        class="text-white p-2  bg-blue-700 hover:bg-blue-800 focus-ring-4 focus:ring-blue-300 font-semibold">{{ __('Update') }}</button>
                </div>

            </form>
        </div>
    </div>
</x-main-layout>
