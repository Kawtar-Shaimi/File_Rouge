<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Créer une Catégorie</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <!-- Formulaire de Création -->
    <div class="container mx-auto p-6 max-w-lg">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Créer une Nouvelle Catégorie</h2>
            
            <form action="#" method="POST" enctype="multipart/form-data">
                <!-- Nom de la catégorie -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Nom de la Catégorie</label>
                    <input type="text" id="name" name="name" required
                        class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ex: Smartphones">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold">Description</label>
                    <textarea id="description" name="description" rows="3" required
                        class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" placeholder="Ajoutez une description..."></textarea>
                </div>

                <!-- Image de la catégorie -->
                <div class="mb-4">
                    <label for="image" class="block text-lg font-semibold">Image de la Catégorie</label>
                    <input type="file" id="image" name="image" accept="image/*" required
                        class="w-full mt-2 p-2 border rounded-lg bg-gray-100">
                </div>

                <!-- Bouton de soumission -->
                <button type="submit"
                    class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Ajouter la Catégorie</button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>