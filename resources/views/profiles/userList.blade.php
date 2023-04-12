@if($users->count())
    @foreach($users as $user)
        <div class="col-2 profile-box border p-1 rounded text-center bg-light mr-4 mt-3 ">
            <img src="/storage/profilepic/{{ $user->profilepic }}" style="height: 50px; width: 50px; border-radius: 50%;" class="img-responsive">
            <h5 class="m-0"><a href="{{ route('profile', $user->id) }}"><strong>{{ $user->name }}</strong></a></h5>
          

              </div>
    @endforeach
@endif