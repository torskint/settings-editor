@extends('settings-editor::layouts.app')

@section('content')
    <form method="POST" autocomplete="nope" action="{{ route('torskint.settings_editor.post') }}" class="mt-3 p-4 bg-white shadow-sm rounded border">
        @csrf
        <h4 class="mb-4">Paramètres du site</h4>

        @foreach(config('torskint-settings-editor.fields') as $key => $field)
            <div class="mb-3">
                <label for="{{ $key }}" class="form-label">{{ $field['label'] }}</label>
                <input 
                    type="{{ $field['type'] }}" 
                    name="{{ $key }}" 
                    value="{{ $settings[$key] ?? '' }}" 
                    class="form-control"
                    id="{{ $key }}"
                    autocomplete="nope" 
                >
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection