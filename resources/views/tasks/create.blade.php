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

    <form method="post" class="citizen-report-form" method="post" action="{{ route('tasks.store') }}">
        @csrf
        @method('post')
        <span>
            <label id="">Phone (optional)</label>
            @error('phone')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <input id="phone" type="text" name="phone">

        <span>
            <label id="">Email (optional)</label>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <input id="email" type="email" name="email">

        <span>
            <label id="">Any other way to reach you (Mention if any)</label>
        </span>
        <input id="contact" type="text" name="contact">

        <span>
            <label id="">Briefly decribe the issue*</label>
            @error('description')
                <p>{{ $message }}</p>
            @enderror
        </span>
        <textarea required="true" name="description"></textarea>

        {{-- <div>
            <div>
                <label class="control">
                    <input type="checkbox" required="true">
                    <div></div>
                </label>
                I affirm that the information provided above is accurate
            </div>
        </div> --}}


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
