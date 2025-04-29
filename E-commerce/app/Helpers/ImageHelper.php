<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get the URL for a book image with fallback to a default image
     * 
     * @param string|null $imagePath The path to the image
     * @return string The URL to the image
     */
    public static function getBookImageUrl($imagePath)
    {
        // Vérifier si le chemin de l'image est vide
        if (empty($imagePath)) {
            return 'https://dummyimage.com/600x800/e0e0e0/333333.jpg&text=No+Image';
        }

        // Si l'image commence par http ou https, c'est déjà une URL complète
        if (preg_match('/^https?:\/\//', $imagePath)) {
            return $imagePath;
        }

        // Retourner directement le chemin sans vérifier l'existence (pour éviter les problèmes de performance)
        return asset('storage/' . $imagePath);
    }
} 