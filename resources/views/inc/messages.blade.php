<div class="jumbotron ">
        <div class="container pr-5">
                @foreach ($errors->all() as $error)
                        @if(count($errors)>0)
        
       
            
                        <div class="alert alert-danger">

                         {{ $error }}
                          </div>
                          @endif
                @endforeach
                                
                   

                @if (session('success'))
                           <div class="alert alert-success">

                                {{ session('success') }}
                          </div>
    
                @endif

                @if (session('error'))
                          <div class="alert alert-danger">

                                {{ session('error') }}
                          </div>
    
                @endif
        </div>
</div>