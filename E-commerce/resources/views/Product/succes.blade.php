<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Commande réussie</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-green-600 mb-6">Commande passée avec succès !</h2>
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-16 h-16 mx-auto text-green-500">
                    <path fill-rule="evenodd" d="M16.293 5.293a1 1 0 00-1.414 0L8 11.586 4.121 7.707a1 1 0 10-1.414 1.414l4.5 4.5a1 1 0 001.414 0l8-8a1 1 0 000-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-xl font-semibold text-gray-700 mb-6">Merci pour votre achat ! Votre commande a été reçue et est en cours de traitement.</p>
            
            <button onclick="window.location.href='/'" class="bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600">
                Retour à la page d'accueil
            </button>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
