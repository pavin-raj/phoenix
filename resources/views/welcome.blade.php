@extends('layouts.layout')

@php
    $h1 = auth()->check() ? 'Welcome' : 'Report Danger';
    $span = auth()->check() ? auth()->user()->name : 'Now';
@endphp
@section('content')
    <x-banner :h1=$h1 :span=$span />
    <!-- component -->

    <div class="content-wrapper">
        <section class="bg-orange-100 flex w-full h-200 rounded-tl-15xl rounded-br-15xl mt-10">
            <div class="w-1/2 h-full">
                <img src="{{ asset('images/welcome/volunteer-force-hero.jpg') }}" alt=""
                    class="rounded-tl-15xl rounded-br-15xl w-full h-full object-fill">
            </div>
            <div class="w-1/2 h-full p-20 flex flex-col gap-5">
                <h1 class="text-4xl">Volunteer force Management</h1>
                <p class="text-xl">Become a Hero! Join our Volunteer Force Management
                    system. </p>
                <ul class="mt-5 w-full flex flex-col items-center justify-center gap-y-2 desktop:gap-y-3">

                    <li class="w-full flex flex-row items-center justify-center  gap-x-2">
                        <svg class="w-6 desktop:w-8 h-6 desktop:h-8" width="32" height="32" viewBox="0 0 32 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_2086_10144" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="32" height="32">
                                <rect width="32" height="32" fill="#D9D9D9"></rect>
                            </mask>
                            <g mask="url(#mask0_2086_10144)">
                                <path
                                    d="M14.1 21.6667L23.0667 12.7L21.6667 11.3L14.1 18.8667L10.3 15.0667L8.89999 16.4667L14.1 21.6667ZM16 28.6667C14.2444 28.6667 12.5947 28.3333 11.0507 27.6667C9.50577 27 8.16666 26.1 7.03333 24.9667C5.89999 23.8333 4.99999 22.4942 4.33333 20.9493C3.66666 19.4053 3.33333 17.7556 3.33333 16C3.33333 14.2445 3.66666 12.5942 4.33333 11.0493C4.99999 9.50534 5.89999 8.16668 7.03333 7.03334C8.16666 5.90001 9.50577 5.00001 11.0507 4.33334C12.5947 3.66668 14.2444 3.33334 16 3.33334C17.7555 3.33334 19.4058 3.66668 20.9507 4.33334C22.4947 5.00001 23.8333 5.90001 24.9667 7.03334C26.1 8.16668 27 9.50534 27.6667 11.0493C28.3333 12.5942 28.6667 14.2445 28.6667 16C28.6667 17.7556 28.3333 19.4053 27.6667 20.9493C27 22.4942 26.1 23.8333 24.9667 24.9667C23.8333 26.1 22.4947 27 20.9507 27.6667C19.4058 28.3333 17.7555 28.6667 16 28.6667ZM16 26.6667C18.9778 26.6667 21.5 25.6333 23.5667 23.5667C25.6333 21.5 26.6667 18.9778 26.6667 16C26.6667 13.0222 25.6333 10.5 23.5667 8.43334C21.5 6.36668 18.9778 5.33334 16 5.33334C13.0222 5.33334 10.5 6.36668 8.43333 8.43334C6.36666 10.5 5.33333 13.0222 5.33333 16C5.33333 18.9778 6.36666 21.5 8.43333 23.5667C10.5 25.6333 13.0222 26.6667 16 26.6667Z"
                                    fill="#439E61"></path>
                            </g>
                        </svg>

                        <div class="w-full">
                            <h4 class="mb-1  text-left"></h4>
                            <span class="block text-body font-medium desktop:text-large text-left">Skills based
                                matching</span>
                        </div>
                    </li>

                    <li class="w-full flex flex-row items-center justify-center gap-x-2">
                        <svg class="w-6 desktop:w-8 h-6 desktop:h-8" width="32" height="32" viewBox="0 0 32 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_2086_10144" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="32" height="32">
                                <rect width="32" height="32" fill="#D9D9D9"></rect>
                            </mask>
                            <g mask="url(#mask0_2086_10144)">
                                <path
                                    d="M14.1 21.6667L23.0667 12.7L21.6667 11.3L14.1 18.8667L10.3 15.0667L8.89999 16.4667L14.1 21.6667ZM16 28.6667C14.2444 28.6667 12.5947 28.3333 11.0507 27.6667C9.50577 27 8.16666 26.1 7.03333 24.9667C5.89999 23.8333 4.99999 22.4942 4.33333 20.9493C3.66666 19.4053 3.33333 17.7556 3.33333 16C3.33333 14.2445 3.66666 12.5942 4.33333 11.0493C4.99999 9.50534 5.89999 8.16668 7.03333 7.03334C8.16666 5.90001 9.50577 5.00001 11.0507 4.33334C12.5947 3.66668 14.2444 3.33334 16 3.33334C17.7555 3.33334 19.4058 3.66668 20.9507 4.33334C22.4947 5.00001 23.8333 5.90001 24.9667 7.03334C26.1 8.16668 27 9.50534 27.6667 11.0493C28.3333 12.5942 28.6667 14.2445 28.6667 16C28.6667 17.7556 28.3333 19.4053 27.6667 20.9493C27 22.4942 26.1 23.8333 24.9667 24.9667C23.8333 26.1 22.4947 27 20.9507 27.6667C19.4058 28.3333 17.7555 28.6667 16 28.6667ZM16 26.6667C18.9778 26.6667 21.5 25.6333 23.5667 23.5667C25.6333 21.5 26.6667 18.9778 26.6667 16C26.6667 13.0222 25.6333 10.5 23.5667 8.43334C21.5 6.36668 18.9778 5.33334 16 5.33334C13.0222 5.33334 10.5 6.36668 8.43333 8.43334C6.36666 10.5 5.33333 13.0222 5.33333 16C5.33333 18.9778 6.36666 21.5 8.43333 23.5667C10.5 25.6333 13.0222 26.6667 16 26.6667Z"
                                    fill="#439E61"></path>
                            </g>
                        </svg>

                        <div class="w-full">
                            <h4 class="mb-1  text-left"></h4>
                            <span class="block text-body font-medium desktop:text-large  text-left">Real time
                                coordination</span>
                        </div>
                    </li>

                    <li class="w-full flex flex-row items-center justify-center gap-x-2">
                        <svg class="w-6 desktop:w-8 h-6 desktop:h-8" width="32" height="32" viewBox="0 0 32 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_2086_10144" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="32" height="32">
                                <rect width="32" height="32" fill="#D9D9D9"></rect>
                            </mask>
                            <g mask="url(#mask0_2086_10144)">
                                <path
                                    d="M14.1 21.6667L23.0667 12.7L21.6667 11.3L14.1 18.8667L10.3 15.0667L8.89999 16.4667L14.1 21.6667ZM16 28.6667C14.2444 28.6667 12.5947 28.3333 11.0507 27.6667C9.50577 27 8.16666 26.1 7.03333 24.9667C5.89999 23.8333 4.99999 22.4942 4.33333 20.9493C3.66666 19.4053 3.33333 17.7556 3.33333 16C3.33333 14.2445 3.66666 12.5942 4.33333 11.0493C4.99999 9.50534 5.89999 8.16668 7.03333 7.03334C8.16666 5.90001 9.50577 5.00001 11.0507 4.33334C12.5947 3.66668 14.2444 3.33334 16 3.33334C17.7555 3.33334 19.4058 3.66668 20.9507 4.33334C22.4947 5.00001 23.8333 5.90001 24.9667 7.03334C26.1 8.16668 27 9.50534 27.6667 11.0493C28.3333 12.5942 28.6667 14.2445 28.6667 16C28.6667 17.7556 28.3333 19.4053 27.6667 20.9493C27 22.4942 26.1 23.8333 24.9667 24.9667C23.8333 26.1 22.4947 27 20.9507 27.6667C19.4058 28.3333 17.7555 28.6667 16 28.6667ZM16 26.6667C18.9778 26.6667 21.5 25.6333 23.5667 23.5667C25.6333 21.5 26.6667 18.9778 26.6667 16C26.6667 13.0222 25.6333 10.5 23.5667 8.43334C21.5 6.36668 18.9778 5.33334 16 5.33334C13.0222 5.33334 10.5 6.36668 8.43333 8.43334C6.36666 10.5 5.33333 13.0222 5.33333 16C5.33333 18.9778 6.36666 21.5 8.43333 23.5667C10.5 25.6333 13.0222 26.6667 16 26.6667Z"
                                    fill="#439E61"></path>
                            </g>
                        </svg>

                        <div class="w-full">
                            <h4 class="mb-1  text-left"></h4>
                            <span class="block text-body font-medium desktop:text-large  text-left">Maximized Impact</span>
                        </div>
                    </li>

                </ul>

                <a href="/users/volunteer"
                    class="relative w-52 rounded px-5 py-2.5 overflow-hidden group bg-green-500 relative hover:bg-gradient-to-r hover:from-green-500 hover:to-green-400 text-white hover:ring-2 hover:ring-offset-2 hover:ring-green-400 transition-all ease-out duration-300">
                    <span
                        class="absolute right-0 w-8 h-32 -mt-12 transition-all duration-1000 transform translate-x-12 bg-white opacity-10 rotate-12 group-hover:-translate-x-40 ease"></span>
                    <span class="relative">Volunteer Registration</span>
                </a>
            </div>
        </section>
    </div>
@endsection
