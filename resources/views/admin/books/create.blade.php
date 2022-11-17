<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Title"
                        class="w-full"
                        autocomplete="off"
                        :value="@old('title')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="category"
                        field="category"
                        placeholder="category..."
                        class="w-full mt-6"
                        :value="@old('category')"></x-text-input>

                    <x-textarea
                        name="description"
                        rows="10"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="@old('description')"></x-textarea>

                    <x-text-input
                        type="text"
                        name="author"
                        field="author"
                        placeholder="Author..."
                        class="w-full mt-6"
                        :value="@old('author')"></x-text-input>

                    <x-file-input
                        type="file"
                        name="book_image"
                        placeholder="Book"
                        class="w-full mt-6"
                        field="book_image">
                    </x-file-input>

                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <select name="publisher_id">
                          @foreach ($publishers as $publisher)
                            <option value="{{$publisher->id}}" {{(old('publisher_id') == $publisher->id) ? "selected" : ""}}>
                              {{$publisher->name}}
                            </option>
                          @endforeach
                     </select>


                    <x-primary-button class="mt-6">Save Book</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
