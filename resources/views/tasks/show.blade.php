@extends('layouts.layout')

@php
    $nav = [
        "/tasks/show/$task->id" => 'Overview',
        "/tasks/show/$task->id/notes" => 'Add Notes',
        "/tasks/show/$task->id/assignees" => 'Assignees',
    ];
@endphp

@section('content')
    <x-banner h1="Task" span="Updation" />



    <x-card-nav :nav=$nav></x-card-nav>



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
        <form method="post" class="card card-lg" method="post" action="{{ url('tasks/update', $task->id) }}">
            @csrf
            @method('post')

            <a class="flex justify-end gap-2 items-center text-sky-600 text-lg cursor-pointer" onclick="edit()"><i
                    class="fa-solid fa-pen"></i> Edit</a>

            <div class="flex flex-wrap gap-x-32">
                <div class="w-2/5">
                    <span>
                        <label id="">Phone</label>
                        @error('phone')
                            <p>{{ $message }}</p>
                        @enderror
                    </span>
                    <input id="phone" type="text" class="control hidden" name="phone"
                        value={{ $task->task_contact->phone }}>
                    <p class="text-lime-600 text-lg">{{ $task->task_contact->phone }}</p>
                </div>

                <div class="w-2/5">
                    <span>
                        <label id="">Email</label>
                        @error('email')
                            <p>{{ $message }}</p>
                        @enderror
                    </span>
                    <input id="email" type="email" class="control hidden" name="email"
                        value={{ $task->task_contact->email }}>
                    <p class="control text-lime-600 text-lg">{{ $task->task_contact->email }}</p>
                </div>

                <div class="w-2/5">
                    <span>
                        <label id="">Secondary Phone</label>
                        @error('secondary_phone')
                            <p>{{ $message }}</p>
                        @enderror
                    </span>
                    <input id="secondary_phone" type="text" class="control hidden" name="secondary_phone"
                        value={{ $task->task_contact->secondary_phone }}>
                    <p class="control text-lime-600 text-lg">{{ $task->task_contact->secondary_phone }}</p>
                </div>
                <div class="w-2/5">
                    <span>
                        <label id="">Secondary Email</label>
                        @error('secondary_email')
                            <p>{{ $message }}</p>
                        @enderror
                    </span>
                    <input id="secondary_email" type="email" class="control hidden" name="secondary_email"
                        value={{ $task->task_contact->secondary_email }}>
                    <p class="control text-lime-600 text-lg">{{ $task->task_contact->secondary_email }}</p>
                </div>

                <div class="w-2/5">
                    <span>
                        <label id="">Status</label>
                        @error('status')
                            <p>{{ $status }}</p>
                        @enderror
                    </span>
                    <select class="control hidden" name="status" id="priority">
                        @foreach ($status as $val)
                            <option value="{{ $val }}" {{ $val == $task->status ? 'selected' : '' }}>
                                {{ $val }}</option>
                        @endforeach
                    </select>
                    <p class="control text-lime-600 text-lg">{{ $task->status }}</p>
                </div>
                <div class="w-2/5">
                    <span>
                        <label id="">Priority</label>
                        @error('priority')
                            <p>{{ $priority }}</p>
                        @enderror
                    </span>
                    <select class="control hidden" name="priority" id="priority">
                        @foreach ($priority as $val)
                            <option value="{{ $val }}" {{ $val == $task->priority ? 'selected' : '' }}>
                                {{ $val }}</option>
                        @endforeach
                    </select>
                    <p class="control text-lime-600 text-lg">{{ $task->priority }}</p>
                </div>

                <div class="w-2/5">
                    <span>
                        <label id="">City</label>
                        @error('city')
                            <p>{{ $city }}</p>
                        @enderror
                    </span>
                    <input id="city" type="text" class="control hidden" name="city" value={{ $task->city }}>
                    <p class="control text-lime-600 text-lg">{{ $task->city }}</p>
                </div>
                <div class="w-2/5">
                    <span>
                        <label id="">State</label>
                        @error('state')
                            <p>{{ $state }}</p>
                        @enderror
                    </span>
                    <input id="state" type="text" class="control hidden" name="state" value={{ $task->state }}>
                    <p class="control text-lime-600 text-lg">{{ $task->state }}</p>
                </div>

            </div>

            <span>
                <label id="">Address</label>
                @error('address')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <textarea id="address" required="true" class="control hidden" name="address">{{ $task->task_contact->address }}</textarea>
            <p class="control text-lime-600 text-lg">{{ $task->task_contact->address }}</p>


            <span>
                <label id="">Description*</label>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </span>
            <textarea id="description" required="true" class="control hidden" name="description">{{ $task->description }}</textarea>
            <p class="control text-lime-600 text-lg">{{ $task->description }}</p>


            <div class="btn-container">
                <button type="submit" value="SUBMIT" class="btn bg-primary hidden">UPDATE
                </button>
            </div>
        </form>
    </div>
@endsection
