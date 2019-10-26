@extends('layouts.app')

@section('title', __('participant.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $participant)
        @can('delete', $participant)
            <div class="card">
                <div class="card-header">{{ __('participant.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('participant.name') }}</label>
                    <p>{{ $participant->name }}</p>
                    <label class="form-label text-primary">{{ __('participant.description') }}</label>
                    <p>{{ $participant->description }}</p>
                    {!! $errors->first('participant_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('participant.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('participants.destroy', $participant) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="participant_id" type="hidden" value="{{ $participant->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('participants.edit', $participant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('participant.edit') }}</div>
            <form method="POST" action="{{ route('participants.update', $participant) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('participant.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $participant->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('participant.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $participant->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('participant.update') }}" class="btn btn-success">
                    <a href="{{ route('participants.show', $participant) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $participant)
                        <a href="{{ route('participants.edit', [$participant, 'action' => 'delete']) }}" id="del-participant-{{ $participant->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
