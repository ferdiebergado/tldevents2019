@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">Programs <small class="text-muted">List of all programs</small></h6>
    <div class="card-body">
        @include('flash')
        <div class="row mb-4">
            <div class="col-12">
                <a class="btn btn-success float-right" href="{{ route('programs.create') }}" role="button"><i
                        class="icon-plus"></i> NEW</a>
            </div>
        </div>
        <programs-table programs="{{ json_encode($model) }}"></programs-table>
    </div>
</div>

@endsection