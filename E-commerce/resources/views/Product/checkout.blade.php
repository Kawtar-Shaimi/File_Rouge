<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Checkout - Commande</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6">Finalisez votre commande</h2>
            
            <!-- Récapitulatif de la commande -->
            <div class="border-b pb-4 mb-4">
                <h3 class="text-xl font-semibold mb-4">Récapitulatif de la commande</h3>
                <div class="flex justify-between mb-2">
                    <span>Total des produits:</span>
                    <span class="font-bold">$29.99</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Réduction:</span>
                    <span class="text-red-500">-$5.00</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total à payer:</span>
                    <span>$24.99</span>
                </div>
            </div>

            <!-- Formulaire d'adresse -->
            <h3 class="text-xl font-semibold mb-4">Adresse de livraison</h3>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" id="name" name="name" class="w-full p-2 mt-1 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" id="address" name="address" class="w-full p-2 mt-1 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" id="city" name="city" class="w-full p-2 mt-1 border rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                    <input type="text" id="postal_code" name="postal_code" class="w-full p-2 mt-1 border rounded-md" required>
                </div>

                <!-- Sélection du mode de paiement -->
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Méthode de paiement</label>
                    <select id="payment_method" name="payment_method" class="w-full p-2 mt-1 border rounded-md" required>
                        <option value="paypal">PayPal</option>
                        <option value="delivery">Livraison à l'adresse</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600">
                    Passer la commande
                </button>
            </form>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>
