<x-main-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Events</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @forelse ($events as $event)
                    <div class="lg:flex">
                        <img class="object-cover w-full h-36 rounded-lg lg:w-36"
                            src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}">
                        <div class="flex flex-col justify-between py-6 lg:mx-6">
                            <a href="{{ route('eventShow', $event->id) }}"
                                class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                                {{ $event->title }}
                            </a>
                            <span class="text-sm text-gray-500 dark:text-gray-300">{{ $event->country->name }}</span>
                            <p class="text-sm text-gray-500 dark:text-gray-300">
                                @foreach ($event->tags as $tag)
                                    <span class="text-sm text-gray-500 dark:text-gray-300"> {{ $tag->name }} </span>
                                @endforeach
                            </p>
                        </div>
                    </div>
                @empty
                    <p>No Events to show</p>
                @endforelse
                {{ $events->links() }}
            </div>
        </div>
    </section>

</x-main-layout>
