@extends('settings-editor::layouts.app')

@section('content')
    <div class="col-11 col-sm-9 col-md-7 col-lg-5 col-xl-4 m-auto py-5">

        <p class="lead text-center mb-3">
            <div class="alert alert-warning">
                <strong>🛑 Attention :</strong><br>
                Vous êtes en train de créer votre mot de passe pour accéder à cette page protégée.<br><br>
                C’est votre <strong>première et seule fois</strong> pour définir ces informations.<br>
                <br>
                📌 <strong>Important :</strong> Gardez bien votre adresse email et votre mot de passe.  
                <br>
                Sans eux, vous ne pourrez plus vous reconnecter plus tard.
            </div>
        </p>

        <form id="loginForm" autocomplete="nope" method="post" action="{{ route('torskint.settings_editor.login.post') }}">
            @csrf

            <x-torskint-settings-editor-alert />
            
            <div class="vertical-input-group">
                <div class="input-group">
                    <input type="email" autocomplete="nope" name="email" class="form-control" id="emailAddress" placeholder="Adresse Email">
                </div>
                <div class="input-group">
                    <input type="password" autocomplete="nope" name="password" class="form-control" id="loginPassword" placeholder="Mot de passe">
                </div>
            </div>
            <div class="d-grid my-4">
                <button class="btn btn-primary shadow-none" type="submit">Se Connecter</button>
            </div>
        </form>
    </div>
@endsection