@extends('layouts.app')

@section('content')
@php
$taskTitle = ucfirst($task)
@endphp

<div class="card">
    <h6 class="card-header">{{ $taskTitle }} Event <small>{{ $taskTitle }} an event.</small></h6>
    <div class="card-body">
        @include('flash')
        <form
            action="{{ $task === 'create' ? route('events.store') : $task === 'edit' ? route('events.update', ['event' => $model->id]) : '' }}"
            method="POST">
            @csrf
            @if ($task === 'edit')
            @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Title</label>
                <textarea class="form-control @error('title') is-invalid @enderror" name="title" id="title" rows="3"
                    minlength="3" maxlength="255" required
                    autofocus>{{ old('title', optional($model)->title) }}</textarea>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="started_at">Start Date</label>
                        <input type="date" class="form-control flatpickr @error('started_at') is-invalid @enderror"
                            name="started_at" id="started_at" aria-describedby="startedAtHelp" placeholder="Start Date"
                            value="{{ old('started_at', optional($model)->started_at) }}" required>
                        @error('started_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="ended_at">End Date</label>
                        <input type="date" class="form-control flatpickr @error('ended_at') is-invalid @enderror"
                            name="ended_at" id="ended_at" aria-describedby="endedAtHelp" placeholder="End Date"
                            value="{{ old('ended_at', optional($model)->ended_at) }}" required>
                        @error('ended_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="custom-select @error('type') is-invalid @enderror" name="type" id="type"
                            required>
                            <option>Select...</option>
                            <option value="W" {{ old('type', optional($model)->type) === 'W' ? 'selected':'' }}>
                                Workshop/Writeshop</option>
                            <option value="T" {{ old('type', optional($model)->type) === 'T' ? 'selected':'' }}>
                                Training/Orientation</option>
                            <option value="C" {{ old('type', optional($model)->type) === 'C' ? 'selected':'' }}>
                                Conference/Summit</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="grouping">Grouping</label>
                        <select class="custom-select @error('grouping') is-invalid @enderror" name="grouping"
                            id="grouping" required>
                            <option>Select...</option>
                            <option value="R" {{ old('grouping', optional($model)->grouping) === 'R' ? 'selected':'' }}>
                                By Region</option>
                            <option value="L" {{ old('grouping', optional($model)->grouping) === 'L' ? 'selected':'' }}>
                                By Learning Area</option>
                            <option value="M" {{ old('grouping', optional($model)->grouping) === 'M' ? 'selected':'' }}>
                                By Language</option>
                            <option value="N" {{ old('grouping', optional($model)->grouping) === 'N' ? 'selected':'' }}>
                                No Grouping</option>
                        </select>
                        @error('grouping')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="switch switch-pill switch-primary">Active
                            <input type="checkbox" class="switch-input @error('is_active') is-invalid @enderror"
                                id="is_active" name="is_active"
                                {{ old('is_active', optional($model)->is_active) ? 'checked':'' }}>
                            <span class="switch-slider"></span>
                        </label>
                        @error('is_active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="icon-note"></i> SAVE</button>
                    <a class="btn btn-link" href="{{ route('events.index') }}" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection