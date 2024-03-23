@extends('layouts.layout')


@section('content')
    <x-banner h1="Emergency" span="Alerts"></x-banner>

    <div class="content-wrapper">
        <form method="post" class="card card-lg" action="{{ route('alerts.store') }}">
            @csrf

            <span>
                <label for="alert_type">Alert Type:</label>
                @error('alert_type')
                    <p>{{ $message }}</p>
                @enderror
                <select id="alert_type" name="alert_type" class="control" required>
                    <option value="">Select Type</option>
                    <option value="earthquake">Earthquake</option>
                    <option value="flood">Flood</option>
                    <option value="fire">Fire</option>
                </select>
            </span>

            <span>
                <label for="headline">Headline (optional):</label>
                @error('headline')
                    <p>{{ $message }}</p>
                @enderror
                <input id="headline" type="text" class="control" name="headline">
            </span>

            <span>
                <label for="description">Description:</label>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
                <textarea id="description" name="description" rows="5" class="control" required></textarea>
            </span>

            <span>
                <label for="issuing_agency">Issuing Agency:</label>
                @error('issuing_agency')
                    <p>{{ $message }}</p>
                @enderror
                <input id="issuing_agency" type="text" class="control" name="issuing_agency" required>
            </span>

            <span>
                <label for="location">Location (optional):</label>
                @error('location')
                    <p>{{ $message }}</p>
                @enderror
                <input id="location" type="text" class="control" name="location">
            </span>

            <span>
                <label for="severity_level">Severity Level:</label>
                @error('severity_level')
                    <p>{{ $message }}</p>
                @enderror
                <select id="severity_level" name="severity_level" class="control" required>
                    <option value="">Select Severity</option>
                    <option value="low">Low</option>
                    <option value="moderate">Moderate</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </span>

            <span>
                <label for="response_instruction">Response Instructions (optional):</label>
                @error('response_instruction')
                    <p>{{ $message }}</p>
                @enderror
                <textarea id="response_instruction" name="response_instruction" rows="3" class="control"></textarea>
            </span>

            <div class="control-group">
                <input type="checkbox" required="true">
                I affirm that the information provided above is accurate
            </div>

            <div class="btn-container">
                <button type="submit" value="SUBMIT" class="btn bg-primary">SUBMIT</button>
            </div>
        </form>
    </div>
@endsection
