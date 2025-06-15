<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="{{ asset('vendor/settings-editor/assets/images/favicon.png') }}" rel="icon" />
    <title>Éditeur de paramètres</title>

    <!-- Web Fonts
    ========================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

    <!-- Stylesheet
    ========================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/settings-editor/assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/settings-editor/assets/css/font-awesome.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/settings-editor/assets/css/stylesheet.css') }}" />
</head>
<body>
    <div id="main-wrapper" class="oxyy-login-register min-vh-100 d-flex flex-column bg-body-secondary">
        <div class="container my-auto">
            <div class="row g-0">

                @yield('content')

            </div>
        </div>
        <div class="container-fluid bg-white py-2">
            <p class="text-center text-2 text-muted mb-0">&copy; 2025. Tous droits réservés.</p>
        </div>
    </div> 

    <!-- Script --> 
    <script src="{{ asset('vendor/settings-editor/assets/js/jquery.min.js') }}"></script> 
    <script src="{{ asset('vendor/settings-editor/assets/js/bootstrap.js') }}"></script> 
</body>
</html>