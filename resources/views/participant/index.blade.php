@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">
        <i class="icon-list"></i> Participants <small class="text-muted">List of participants.</small>
    </h6>
    <div class="card-body">

        @include('flash')

        @can('create', \App\Participant::class)

        @isset($currentEvent)

        <div class="row mb-4">
            <div class="col-10">
                <h5>{{ $currentEvent['title'] }}</h5>
                <small class="text-muted">{{ $currentEvent['duration_date'] }}</small>
            </div>
            <div class="col-2">
                <a class="btn btn-success float-right" href="{{ route('participants.search') }}" role="button">
                    <i class="icon-plus"></i> NEW
                </a>
            </div>
        </div>

        @endisset

        @endcan

        @isset($currentEvent)

        <participants-datatable url="{{ route('participants.index') }}" participants="{{ json_encode($model) }}">
        </participants-datatable>

        @endisset

        @empty($currentEvent)

        <p>No active event.</p>

        @endempty

    </div>
</div>

@endsection