<?php

namespace App\Http\Requests\Outils;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinkRequest extends FormRequest
{
    /**
     * Déterminer si l’utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Seuls les admins peuvent mettre à jour les liens
        return auth()->check() && auth()->user()->hasRole('Admin');
    }

    /**
     * Règles de validation pour la requête.
     */
    public function rules(): array
    {
        // On récupère l’ID du lien à mettre à jour pour certaines validations uniques
        $linkId = $this->route('link'); // Supposant que la route contient {link}

        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'icon' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:1000'],
            'role_ids' => ['nullable', 'array'],
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
