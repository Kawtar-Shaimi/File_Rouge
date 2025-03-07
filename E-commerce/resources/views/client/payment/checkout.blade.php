@extends('layouts.app')

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Finalisez votre commande</h2>
        
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
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border rounded-md" required>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <input type="text" id="address" name="address" class="w-full p-3 border rounded-md" required>
                </div>

                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">Ville</label>
                    <input type="text" id="city" name="city" class="w-full p-3 border rounded-md" required>
                </div>

                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">Code postal</label>
                    <input type="text" id="postal_code" name="postal_code" class="w-full p-3 border rounded-md" required>
                </div>
            </div>

            <!-- Sélection du mode de paiement -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4">Méthode de paiement</h3>

                <div class="space-y-4">
                    <!-- PayPal -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="paypal" class="mr-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/200px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-16">
                        <span class="ml-auto text-gray-600">PayPal</span>
                    </label>

                    <!-- Paiement à la livraison -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="cash" class="mr-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/2331/2331940.png" alt="Cash" class="w-10">
                        <span class="ml-auto text-gray-600">Paiement à la livraison</span>
                    </label>
                </div>
            </div>

            <!-- Formulaire Carte Bancaire (affiché seulement si l'option carte est sélectionnée) -->
            <div id="card-form" class="mt-6 hidden">
                <h3 class="text-lg font-semibold mb-3">Informations de votre carte</h3>
                <div class="space-y-4">
                    <input type="text" placeholder="Nom sur la carte" class="w-full p-3 border rounded-md">
                    <input type="text" placeholder="Numéro de carte" class="w-full p-3 border rounded-md">
                    <div class="flex space-x-3">
                        <input type="text" placeholder="MM/AA" class="w-1/2 p-3 border rounded-md">
                        <input type="text" placeholder="CVV" class="w-1/2 p-3 border rounded-md">
                    </div>
                </div>
            </div>

            <!-- Bouton de paiement -->
            <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600">
                Passer la commande
            </button>
        </form>
    </div>
</div>

@endsection