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


    <div>
        <div class="flex mt-24">

            <x-tasks.sidebar :task_id=$task_id></x-tasks.sidebar>



            <div class="container mx-auto mt-0">
                <div class="flex flex-wrap gap-16 justify-center">

                    <form method="get" class="card w-4/6 my-9" action="{{ route('assignable_users', $task_id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="flex flex-row items-center gap-x-2 text-green-600">
                            <input type="text" name="search" id="search" placeholder="Search by name or skills">
                            <button type="submit"
                                class="fa-solid fa-magnifying-glass text-white bg-green-600 p-4 rounded-md"></button>
                    </form>
                </div>
            </div>

            <div class="container mx-auto mt-0 mb-10">
                <div class="flex flex-wrap gap-16 justify-center">
                    @unless (count($assignees) == 0)
                        @foreach ($assignees as $a)
                            <x-tasks.assignee-card :a=$a></x-tasks.assignee-card>
                        @endforeach
                    @else
                        <p class="m-4">No results.</p>
                    @endunless
                </div>
            </div>


            {{ $assignees->links() }}
        </div>
    </div>
@endsection
