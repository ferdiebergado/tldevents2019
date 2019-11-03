@extends('layouts.app')

@section('content')

<div class="card card-accent-primary card-border-light">
    <div class="card-body">
        <h4 class="card-title mb-3">Search Participants
        </h4>
        <participant-search url="{{ route('participants.index') }}" createurl="{{ route('participants.create') }}">
        </participant-search>
    </div>
</div>

@endsection