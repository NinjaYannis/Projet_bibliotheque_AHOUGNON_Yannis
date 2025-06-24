<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Bibliothèque</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-4 text-xl font-bold border-b border-blue-700">
                Bibliothèque
            </div>
            <nav class="flex-1 p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
                    <li><a href="{{ route('abonnes.index') }}" class="block hover:bg-blue-700 p-2 rounded">Abonnés</a></li>
                    <li><a href="{{ route('livres.index') }}" class="block hover:bg-blue-700 p-2 rounded">Livres</a></li>
                    <li><a href="{{ route('prets.index') }}" class="block hover:bg-blue-700 p-2 rounded">Prêts</a></li>
                    <li><a href="{{ route('penalites.index') }}" class="block hover:bg-blue-700 p-2 rounded">Pénalités</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-blue-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left hover:bg-blue-700 p-2 rounded">Déconnexion</button>
                </form>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1 p-6">
            <h1 class="text-2xl font-bold mb-4">@yield('title')</h1>
            @yield('content')
        </div>

    </div>

</body>
</html>