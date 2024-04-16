@extends('layouts.layout')


@section('content')
    <x-banner h1="Emergency" span="Alerts"></x-banner>

    @unless (count($alerts) == 0)
        <section class="bg-white dark:bg-gray-900 flex">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">

                @can('isAdmin')
                    <div class="flex justify-end mb-10">
                        <a href="/alerts/create"
                            class="relative rounded px-5 py-2.5 overflow-hidden group bg-red-500 relative hover:bg-gradient-to-r hover:from-red-500 hover:to-red-400 text-white hover:ring-2 hover:ring-offset-2 hover:ring-red-400 transition-all ease-out duration-300">
                            <span
                                class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                            <span class="relative">Declare Emergency</span>
                        </a>
                    </div>
                @endcan

                <div class="grid gap-8 lg:grid-cols-1">

                    @foreach ($alerts as $alert)
                        <article
                            class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <span
                                    class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z"
                                            clip-rule="evenodd"></path>
                                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z"></path>
                                    </svg>
                                    {{ $alert->alert_type }}
                                </span>
                                <span class="text-sm">{{ Carbon\Carbon::parse($alert->created_at)->diffForHumans() }}</span>
                            </div>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                    href="#">{{ Str::limit($alert->headline, 50, $end = '...') }}
                                </a></h2>
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                                {{ Str::limit($alert->description, 250, $end = '') }}</p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <img class="w-7 h-7 rounded-full"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png"
                                        alt="Bonnie Green avatar" />
                                    <span class="font-medium dark:text-white">
                                        {{ $alert->issuing_agency }}
                                    </span>
                                </div>
                                <a href="{{ url('alerts/show', $alert->id) }}"
                                    class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>
        </section>
    @endunless


    {{-- @if (Auth::guest() || Auth::user()->hasRole('citizen'))
        <div class="content-wrapper">
            <x-tasks.card :tasks=$tasks></x-tasks.card>
        </div>
    @else
        <x-card-nav :nav=$nav></x-card-nav>

        <div class="content-wrapper">
            <x-tasks.table :tasks=$tasks></x-tasks.table>
        </div>
    @endif --}}
@endsection
