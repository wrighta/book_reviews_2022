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

                <a href="{{ route('books.edit', $book) }}" class="btn-link ml-auto">Edit</a>
                <form action="{{ route('books.destroy', $book) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure you want to delete?')">Delete </button>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td class="font-bold ">Title  </td>
                            <td>{{ $book->title }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Author  </td>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Description </td>
                            <td>{{ $book->description }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold ">Category </td>
                            <td>{{ $book->category }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
