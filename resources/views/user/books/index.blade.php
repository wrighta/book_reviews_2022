<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Books') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            @forelse ($books as $book)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                    <a href="{{ route('user.books.show', $book) }}">{{ $book->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $book->category }}
                        {{-- {{$book->author}} --}}
                        {{$book->description}}

                    </p>

                </div>
            @empty
            <p>No books</p>
            @endforelse
            <!-- This line of code simply adds the links for Pagination-->
            {{$books->links()}}
        </div>
    </div>
</x-app-layout>
