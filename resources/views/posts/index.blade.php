@extends('layouts.app')



@section('content')
@include('posts.newpost')

<div class="container    ">
            @if (count($posts)>0)
                    @foreach ($posts as $post)
                    
                        <div class="card  mb-1 " style="width: 32rem;" >
                    <div class="card-body">
                        <a href="/profile/{{ $post->user->id }}"><img src="/storage/profilepic/{{ $post->user->profilepic }}" alt="img" width="55px" height="55px" class="rounded-circle mr-3">
                        </a>
                        <a href="/profile/{{ $post->user->id }}" class="text-dark text-decoration-none ">
                           <h2> {{ $post->user->name }}</h2>
                             </a>
                        
                            <a class="card-text text-justify text-dark text-decoration-none" href="/posts/{{ $post->id }}">

                               <h6> {{ $post->body }}   </h6>
                            
                               @if ($post->image!=null)
                            <img src="/storage/image/{{ $post->image }}" style="width:100%" alt="body image">
                            @endif
                            
                            </a>
                            <hr>
                            @if (auth()->user())
                            <form action="{{ route('like.post', $post->id) }}"
                                method="post">
                                @csrf
                                <button
                                    class="{{ $post->liked() ? 'btn-primary' : 'btn-secondary' }} ">
                                    like {{ $post->likeCount }}
                                </button>
                            </form>
                            @endif
    
                        <br>
                       
                    </div>
                    
                </div>
                    
                    @endforeach    
                
                
                
                @else

            
                <h3 > posts not found</h3>

                @endif
    
            </div>
@endsection