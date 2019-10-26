@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">{{ ucfirst($task) }} Participant <small class="text-muted">View a participant.</small><span
            class="float-right"><a href="{{ route('participants.create') }}"><i class="icon-plus"></i> New</a></span>
    </h6>
    <div class="card-body">
        @include('flash')
        <div class="form-group row">
            <label for="staticId" class="col-sm-2 col-form-label">ID</label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" id="staticId" value="{{ $model->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLastName" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticLastName"
                    value="{{ $model->last_name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticFirstName" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticFirstName"
                    value="{{ $model->first_name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticMi" class="col-sm-2 col-form-label">MI</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticMi" value="{{ $model->mi }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticSex" class="col-sm-2 col-form-label">Sex</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticSex" value="{{ $model->sex }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticStation" class="col-sm-2 col-form-label">Station</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticStation"
                    value="{{ $model->station }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticMobile" class="col-sm-2 col-form-label">Mobile</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticMobile"
                    value="{{ $model->mobile }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $model->email }}">
            </div>
        </div>

        <a role="button" class="btn btn-primary"
            href="{{ route('participants.edit', ['participant' => $model->id]) }}"><i class="icon-pencil"></i> Edit</a>
        <a role="button" class="btn btn-secondary" href="{{ route('participants.index') }}"><i class="icon-list"></i>
            Back
            to List</a>
    </div>
</div>
@endsection