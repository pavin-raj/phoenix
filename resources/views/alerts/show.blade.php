@extends('layouts.layout')

@section('content')
    <!--
                        Install the "flowbite-typography" NPM package to apply styles and format the article content:

                        URL: https://flowbite.com/docs/components/typography/
                        -->

    <x-banner h1="Emergency" span="Alerts"></x-banner>

    <main class="my-3 pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article class="mx-auto ch-110 format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">

                    <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $alert->headline }}</h1>
                </header>

                <p>{{ $alert->description }}</p>

                <figure>
                    @if (isset($alert->image))
                        <img alt="..." src="{{ asset($alert->image) }}" />
                        <figcaption>{{ $alert->headline }}</figcaption>
                    @endif
                </figure>
                <h2>Response Instructions</h2>
                <p>{{ $alert->response_instruction }}</p>



                
            </article>
        </div>
    </main>
    
@endsection
