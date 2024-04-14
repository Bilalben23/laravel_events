<x-main-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All galleries</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @forelse ($galleries as $gallery)
                <div class="lg:flex">
                    <img class="object-cover w-full h-36 rounded-lg lg:w-36" src="{{ asset('/storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}">
                </div>
                @empty
                <p>No Galleries to show</p>
                @endforelse
                {{ $galleries->links() }}
            </div>
        </div>
    </section>

</x-main-layout>
