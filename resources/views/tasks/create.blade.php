@extends('layouts.layout')


@section('content')
    <x-banner h1="What's happening?" span="" />

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
        <form method="post" class="card card-lg" method="post" action="{{ route('tasks.store') }}">
            @csrf
            @method('post')
            <span>
                <label id="">Phone (optional)</label>
                @error('phone')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input id="phone" type="text" class="control" name="phone">

            <span>
                <label id="">Email (optional)</label>
                @error('email')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <input id="email" type="email" class="control" name="email">

            <span>
                <label id="">Any other way to reach you (Mention if any)</label>
            </span>
            <input id="contact" type="text" class="control" name="contact">

            <span>
                <label id="">Briefly decribe the issue*</label>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <textarea required="true" class="control" name="description"></textarea>

            {{-- <div>
            <div>
                <label class="control">
                    <input type="checkbox" required="true">
                    <div></div>
                </label>
                I affirm that the information provided above is accurate
            </div>
        </div> --}}

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
