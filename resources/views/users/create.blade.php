@extends('layouts.layout')


@section('content')
    <x-banner h1="User Registration" span="" />

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="content-wrapper">
        <form method="post" class="card card-lg" method="post" action="/users/store">
            @csrf
            @method('post')

            @auth
                @cannot('isCitizen')
                    <span>
                        <label id="">User Type*</label>
                        @error('user_type')
                            <p>{{ $message }}</p>
                        @enderror
                    </span>
                @endcannot

                <div class="control">

                    @can('createCoordinator', Auth::user())
                        <div class="control-group">
                            <input id="user_type" type="radio" name="user_type" value="2">
                            Coordinator
                        </div>
                    @endcan

                    @can('createEmergencyResponder', Auth::user())
                        <div class="control-group">
                            <input id="user_type" type="radio" name="user_type" value="3">
                            Emergency
                            Responder
                        </div>
                    @endcan

                    @can('createVolunteer', Auth::user())
                        <div class="control-group">
                            <input id="user_type" type="radio" name="user_type" value="4">
                            Volunteer
                        </div>
                        <div class="control-group">
                            <input id="user_type" type="radio" name="user_type" value="5">
                            Citizen
                        </div>
                    @endcan

                </div>

            @endauth



            <span>
                <label id="">Name*</label>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input id="name" type="text" name="name" class="control" required="true" value="{{ old('name') }}">

            <span>
                <label id="">Email*</label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input type="email" name="email" id="email" class="control" required="true" value="{{ old('email') }}">

            <span>
                <label id="">Password*</label>
                @error('password')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input type="password" name="password" id="password" class="control" required="true"
                value="{{ old('password') }}">

            <span>
                <label id="">Confirm Password*</label>
            </span>
            <input type="password" name="password_confirmation" id="password_confirmation" class="control" required="true"
                value="{{ old('password_confirmation') }}">


            <div class="control-group">
                <input type="checkbox" required="true">  I affirm that the information provided above is accurate
            </div>

            <div class="btn-container">
                <button type="submit" value="SUBMIT" class="btn bg-primary">SUBMIT
                </button>
            </div>
        </form>
    </div>
@endsection
