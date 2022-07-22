@extends('master/master')


@section('space-work')
<h1>Registration</h1>

@if ($errors->any())
@foreach ($errors->all() as $error)
<p style="color: red">{{ $error }}</p>
    
@endforeach
    
    
@endif

<form action="{{ route('studentRegister') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Enter name"><br><br>
    <input type="email" name="email" placeholder="Enter Email"><br><br>
    <input type="password" name="password" placeholder="Enter Password"><br><br>
    <input type="password" name="password_confirmation" placeholder="Enter confirm password"><br><br>
    <input type="submit" value="Register">

</form>

@if (Session::has('success'))
    <p style="color: green">{{ Session::get('success') }}</p>
@endif

@endsection