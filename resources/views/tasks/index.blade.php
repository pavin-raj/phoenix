@extends('layouts.layout')

@php
    $h1 = 'Open Requests';
    $span = '';
@endphp
@section('content')
    <x-banner :h1=$h1 :span=$span></x-banner>
    @unless (count($tasks) == 0)
        @foreach ($tasks as $task)
            <div class="form request-box">
                <h2>Please Verify</h2>
                <div class="card">

                    <div class="card-item">
                        <div class="item-icon">
                            <i class="fa-solid fa-chart-line"></i>
                            STATUS
                        </div>
                        <div class="item-details">
                            {{ $task->status }}
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="item-icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            PRIORITY
                        </div>
                        <div class="item-details">
                            {{ $task->priority }}
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="item-icon">
                            <i class="fa-solid fa-location-crosshairs"></i>
                            CITY
                        </div>
                        <div class="item-details">
                            {{ $task->city }}
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="item-icon">
                            <i class="fa-solid fa-earth-asia"></i>
                            REGION
                        </div>
                        <div class="item-details">
                            {{ $task->state }}
                        </div>
                    </div>
                </div>

                <div class="timeline">
                    <div class="timeline__middle">
                        <div class="timeline__point"></div>
                    </div>
                    <p class="timeline__paragraph">We've automatically filled in your location. Please
                        confirm if this is the correct address.</p>

                    <div class="timeline__middle">
                        <div class="timeline__point"></div>
                    </div>
                    <p class="timeline__paragraph">We've automatically filled in your location. Please
                        confirm if this is the correct address.</p>
                </div>

                <div class="last-item">
                    <button class="btn bg-primary">Delete</button>
                    <button class="btn bg-green-light">Edit Details</button>
                </div>

            </div>
        @endforeach
    @else
        <p>No tasks</p>
    @endunless
@endsection
