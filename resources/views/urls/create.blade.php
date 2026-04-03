@extends('layouts.app')

@section('content')

<div class="container">

    <div class="form-box">
        <h2><b>Generate Short URL</b></h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="success">
                {{ session('success') }} <br>

                <strong>
                    <a href="{{ session('short_url') }}" target="_blank">
                        {{ session('short_url') }}
                    </a>
                </strong>
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="/urls">
            @csrf

            <div class="form-group">
                <label>Enter Long URL</label>
                <input 
                    type="url" 
                    name="long_url" 
                    placeholder="https://example.com" 
                    required
                >
            </div>

            <button type="submit" class="btn">Generate</button>
        </form>
    </div>

</div>

@endsection