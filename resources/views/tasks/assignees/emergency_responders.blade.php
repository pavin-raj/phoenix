@extends('layouts.layout')

@php
    $nav = [
        "/tasks/show/$task_id" => 'Overview',
        "/tasks/show/$task_id/messages" => 'Add Messages',
        "/tasks/show/$task_id/assignees" => 'Assignees',
    ];
@endphp

@section('content')
    <x-banner h1="Task" span="Updation" />



    <x-card-nav :nav=$nav></x-card-nav>


    <div class="flex mt-24">

        <x-tasks.sidebar :task_id=$task_id></x-tasks.sidebar>

        @unless (count($assignees) == 0)
            <div class="container mx-auto">
                <div class="flex flex-wrap gap-16 justify-center">
                    @foreach ($assignees as $assignee)
                        @foreach ($assignee as $a)
                            {{-- Display only if its an emergency responder --}}
                            @if ($a['role_id'] == 3)
                                <x-tasks.assignee-card :a=$a></x-tasks.assignee-card>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        @else
            <p>No Assignees</p>
        @endunless

    </div>

@endsection