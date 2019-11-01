@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Event <small class="text-muted">View an event.</small></h6>
    <div class="card-body">
        @include('flash')
        <div class="form-group row">
            <label for="staticId" class="col-sm-2 col-form-label"><strong>ID</strong></label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" id="staticId" value="{{ $model['id'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticTitle" class="col-sm-2 col-form-label"><strong>Title</strong></label>
            <div class="col-sm-10">
                <textarea type="text" readonly class="form-control-plaintext" id="staticTitle"
                    rows="2">{{ $model['title'] }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticStartedAt" class="col-sm-2 col-form-label"><strong>Start Date</strong></label>
            <div class="col-sm-10">
                <input type="date" readonly class="form-control-plaintext" id="staticStartedAt"
                    value="{{ $model['started_at'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEndedAt" class="col-sm-2 col-form-label"><strong>End Date</strong></label>
            <div class="col-sm-10">
                <input type="date" readonly class="form-control-plaintext" id="staticEndedAt"
                    value="{{ $model['ended_at'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticType" class="col-sm-2 col-form-label"><strong>Type</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticType"
                    value="{{ $model['type_name'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticGrouping" class="col-sm-2 col-form-label"><strong>Grouping</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticGrouping"
                    value="{{ $model['grouping_name'] }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticGrouping" class="col-sm-2 col-form-label"><strong>Active</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticGrouping"
                    value="{{ $model['is_active'] ? 'Yes':'No' }}">
            </div>
        </div>
        <a role="button" class="btn btn-primary" href="{{ route('events.edit', ['event' => $model['id']]) }}"><i
                class="icon-pencil"></i> Edit</a>
        <a role="button" class="btn btn-light" href="{{ route('events.index') }}"><i class="icon-list"></i> Back to
            List</a>
    </div>
</div>
@endsection