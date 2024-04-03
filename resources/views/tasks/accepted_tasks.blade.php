@extends('layouts.layout')

@php
    $nav = ['/tasks/index' => 'Requested Tasks', '/tasks/accepted' => 'Accepted Tasks'];
@endphp


@section('content')
    <x-banner h1="Open Requests" span=""></x-banner>

    <x-card-nav :nav=$nav></x-card-nav>

    <div class="content-wrapper">
        @if (count($accepted_tasks) == 0)
            No accepted tasks!
        @else
            <x-tasks.table :tasks=$accepted_tasks></x-tasks.table>
        @endif
    </div>
@endsection
