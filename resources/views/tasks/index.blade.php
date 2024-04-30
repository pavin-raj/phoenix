@extends('layouts.layout')

@php
    if (Auth::user() != null) {
        if (Auth::user()->hasRole('admin')) {
            $nav = ['/tasks/index' => 'All Tasks', '/tasks/unassigned' => 'Unassigned Tasks', '/tasks/assigned' => 'Assigned Tasks'];
        } elseif (Auth::user()->hasRole('emergency responder')) {
            $nav = [];
        } elseif (Auth::user()->hasRole('volunteer')) {
            $nav = ['/tasks/index' => 'Requested Tasks', '/tasks/accepted' => 'Accepted Tasks'];
        }
    }
@endphp


@section('content')
    <x-banner h1="Open Requests" span=""></x-banner>



    @if (Auth::guest() || Auth::user()->hasRole('citizen'))
        <div class="content-wrapper gap-10 items-center flex-wrap">
            <x-tasks.card :tasks=$tasks></x-tasks.card>
        </div>
    @else
        <x-card-nav :nav=$nav></x-card-nav>

        <div class="content-wrapper">
            @if (count($tasks) != 0)
                <x-tasks.table :tasks=$tasks></x-tasks.table>
            @else
                No Requested Tasks!
            @endif
        </div>
    @endif

@endsection
