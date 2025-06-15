@extends('settings-editor::layouts.app')

@section('content')
    <div class="col-12 m-auto py-5">

        <form method="POST" autocomplete="nope" action="{{ route('torskint.settings_editor.post') }}" class="p-4">
            @csrf
            <h2 class="mb-4">Paramètres du site</h2>

            <x-torskint-settings-editor-alert />

            @foreach(config('torskint-settings-editor.fields') as $key => $field)
                <div class="mb-3">
                    <label for="{{ $key }}" class="form-label fw-bold">
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

            <div class="my-4">
                <button class="btn btn-primary shadow-none" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
@endsection