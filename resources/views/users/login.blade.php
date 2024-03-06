@extends('layouts.layout')


@section('content')
    <x-banner h1="Sign in to" span="make change" />



    <div class="content-wrapper">
        <form method="post" class="card card-lg" method="post" action="/users/authenticate">
            @csrf
            @method('post')

            <span>
                <label id="">Email*</label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input type="email" class="control" name="email" id="email" required="true" value="{{ old('email') }}">

            <span>
                <label id="">Password*</label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input type="password" class="control" name="password" id="password" required="true"
                value="{{ old('password') }}">



            <div>
                {{-- <input type="checkbox" required="true"> --}}
                Not yet registered? <a href="/users">Register</a>
            </div>

            <div class="btn-container">
                <button type="submit" value="SUBMIT" class="btn bg-primary">SUBMIT
                </button>
            </div>
        </form>
    </div>
@endsection
