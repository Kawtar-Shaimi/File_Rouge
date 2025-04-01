import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/addOneToCart.js',
                'resources/js/addToCart.js',
                'resources/js/cartScript.js',
                'resources/js/removeFromCart.js',
                'resources/js/trackOrderScript.js',
                'resources/js/addToWishlist.js',
                'resources/js/removeFromWishlist.js',
                'resources/js/deleteFromWishlist.js',
                'resources/js/productReviewScript.js'
            ],
            refresh: true,
        }),
    ],
});
