@extends('layouts.layout')

@php
    $h1 = 'Sign in to';
    $span = 'make change';
@endphp
@section('content')
    <x-banner :h1=$h1 :span=$span />



    <form method="post" class="form" method="post" action="/users/authenticate">
        @csrf
        @method('post')

        <span>
            <label id="">Email*</label>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <input type="email" name="email" id="email" required="true" value="{{ old('email') }}">

        <span>
            <label id="">Password*</label>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <input type="password" name="password" id="password" required="true" value="{{ old('password') }}">



        <div>
            {{-- <input type="checkbox" required="true"> --}}
            Not yet registered? <a href="/users">Register</a>
        </div>

        <div class="btn-container">
            <button type="submit" value="SUBMIT" class="btn bg-primary">SUBMIT
            </button>
        </div>
    </form>
@endsection
