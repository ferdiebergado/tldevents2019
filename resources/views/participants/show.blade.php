@extends('layouts.app')

@section('title', __('participant.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('participant.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('participant.name') }}</td><td>{{ $participant->name }}</td></tr>
                        <tr><td>{{ __('participant.description') }}</td><td>{{ $participant->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $participant)
                    <a href="{{ route('participants.edit', $participant) }}" id="edit-participant-{{ $participant->id }}" class="btn btn-warning">{{ __('participant.edit') }}</a>
                @endcan
                <a href="{{ route('participants.index') }}" class="btn btn-link">{{ __('participant.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
