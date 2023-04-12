@extends('layouts.app')
@section('content')
 
<script src="{{ asset('js/custom.js') }}" defer></script>
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="justify-content-center btn btn-secondary">Back</a>
                    <a href="{{ route('users') }}" class="float-end btn btn-secondary ">discover users</a>
                     
                
                </div>
                <div class="card-body">
                    <div class="row pl-5">
                        @if ($user->followings()->get()->count()==0)
                        <p>You don't follow any user yet , <b> discover users</b> and follow them!! </p>
                    @else
                        @include('profiles.userList', ['users'=>$user->followings()->get()])
                 
                 @endif

                 
                 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 