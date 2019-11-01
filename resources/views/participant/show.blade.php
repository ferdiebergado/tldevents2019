@extends('layouts.app')

@section('content')

<div class="card">
    <h6 class="card-header">
        <i class="icon-eye"></i>View Participant <small class="text-muted">View a participant info.</small>
    </h6>
    <div class="card-body">
        @include('flash')
        <div class="form-group row">
            <label for="staticId" class="col-sm-2 col-form-label"><strong>ID</strong></label>
            <div class="col-sm-10">
                <input type="number" readonly class="form-control-plaintext" id="staticId" value="{{ $model->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticLastName" class="col-sm-2 col-form-label"><strong>Last Name</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticLastName"
                    value="{{ $model->last_name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticFirstName" class="col-sm-2 col-form-label"><strong>First Name</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticFirstName"
                    value="{{ $model->first_name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticMi" class="col-sm-2 col-form-label"><strong>MI</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticMi" value="{{ $model->mi }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticSex" class="col-sm-2 col-form-label"><strong>Sex</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticSex" value="{{ $model->sex }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticStation" class="col-sm-2 col-form-label"><strong>Station</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticStation"
                    value="{{ $model->station }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticMobile" class="col-sm-2 col-form-label"><strong>Mobile</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticMobile"
                    value="{{ $model->mobile }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label"><strong>Email</strong></label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $model->email }}">
            </div>
        </div>

        <div class="row">
            <div class="col-5">

                <a role="button" class="btn btn-primary"
                    href="{{ route('participants.edit', ['participant' => $model->id]) }}"><i class="icon-pencil"></i>
                    Edit</a>
                <a role="button" class="btn btn-secondary" href="{{ route('participants.index') }}"><i
                        class="icon-list"></i>
                    Back
                    to List</a>
            </div>
            @include('history')
        </div>

    </div>
</div>
@endsection