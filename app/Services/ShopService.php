<?php

namespace App\Services;

use App\Models\User;
use App\Models\ValorisProduit;
use App\Models\ValorisAchat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class ShopService
{
    /**
     * Lister tous les produits disponibles
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProducts()
    {
        return ValorisProduit::where('stock', '>', 0)
            ->orderBy('prix_valoris', 'asc')
            ->get();
    }

    /**
     * Obtenir un produit spécifique par ID
     *
     * @param int $productId
     * @return ValorisProduit|null
     */
    public function getProduct(int $productId)
    {
        return ValorisProduit::find($productId);
    }

    /**
     * Acheter un produit pour un utilisateur
     *
     * @param User|null $user
     * @param int $productId
     * @param int $quantity
     * @return ValorisAchat
     * @throws Exception
     */
    public function purchaseProduct(?User $user, int $productId, int $quantity = 1): ValorisAchat
    {
        $user = $user ?? Auth::user();
        $product = $this->getProduct($productId);

        if (!$product) {
            throw new Exception('Produit introuvable.');
        }

        if ($product->stock < $quantity) {
            throw new Exception('Stock insuffisant.');
        }

        $totalCost = $product->prix_valoris * $quantity;

        if ($user->valoris < $totalCost) {
            throw new Exception('Points Valoris insuffisants.');
        }

        return DB::transaction(function () use ($user, $product, $quantity, $totalCost) {

            // Débiter les points de l'utilisateur
            $user->valoris -= $totalCost;
            $user->save();

            // Décrémenter le stock
            $product->stock -= $quantity;
            $product->save();

            // Créer l'enregistrement d'achat
            $achat = ValorisAchat::create([
                'user_id' => $user->id,
                'produit_id' => $product->id,
                'quantite' => $quantity,
                'prix_total' => $totalCost,
            ]);

            return $achat;
        });
    }

    /**
     * Ajouter un produit dans la boutique
     *
     * @param array $data
     * @return ValorisProduit
     */
    public function addProduct(array $data): ValorisProduit
    {
        return ValorisProduit::create([
            'nom' => $data['nom'],
            'description' => $data['description'] ?? null,
            'prix_valoris' => $data['prix_valoris'],
            'stock' => $data['stock'] ?? 0,
            'image' => $data['image'] ?? null,
        ]);
    }

    /**
     * Mettre à jour un produit existant
     *
     * @param ValorisProduit $product
     * @param array $data
     * @return ValorisProduit
     */
    public function updateProduct(ValorisProduit $product, array $data): ValorisProduit
    {
        $product->update($data);
        return $product;
    }

    /**
     * Supprimer un produit
     *
     * @param ValorisProduit $product
     * @return bool|null
     */
    public function deleteProduct(ValorisProduit $product)
    {
        return $product->delete();
    }
}
