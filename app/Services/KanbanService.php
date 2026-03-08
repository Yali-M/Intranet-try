<?php

namespace App\Services;

use App\Models\Kanboard;
use App\Models\KanboardColonne;
use App\Models\KanboardTache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KanbanService
{
    /**
     * Crée un nouveau tableau Kanban
     *
     * @param string $title
     * @param array $options
     * @return Kanboard
     */
    public function createBoard(string $title, array $options = []): Kanboard
    {
        return Kanboard::create([
            'title' => $title,
            'description' => $options['description'] ?? null,
            'user_id' => Auth::id(),
            'team_id' => $options['team_id'] ?? null,
        ]);
    }

    /**
     * Crée une nouvelle colonne pour un tableau Kanban
     *
     * @param Kanboard $board
     * @param string $name
     * @param int $position
     * @return KanboardColonne
     */
    public function createColumn(Kanboard $board, string $name, int $position = 0): KanboardColonne
    {
        return KanboardColonne::create([
            'kanboard_id' => $board->id,
            'name' => $name,
            'position' => $position,
        ]);
    }

    /**
     * Crée une nouvelle tâche dans une colonne
     *
     * @param KanboardColonne $column
     * @param string $title
     * @param array $options
     * @return KanboardTache
     */
    public function createTask(KanboardColonne $column, string $title, array $options = []): KanboardTache
    {
        return KanboardTache::create([
            'colonne_id' => $column->id,
            'title' => $title,
            'description' => $options['description'] ?? null,
            'assigned_to' => $options['assigned_to'] ?? null,
            'due_date' => $options['due_date'] ?? null,
            'status' => $options['status'] ?? 'todo',
            'priority' => $options['priority'] ?? 1,
        ]);
    }

    /**
     * Déplace une tâche vers une autre colonne
     *
     * @param KanboardTache $task
     * @param KanboardColonne $targetColumn
     * @return KanboardTache
     */
    public function moveTask(KanboardTache $task, KanboardColonne $targetColumn): KanboardTache
    {
        $task->colonne_id = $targetColumn->id;
        $task->save();

        return $task;
    }

    /**
     * Récupère toutes les tâches d'un tableau
     *
     * @param Kanboard $board
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBoardTasks(Kanboard $board)
    {
        return KanboardTache::whereIn(
            'colonne_id',
            $board->colonnes()->pluck('id')
        )->orderBy('priority', 'desc')->get();
    }

    /**
     * Récupère un tableau complet avec colonnes et tâches
     *
     * @param Kanboard $board
     * @return Kanboard
     */
    public function getBoardWithDetails(Kanboard $board): Kanboard
    {
        return $board->load(['colonnes.taches']);
    }
}
