@props(['h1', 'span'])

{{-- <div class="banner-wrapper">
    <div class="banner-section">
        <h1 class="banner-heading">{{ $h1 }}</h1>
    </div>
</div> --}}


<div class="banner-section bg-secondary">
    <div class="banner-wrapper">
        <h1 class="banner-heading">{{ $h1 }} <span>{{ $span }}</span></h1>
    </div>
</div>
