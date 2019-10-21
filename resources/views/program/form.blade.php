@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Program <small>Add a new program</small></h6>
    <div class="card-body">
        @include('flash')
        <form
            action="{{ $task === 'create' ? route('programs.store') : $task === 'edit' ? route('programs.update', ['program' => $model->id]) : '' }}"
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
            <div class="col-md-4">
                <div class="form-group row">
                    <div class="form-group">
                        <label for="key_stage">Key Stage</label>
                        <select class="custom-select" name="key_stage" id="key_stage">
                            <option selected>Select...</option>
                            <option value="1"
                                {{ old('key_stage', optional($model)->key_stage) === 1 ? 'selected' : ''}}>Key Stage 1
                                (Kinder to Grade 3)</option>
                            <option value="2"
                                {{ old('key_stage', optional($model)->key_stage) === 2 ? 'selected' : ''}}>Key Stage 2
                                (Grade 4 to 6)</option>
                            <option value="3"
                                {{ old('key_stage', optional($model)->key_stage) === 3 ? 'selected' : ''}}>Key Stage 3
                                (Grade 7 to 10)</option>
                            <option value="4"
                                {{ old('key_stage', optional($model)->key_stage) === 4 ? 'selected' : ''}}>Key Stage 4
                                (Grade 11 to 12)</option>
                        </select>
                    </div>
                    @error('key_stage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            @include('button')
            @include('program.cancel')
        </form>
    </div>
</div>
@endsection