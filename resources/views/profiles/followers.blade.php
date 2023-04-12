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
                        <h4> <span class="badge bg-light text-dark"> followers:</span></h4> 
            @if ($user->followers()->get()->count()==0)
                <p>No user follows you , <b> discover users</b> and let them know you </p>
            @else
                
                      
                        @include('profiles.userList', ['users'=>$user->followers()->get()])

            @endif 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 