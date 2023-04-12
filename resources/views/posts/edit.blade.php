@extends('layouts.app')



@section('content')
<div class="container">
<h1> edit post :</h1>
{!! Form::open(['Action' => 'App\Http\Controllers\PostController@update ','method'=>'POST']) !!}
<div class="form-group">
    {{ Form::textarea('body',$post->body,['class'=>'form-control ','placeholder'=>'what are you thinking about?!']) }}
{{ Form::file('image',['class'=>'mt-3']) }}
<br>

</div>
{{  Form::submit('edit',['class'=>'btn btn-primary mt-2']) }} 
<a href="/" type="button" class="btn mt-2" >cancel</a>
    {!! Form::close() !!}
</div>
@endsection