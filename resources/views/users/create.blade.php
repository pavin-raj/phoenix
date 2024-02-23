@extends('layouts.layout')

@php
    $h1 = "What's happening?";
@endphp
@section('content')
    <x-banner :h1=$h1 />

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <form method="post" class="citizen-report-form" method="post" action="/users/store">
        @csrf
        @method('post')
        <span>
            <label id="">Name*</label>
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <input id="name" type="text" name="name" required="true" value="{{ old('name') }}">

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

        <span>
            <label id="">Confirm Password*</label>
        </span>
        <input type="password" name="password_confirmation" id="password_confirmation" required="true"
            value="{{ old('password_confirmation') }}">


        <div class="control">
            <input type="checkbox" required="true">
            I affirm that the information provided above is accurate
        </div>

        <div class="btn-container">
            <button type="submit" value="SUBMIT" class="green-btn">SUBMIT
            </button>
        </div>
    </form>
@endsection
