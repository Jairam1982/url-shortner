@extends('layouts.app')

@section('content')

<div class="login-container">
    <h2>Login</h2>

    @if($errors->any())
        <div style="color:red;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="btn" type="submit">Login</button>
    </form>
</div>

@endsection