<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">

            <div class="font-semibold text-xl text-gray-800 leading-tight inline-block mt-5">
                    <h1>
                        Learning Posts
                    </h1>
            </div>
    
            @if (Auth::check())
                <div class=" pt-15 w-4/5 m-auto flex justify-end">
                    <a
                        href="/learning/create"
                        class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Create Post
                    </a>
                </div>
            @endif

        </div>

    </x-slot>
    <div>

        

            @if (session()->has('message'))         
                <div class="w-4/5 m-auto mt-10 pl-2">
                    <p class="w-1/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 pl-3">
                        {{session()->get('message')}}
                    </p>"
                </div>
            @endif


        

        

                

                @foreach ($posts as $post)
                    <div class="pl-8 pb-4 sm:grid grid-cols-2 gap-20 w-4/5 mx-auto my-5 py-15 border-b border-gray-200 " style="outline: none;">
                        <div style=" position:relative; width: 300px; height: 300px; display: flex; justify-content: center; align-items: center; overflow: hidden; border: 2px solid #ccc; border-radius: 10px; margin-left: 12rem;">
                            <img src="{{ asset('images/' . $post->image_path) }}" alt="" style="max-width: 100%; max-height: 100%;" />
                        </div>
                        <div style="position: relative;">
                            <h2 class="text-gray-700 font-bold text-5xl pb-4">
                                {{ $post->title }}
                            </h2>

                            <span class="text-gray-500">
                                By <span class="font-bold italic text-gray-800"> {{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
                            </span>

                            <p class="text-xl text-gray-700 pt-3 pb-6 leading-8 font-light">
                                {{ Str::limit($post->description, 100, '...') }}
                            </p>

                            <div style="position: absolute; bottom: 1.2rem; left: 0;">
                                <a href="/learning/{{ $post->learningID }}" 
                                    class=" text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    More Info
                                </a>
                            </div>


                                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                                    <span class="float-right" style="position: absolute; bottom: 1rem; right: 4.5rem;" >
                                        <a 
                                            href="/learning/{{ $post->learningID}}/edit"
                                            class="text-gray-700 italic hover:text-gray-900
                                            pb-1 border-b-2">
                                            Edit
                                        </a>
                                    </span>

                                    <span class="float-right" style="position: absolute; bottom: 1rem; right: 0;">
                                        <form 
                                            action="{{ route('learning.destroy', ['learning' => $post->learningID]) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')

                                            <button
                                                class="text-red-500 pr-3"
                                                type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    </span>
                            
                            @endif
                        </div>
                    </div>
                @endforeach


    </div>
</x-app-layout>