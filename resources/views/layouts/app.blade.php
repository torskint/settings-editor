<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Éditeur de paramètres</title>

    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('vendor/settings-editor/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/settings-editor/assets/css/custom.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('torskint.settings_editor') }}">Éditeur de paramètres</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container py-4">
        <div class="row">
            
            <div class="col-12">
                @yield('content')
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-auto border-top">
        <div class="container">
            <small>&copy; {{ date('Y') }}. Tous droits réservés.</small>
        </div>
    </footer>

    <!-- Bootstrap JS + Popper -->
    <script src="{{ asset('vendor/settings-editor/assets/js/bootstrap.js') }}"></script>
</body>
</html>