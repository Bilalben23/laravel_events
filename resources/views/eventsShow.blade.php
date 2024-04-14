<x-main-layout>

    <section class="p-8">
        <div class="flex items-center justify-between text-white">
            <!-- Event Image -->
            <div>
                <img src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-64 object-cover rounded-lg">
            </div>

            <!-- Event Details -->
            <div class="ml-8">
                <h2 class="text-2xl font-bold text-white">{{ $event->title }}</h2>
                <p class="text-white mt-2"><i class='bx bxs-location-plus'></i> {{ $event->country->name }},
                    {{ $event->city->name }}</p>
                <p class="text-white">Start: <u> {{ $event->toArray()['start_date'] }} </u> at
                    <time>{{ $event->start_time }}</time>
                </p>
                <p class="text-white mt-2">{{ $event->description }}</p>

                @auth
                <div class="mt-4">
                    <form action="{{ route("events.comments", $event->id) }}" method="POST" class="flex justify-between">
                        @csrf
                        <input type="text" placeholder="Write a comment..." name="content" class="w-full mr-3 px-4 py-2 bg-gray-900 text-white border border-gray-600 rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                        <button class="bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300" type="submit">
                            {{ __('Post') }}
                        </button>
                    </form>
                </div>
                @endauth
            </div>

        </div>

        @auth
        <div class="flex mt-4 space-x-4">
            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring focus:border-blue-300" x-data="{ eventLike: @js($like) }" x-bind:class="{ 'bg-blue-500 text-white': eventLike, 'bg-gray-200 text-gray-700': !eventLike }" x-on:click.prevent="axios.post(`/events-like/{{ $event->id }}`).then(res => { eventLike = res.data; })">
                <template x-if="eventLike">
                    <i class='bx bxs-like'></i>
                </template>
                <template x-if="!eventLike">
                    <i class='bx bx-like'></i>
                </template>
                {{ __('Like') }}
            </button>

            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring focus:border-blue-300" x-data="{ savedEvent: @js($savedEvent) }" x-bind:class="{ 'bg-red-500 text-white': savedEvent, 'bg-gray-200 text-gray-700': !savedEvent }" x-on:click.prevent="axios.post(`/events-save/{{ $event->id }}`).then(res => { savedEvent = res.data; })">
                <template x-if="savedEvent">
                    <i class='bx bxs-save'></i>
                </template>
                <template x-if="!savedEvent">
                    <i class='bx bx-save'></i>
                </template>
                {{ __('Save') }}
            </button>

            <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring focus:border-blue-300" x-data="{ attending: @js($attending) }" x-bind:class="{ 'bg-green-500 text-white': attending, 'bg-gray-200 text-gray-700': !attending }" x-on:click.prevent="axios.post(`/events-attending/{{ $event->id }}`).then(res => { attending = res.data; })">
                {{ __('Attending') }}
                <i class='bx bx-right-arrow-alt'></i>
            </button>
        </div>

        <!-- Host Info -->
        <div class="mt-8 border-t pt-4">
            <h2 class="text-xl font-semibold text-blue-500 mb-2">Host Info</h2>
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-300 rounded-full mr-4"></div> <!-- User Image Placeholder -->
                <div>
                    <p class="text-white font-semibold">{{ $event->user->name }}</p>
                    <p class="text-gray-400">{{ $event->user->email }}</p>
                </div>
            </div>
        </div>
        @endauth
        @auth
        @forelse ($event->comments()->latest()->get() as $comment)
        <div class="bg-gray-900 shadow-md rounded-md p-2 my-3 border rounded-md">
            <div class="flex items-center mb-2 ">
                <div class="ml-2">
                    <h3 class="text-lg text-white font-semibold">{{ $comment->user->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <p class="text-white">{{ $comment->content }}</p>

            @can('view', $comment)

            <form action="{{ route("events.comments.destroy", [$event->id, $comment->id]) }}" method="POST" class="mt-3">
                @csrf
                @method("DELETE")
                <button type="submit" class="px-3 py-1 rounded-md bg-red-500 text-white shadow hover:bg-red-400">{{ __("Delete") }}</button>
            </form>
            @endcan


        </div>

        @empty
        <p>No Comments here ...</p>
        @endforelse

        @endauth
    </section>

</x-main-layout>
