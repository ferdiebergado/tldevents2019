@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Event <small>Add a new event.</small></h6>
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
                        <input type="date" class="form-control flatpickr @error('ended_at') is-invalid @enderror" name="ended_at"
                            id="ended_at" aria-describedby="endedAtHelp" placeholder="End Date"
                            value="{{ old('ended_at', optional($model)->ended_at) }}" required>
                        @error('ended_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="icon-note"></i> SAVE</button>
            <a class="btn btn-link" href="{{ route('events.index')}}" role="button">Cancel</a>
        </form>
    </div>
</div>
@endsection