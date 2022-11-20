<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Publishers') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @forelse ($publishers as $publisher)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                    <a href="{{ route('user.publishers.show', $publisher) }}"> <strong> Publisher ID </strong> {{ $publisher->id }}</a>
                    </h2>
                    <p class="mt-2">

                        <h3> <strong> Publisher Name </strong>
                        {{$publisher->name}} </h3>
                        <h3> <strong> Publisher Address </strong>
                        {{$publisher->address}}

                    </p>

                </div>
            @empty
            <p>No pubishers found</p>
            @endforelse
            <!-- This line of code simply adds the links for Pagination-->
            {{-- {{$publishers->links()}} --}}
        </div>
    </div>
</x-app-layout>
