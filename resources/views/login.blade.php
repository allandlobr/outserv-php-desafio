@extends('layout.app')

@section('content')
    <form action="/login" method="post">
        @csrf
        <label class="form-label" for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control mb-3" />
        <label class="form-label" for="username">Password</label>
        <input type="password" name="password" id="password" class="form-control mb-3" />
        <button class="btn btn-primary" type="submit" name="submit" id="submit">Login</button>
    </form>
@endsection
