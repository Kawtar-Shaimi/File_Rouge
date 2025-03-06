<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Panier</title>
</head>
<body class="bg-gray-100 text-gray-900">
    
    @include('layouts.header')

    <div class="container mx-auto p-6">
        <div class="grid grid-cols-3 gap-6">
            <!-- Section Panier -->
            <div class="col-span-2 bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-4">Mon Panier</h2>
                <div class="border-b pb-4 mb-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/100" class="w-24 h-24 rounded-md mr-4">
                        <div>
                            <h3 class="text-lg font-semibold">Produit Exemple</h3>
                            <p class="text-gray-600">Taille: M | Couleur: Bleu</p>
                            <p class="text-green-500 font-bold">$29.99</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button class="bg-gray-300 px-2 py-1 rounded-l">-</button>
                        <input type="text" value="1" class="w-12 text-center border">
                        <button class="bg-gray-300 px-2 py-1 rounded-r">+</button>
                        <button class="text-red-500 ml-4">🗑</button>
                    </div>
                </div>
            </div>
            
            <!-- Récapitulatif -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold mb-4">Récapitulatif</h2>
                <div class="flex justify-between mb-2">
                    <span>Total:</span>
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
                <button class="w-full bg-blue-500 text-white font-bold py-3 mt-4 rounded-lg">Passer la commande</button>
            </div>
        </div>

        <!-- Cartes bancaires -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Voilà les cartes bancaires que nous acceptons</h2>
            <div class="flex space-x-6">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/1024px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-24 h-24">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Visa_2014_logo.svg/1024px-Visa_2014_logo.svg.png" alt="Visa" class="w-24 h-24">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Mastercard-logo.svg/1024px-Mastercard-logo.svg.png" alt="Mastercard" class="w-24 h-24">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Amex_logo.svg/1024px-Amex_logo.svg.png" alt="American Express" class="w-24 h-24">
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
