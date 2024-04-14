<x-main-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New gallery') }}
        </h2>
    </x-slot>
    {{-- Alphine.js --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data"
                class="p-4 bg-white dark:bg-slate-800 rounded-md">
                @csrf
                <div>
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Caption</label>
                    <input type="text" id="caption" name="caption" value="{{ old('caption') }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Laravel Event...">
                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="file_input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
                        File</label>
                    <input type="file" id="file_input" name="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500"
                        placeholder="Address...">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5">
                    <button type="submit"
                        class="text-white p-2  bg-blue-700 hover:bg-blue-800 focus-ring-4 focus:ring-blue-300 font-semibold">{{ __('Create') }}</button>
                </div>

            </form>
        </div>
    </div>
</x-main-layout>
