@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Event <small class="text-muted">View an event.</small></h6>
    <div class="card-body">
        <div class="form-group row">
            <label for="staticId" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" id="staticId" value="{{ $model->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticTitle" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <textarea type="text" readonly class="form-control-plaintext" id="staticTitle"
                    rows="3">{{ $model->title }}</textarea>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticStartedAt" class="col-sm-2 col-form-label">Start Date</label>
            <div class="col-sm-10">
                <input type="date" readonly class="form-control-plaintext" id="staticStartedAt"
                    value="{{ $model->started_at }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEndedAt" class="col-sm-2 col-form-label">End Date</label>
            <div class="col-sm-10">
                <input type="date" readonly class="form-control-plaintext" id="staticEndedAt"
                    value="{{ $model->ended_at }}">
            </div>
        </div>
        <a role="button" class="btn btn-secondary" href="{{ route('events.index') }}">Back to List</a>
    </div>
</div>
@endsection