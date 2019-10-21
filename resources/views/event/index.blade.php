@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">Events <small class="text-muted">List of all events</small></h6>
    <div class="card-body">
        @include('flash')
        <div class="row mb-4">
            <div class="col-12">
                <a class="btn btn-success float-right" href="{{ route('events.create') }}" role="button"><i
                        class="icon-plus"></i> NEW</a>
            </div>
        </div>
        <events-table events="{{ json_encode($model) }}"></events-table>
    </div>
</div>

@endsection