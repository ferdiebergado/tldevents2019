@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">
        <i class="icon-list"></i> Participants <small class="text-muted">List of all participants.</small>
    </h6>
    <div class="card-body">
        @include('flash')
        <div class="row mb-4">
            <div class="col-12">
                <a class="btn btn-success float-right" href="{{ route('participants.create') }}" role="button"><i
                        class="icon-plus"></i> NEW</a>
            </div>
        </div>
        <participants-datatable url="{{ route('participants.index') }}" participants="{{ json_encode($model) }}">
        </participants-datatable>
    </div>
</div>

@endsection