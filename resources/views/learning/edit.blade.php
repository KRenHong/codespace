<x-app-layout>
    <div>

        <div class="w-4/5 m-auto text-left">
            <div class="py-15">
                <h1 class="text-6xl">
                    Update Posts
                </h1>
            </div>
        </div>

        @if ($errors->any())
            <div class="w-4/5 m-auto">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                            {{ $error }}
                    @endforeach
                </ul>
        @endif

        <div class="w-4/5 m-auto pt-20">
            <form
                action="/learning/{{ $learning->learningID }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input
                    type="text"
                    name="title"
                    value="{{ $learning->title}}"
                    class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

                    <textarea
                    name="description"
                    placeholder="Description"
                    class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $learning->description }}</textarea>

                    <button \
                        type="submit"
                        class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                        Submit Post

                    </button>
            </form>

    </div>
</x-app-layout>