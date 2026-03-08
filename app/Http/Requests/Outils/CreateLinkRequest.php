<?php

namespace App\Http\Requests\Outils;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
{
    /**
     * Déterminer si l’utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Ici on peut ajouter une logique de rôle, par exemple uniquement admin
        return auth()->check() && auth()->user()->hasRole('Admin');
    }

    /**
     * Règles de validation pour la requête.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],          // Titre du lien
            'url' => ['required', 'url', 'max:2048'],             // URL valide
            'icon' => ['nullable', 'string', 'max:100'],          // Optionnel : icône
            'description' => ['nullable', 'string', 'max:1000'],  // Optionnel : description
            'role_ids' => ['nullable', 'array'],                  // IDs des rôles autorisés
            'role_ids.*' => ['integer', 'exists:roles,id'],
        ];
    }

    /**
     * Messages personnalisés pour les erreurs de validation.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du lien est obligatoire.',
            'url.required' => 'L’URL du lien est obligatoire.',
            'url.url' => 'L’URL doit être valide.',
            'role_ids.*.exists' => 'Le rôle sélectionné est invalide.',
        ];
    }
}
