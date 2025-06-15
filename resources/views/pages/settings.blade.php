@extends('settings-editor::layouts.app')

@section('content')
    <div class="col-12 m-auto py-5">

        <form method="POST" autocomplete="nope" action="{{ route('torskint.settings_editor.post') }}" class="mt-3 p-4 bg-white shadow-sm rounded border">
            @csrf
            <h4 class="mb-4">Paramètres du site</h4>

            @foreach(config('torskint-settings-editor.fields') as $key => $field)
                <div class="mb-3">
                    <label for="{{ $key }}" class="form-label">
                        <span>{{ $field['label'] }}</span>

                        @if( !empty($field['required']) )
                            <span class="ml-1 badge bg-danger">requis</span>
                        @endif
                    </label>
                    <input 
                        type="{{ $field['type'] ?? 'text' }}" 
                        name="{{ $key }}" 
                        value="{{ $settings[$key] ?? '' }}" 
                        class="form-control"
                        id="{{ $key }}"
                        placeholder="{{ $field['placeholder'] ?? '' }}"
                        @if(!empty($field['required'])) required @endif
                        autocomplete="off"
                    >
                </div>
            @endforeach

            <div class="d-grid my-4">
                <button class="btn btn-primary shadow-none" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection