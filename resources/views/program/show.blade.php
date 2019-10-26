@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Program <small class="text-muted">View a program.</small><span
            class="float-right"><a href="{{ route('programs.create') }}"><i class="icon-plus"></i> New</a></span></h6>
    <div class="card-body">
        @include('flash')
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
            <label for="staticKeyStage" class="col-sm-2 col-form-label">Key Stage</label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" id="staticKeyStage"
                    value="{{ $model->key_stage }}">
            </div>
        </div>
        <a role="button" class="btn btn-primary" href="{{ route('programs.edit', ['program' => $model->id]) }}"><i
                class="icon-pencil"></i> Edit</a>
        <a role="button" class="btn btn-secondary" href="{{ route('programs.index') }}"><i class="icon-list"></i> Back
            to List</a>
    </div>
</div>
@endsection