@extends('settings-editor::layouts.app')

@section('content')
    <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto py-5">
        <form id="loginForm" autocomplete="nope" method="post" action="{{ route('torskint.settings_editor.login.post') }}">
            @csrf

            <x-torskint-settings-editor-alert />
            
            <div class="vertical-input-group">
                <div class="input-group">
                    <input type="email" autocomplete="nope" name="email" class="form-control" id="emailAddress" required placeholder="Adresse Email">
                </div>
                <div class="input-group">
                    <input type="password" autocomplete="nope" name="password" class="form-control" id="loginPassword" required placeholder="Mot de passe">
                </div>
            </div>
            <div class="d-grid my-4">
                <button class="btn btn-primary shadow-none" type="submit">Se Connecter</button>
            </div>
        </form>
    </div>
@endsection