@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">Events <small class="text-muted">List of events.</small></h6>
    <div class="card-body">
        @include('flash')
        @can('create', App\Event::class)
        <div class="row mb-4">
            <div class="col-12">
                <a class="btn btn-success float-right" href="{{ route('events.create') }}" role="button"><i
                        class="icon-plus"></i> NEW</a>
            </div>
        </div>
        @endcan
        <events-datatable url="{{ route('events.index') }}" events="{{ json_encode($model) }}"></events-datatable>
    </div>
</div>

@endsection