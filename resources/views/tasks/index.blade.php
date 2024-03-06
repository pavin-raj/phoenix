@extends('layouts.layout')

@php
    $nav = ["/tasks/index" => "All Tasks", " " => "Unassigned Tasks", "" => "Open Tasks"];
@endphp


@section('content')
    <x-banner h1="Open Requests" span=""></x-banner>



    @if (Auth::guest() || Auth::user()->hasRole('citizen'))
        <div class="content-wrapper">
            <x-tasks.card :tasks=$tasks></x-tasks.card>
        </div>
    @else
        <x-card-nav :nav=$nav></x-card-nav>

        <div class="content-wrapper">
            <x-tasks.table :tasks=$tasks></x-tasks.table>
        </div>
    @endif
@endsection
