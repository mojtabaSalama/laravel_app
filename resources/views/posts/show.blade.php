@extends('layouts.app')

@section('content')

    <div class="container">
    
        <div class="card  " style="width: 32rem;" >            
        <div class="card-body">
            <a href="/profile/{{ $post->user->id }}"><img src="/storage/profilepic/{{ $post->user->profilepic }}" alt="img" width="55px" height="55px" class="rounded-circle mr-3">
                 </a>
                 <a href="/profile/{{ $post->user->id }}" class="text-dark text-decoration-none ">
                    <h2> {{ $post->user->name }}</h2>
                      </a>
            
                <a  href="/posts/{{ $post->id }}  " class=" text-justify text-dark text-decoration-none">
                   <p class="card-text" > {{ $post->body }}  </p>
                    @if ($post->image!=null)
                        
                    
                   <img src="/storage/image/{{$post->image }}" style="width:100%" alt="body image">
                   
                   @endif        
                </a>
            
          
      
      
     @if (auth()->user())
     <form action="{{ route('like.post', $post->id) }}"
        method="post">
        @csrf
        <button
            class="{{ $post->liked() ? 'btn-primary' : 'btn-secondary' }} mt-2">
            like {{ $post->likeCount }}
        </button>
    </form>
    
    <small> at {{ $post->created_at }}</small>
     <hr>
     @if ($post->user->id==auth()->user()->id)
         
     
      {!! Form::open(['Action' => 'App\Http\Controllers\PostController@destroy ','method'=>'POST']) !!}
      {{ Form::hidden('_method','DELETE') }}
      {{ Form::token(); }}
      
      <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">edit</a>
      {{  Form::submit('delete',['class'=>'btn btn-secondary  ' ]) }}
      {!! Form::close() !!}
      @endif
          
      @else
      <br>
            <small> at {{ $post->created_at }}</small>    
    
      
      @endif
    </div>
        
    </div>   
    
    </div>

@endsection