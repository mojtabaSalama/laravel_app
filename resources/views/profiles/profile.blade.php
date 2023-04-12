@extends('posts.index')



@section('header')
<script src="{{ asset('js/custom.js') }}" defer></script>



<div class="container   mb-3 ">
<div class="card  mb-1 " style="width: 32rem;" >
    <div class="card-body">
        
     

   
     <p><img src="/storage/profilepic/{{ $user->profilepic }}" width="25px"   class="rounded-circle">
         <h2 class="card-title mr-5">{{ $user->name }}</h2>

        @if ($user->id!=auth()->user()->id)
            
         {!! Form::open(['Action' => 'App\Http\Controllers\ProfileController@follwUserRequest ','method'=>'POST']) !!}
         
         
         <button class="btn btn-info follow"  data-id="{{ auth()->user()->id }}">
          <strong>
                @if(auth()->user()->isFollowing($user))
                    UnFollow
                @else
                    Follow
                @endif
              </strong>
            </button>
            
            
            {!! Form::close() !!}
            @endif
     </p>

        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link " href="{{ route('followers',$user->id)}}"   >Followers <span class="badge badge-primary text-dark">{{ $user->followers()->get()->count() }}</span></a>
            <a class="nav-item nav-link"  href="{{  route('followings',$user->id)}}"   >Following <span class="badge badge-primary text-dark">{{ $user->followings()->get()->count() }}</span></a>
          </div>
        </nav>
        





     @if ($user->id==auth()->user()->id)
     
     <a href="/profile/{{auth()->user()->id}}/edit"> edit profile</a>
     
     
     @endif
    
    


 </div>
          
    </div>
</div>

</div>

    


@endsection   

