<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Storage\SharepointService;
use App\Services\Storage\InternalStorageService;
use Illuminate\Support\Facades\Log;

class SyncSharepointDocuments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ?string $folder;

    /**
     * Crée une nouvelle instance du job.
     *
     * @param string|null $folder Nom du dossier à synchroniser (null pour tous)
     */
    public function __construct(?string $folder = null)
    {
        $this->folder = $folder;
    }

    /**
     * Exécute le job.
     */
    public function handle(SharepointService $sharepoint, InternalStorageService $internalStorage)
    {
        try {
            // Récupération des documents depuis SharePoint
            $documents = $sharepoint->getDocuments($this->folder);

            foreach ($documents as $document) {
                // Sauvegarde dans le stockage interne
                $internalStorage->saveDocument(
                    $document['name'],
                    $document['content'],
                    $document['path'] ?? $this->folder
                );
            }

            Log::info("Synchronisation SharePoint terminée pour le dossier: " . ($this->folder ?? 'tous'));
        } catch (\Exception $e) {
            Log::error("Erreur lors de la synchronisation SharePoint: " . $e->getMessage());
            // Optionnel : relancer le job dans 5 minutes
            // $this->release(300);
        }
    }
}
