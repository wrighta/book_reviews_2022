<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Book Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--alert-success is a component which I created using php artisan make:component alert-success
            have a look at the code in views/components/alert-success.blade.php -->
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex">

                <!-- when EDIT BUTTON is clicked, route to admin.books.edit -->
                <a href="{{ route('admin.books.edit', $book) }}" class="btn-link ml-auto">Edit</a>

                <!-- delete button is wrapped in a form, with the delete method. -->
                <form action="{{ route('admin.books.destroy', $book) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to delete?')">Delete </button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td rowspan="20">
                                <!-- use the asset function, access the file $book->book_image in the folder storage/images -->
                                <img src="{{asset('storage/images/' . $book->book_image) }}" width="1000" />
                            </td>
                        </tr>


                        <tr>
                            <td class="font-bold ">Title  </td>
                            <td>{{ $book->title }}</td>
                        </tr>
                        {{-- <tr>
                            <td class="font-bold ">Author  </td>
                            <td>{{ $book->author }}</td>
                        </tr> --}}
                        <tr>
                            <td class="font-bold">Description </td>
                            <td>{{ $book->description }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Category </td>
                            <td>{{ $book->category }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold ">Publisher Name </td>
                            <td>{{ $book->publisher->name }}</td>
                        </tr>

                        <tr>
                            <td class="font-bold ">Publisher Address </td>
                            <td>{{ $book->publisher->address }}</td>
                        </tr>

                        @foreach ($book->authors as $author)
                            <tr>
                                <td class="font-bold ">Author </td>
                                <td> {{$author->name }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
