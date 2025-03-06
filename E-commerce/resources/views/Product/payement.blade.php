<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Paiement</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-6">Paiement sécurisé</h2>

            <!-- Sélection du mode de paiement -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Choisissez votre méthode de paiement :</h3>

                <div class="space-y-4">
                    <!-- PayPal -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="paypal" class="mr-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/200px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-16">
                        <span class="ml-auto text-gray-600">PayPal</span>
                    </label>

                    <!-- Carte bancaire -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="card" class="mr-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Visa_2014_logo.svg/200px-Visa_2014_logo.svg.png" alt="Visa" class="w-10 mr-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Mastercard-logo.svg/200px-Mastercard-logo.svg.png" alt="Mastercard" class="w-10">
                        <span class="ml-auto text-gray-600">Carte Bancaire</span>
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
                <input type="text" placeholder="Nom sur la carte" class="w-full p-3 border rounded-lg mb-3">
                <input type="text" placeholder="Numéro de carte" class="w-full p-3 border rounded-lg mb-3">
                <div class="flex space-x-3">
                    <input type="text" placeholder="MM/AA" class="w-1/2 p-3 border rounded-lg">
                    <input type="text" placeholder="CVV" class="w-1/2 p-3 border rounded-lg">
                </div>
            </div>

            <!-- Bouton de paiement -->
            <button class="w-full bg-purple-400 text-white font-bold py-3 mt-6 rounded-lg hover:bg-blue-600">
                Payer maintenant
            </button>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Afficher/Masquer le formulaire de carte bancaire selon la sélection
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const cardForm = document.getElementById('card-form');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'card') {
                    cardForm.classList.remove('hidden');
                } else {
                    cardForm.classList.add('hidden');
                }
            });
        });
    </script>

</body>
</html>
