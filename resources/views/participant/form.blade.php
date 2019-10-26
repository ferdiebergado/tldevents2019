@extends('layouts.app')

@section('content')

@php
$taskTitle = ucfirst($task)
@endphp

<div class="card">
    <h6 class="card-header">{{ $taskTitle }} Participant <small>{{ $taskTitle }} a participant.</small></h6>
    <div class="card-body">
        @include('flash')
        <form
            action="{{ $task === 'create' ? route('participants.store') : $task === 'edit' ? route('participants.update', ['participant' => $model->id]) : '' }}"
            method="POST">
            @csrf
            @if ($task === 'edit')
            @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="title">Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                            name="last_name" id="last_name" min="2" max="60" required autofocus
                            value="{{ old('last_name', optional($model)->last_name) }}" />
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                            name="first_name" id="last_name" min="2" max="60" required
                            value="{{ old('first_name', optional($model)->first_name) }}" />
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="mi">MI</label>
                        <input type="text" class="form-control @error('mi') is-invalid @enderror" name="mi" id="mi"
                            min="1" max="3" value="{{ old('mi', optional($model)->mi) }}" />
                        @error('mi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select class="custom-select @error('sex') is-invalid @enderror" name="sex" id="sex">
                            <option>Select...</option>
                            <option value="M" {{ old('sex', optional($model)->sex) === 'M' ? 'selected':'' }}>Male
                            </option>
                            <option value="F" {{ old('sex', optional($model)->sex) === 'F' ? 'selected':'' }}>Female
                            </option>
                        </select>
                        @error('sex')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="form-group">
                        <label for="station">Station</label>
                        <input type="text" class="form-control @error('station') is-invalid @enderror" name="station"
                            id="last_name" min="2" max="255" value="{{ old('station', optional($model)->station) }}" />
                        @error('station')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" data-role="tagsinput"
                            class="form-control @error('mobile.*') is-invalid @enderror" name="mobile" id="mobile"
                            min="11" max="255" value="{{ old('mobile', optional($model)->mobile) }}" required />
                        @error('mobile.*')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" data-role="tagsinput"
                            class="form-control @error('email.*') is-invalid @enderror" name="email" id="email" min="3"
                            max="255" value="{{ old('email', optional($model)->email) }}" />
                        @error('email.*')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="icon-note"></i> SAVE</button>
            <a class="btn btn-link" href="{{ route('participants.index')}}" role="button">Cancel</a>
        </form>
    </div>
</div>
@endsection