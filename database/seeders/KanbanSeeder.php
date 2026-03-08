<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KanbanColumn;
use App\Models\KanbanTask;

class KanbanSeeder extends Seeder
{
    public function run(): void
    {

        // Création des colonnes

        $todo = KanbanColumn::create([
            'name' => 'À faire',
            'order' => 1
        ]);

        $progress = KanbanColumn::create([
            'name' => 'En cours',
            'order' => 2
        ]);

        $review = KanbanColumn::create([
            'name' => 'Validation',
            'order' => 3
        ]);

        $done = KanbanColumn::create([
            'name' => 'Terminé',
            'order' => 4
        ]);

        // Création de tâches de démonstration

        KanbanTask::create([
            'title' => 'Installer le projet',
            'description' => 'Installation de l’intranet Laravel',
            'column_id' => $todo->id,
            'priority' => 'high'
        ]);

        KanbanTask::create([
            'title' => 'Configurer les rôles',
            'description' => 'Créer les rôles admin et utilisateur',
            'column_id' => $progress->id,
            'priority' => 'medium'
        ]);

        KanbanTask::create([
            'title' => 'Validation module RH',
            'description' => 'Tester le module des absences',
            'column_id' => $review->id,
            'priority' => 'medium'
        ]);

        KanbanTask::create([
            'title' => 'Initialisation terminée',
            'description' => 'Projet prêt pour développement',
            'column_id' => $done->id,
            'priority' => 'low'
        ]);

    }
}
