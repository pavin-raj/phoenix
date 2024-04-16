@extends('layouts.layout')


@section('content')
    <x-banner h1="What's happening?" span="" />


    <div class="content-wrapper">
        <form method="post" class="card card-lg" method="post" action="{{ route('tasks.store') }}">
            @csrf
            @method('post')
            <span>
                <label id="">Phone (optional)</label>
                @error('phone')
                    <p class="text-red-300">{{ $message }}</p>
                @enderror
            </span>
            <input id="phone" type="text" class="control" name="phone">

            <span>
                <label id="">Email (optional)</label>
                @error('email')
                    <p class="text-red-300">{{ $message }}</p>
                @enderror
            </span>
            <input id="email" type="email" class="control" name="email">

            <span>
                <label id="">Any other way to reach you (Mention if any)</label>
                @error('contact')
                    <p class="text-red-300">{{ $message }}</p>
                @enderror
            </span>
            <input id="contact" type="text" class="control" name="contact">

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <span>
                <label id="">Briefly decribe the issue*</label>
                @error('description')
                    <p class="text-red-300">{{ $message }}</p>
                @enderror
            </span>
            <textarea required="true" class="control" name="description"></textarea>



            <div class="control-group">
                <input type="checkbox" required="true"> I affirm that the information provided above is accurate
            </div>

            <div class="btn-container">
                <button type="submit" value="SUBMIT" class="btn bg-primary" onmouseover="getLocation()">SUBMIT
                </button>
            </div>
        </form>
    </div>
@endsection
