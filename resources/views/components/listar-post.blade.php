<div>
    @auth
        <h1>
            @if($posts->count())
        <div class="flex items-center justify-center">
            <div class="w-1/2">
                @foreach ($posts as $post)
                    <div class="p-5">
                        <div class="flex gap-2 m-1 items-center">
                            <div class="rounded-3xl overflow-hidden">
                                <a href="{{route('posts.index',['user' => $post->user])}}">
                                    <img class="w-8 h-8 md:w-11 md:h-11" src="{{asset('perfiles') .'/' . $post->user->imagen}}">
                            </div>
                            <p class="text-gray-500">{{$post->user->username}}</p> </a>
                        </div>
                        <div class="m-2 overflow-hidden rounded-lg">
                            <a href="{{route('posts.show',['post' => $post, 'user' => $post->user])}}">
                                <img src="{{asset('uploads') . '/' . $post->imagen}}" 
                                alt="imagen del post {{$post->titulo}}">
                            </a>
                        </div>
                        <div class="mx-2">
                            <livewire:like-post :post="$post"/>
                        </div>
                    </div>
                
                @endforeach
                
            </div>
            <div class="my-10">
                {{-- paginacion --}}
                {{$posts->links()}}
            </div>
        @else
            <p class="text-center">No Sigues a nadie</p>
        @endif
        </div>
        </h1>
     @endauth
   
</div>