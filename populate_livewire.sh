#!/bin/bash

# =========================================
# Script: Populate Livewire PHP classes
# =========================================

echo "Populating Livewire PHP component files..."

# Function to write boilerplate PHP for Livewire
create_livewire_php() {
    local file_path=$1
    local namespace=$2
    local class_name=$3
    local view_path=$4

    mkdir -p "$(dirname "$file_path")"

    cat > "$file_path" <<EOL
<?php

namespace App\\Livewire\\$namespace;

use Livewire\Component;

class $class_name extends Component
{
    public function render()
    {
        return view('livewire.$view_path');
    }
}
EOL
}

# ----------------------------
# Kanban components
# ----------------------------
create_livewire_php "app/Livewire/Kanban/Board.php" "Kanban" "Board" "kanban.board"
create_livewire_php "app/Livewire/Kanban/Task.php" "Kanban" "Task" "kanban.task"
create_livewire_php "app/Livewire/Kanban/CreateTask.php" "Kanban" "CreateTask" "kanban.create-task"

# ----------------------------
# RH → Absences
# ----------------------------
create_livewire_php "app/Livewire/RH/Absences/Liste.php" "RH\\Absences" "Liste" "rh.absences.liste"
create_livewire_php "app/Livewire/RH/Absences/Demande.php" "RH\\Absences" "Demande" "rh.absences.demande"

# ----------------------------
# RH → Benevoles
# ----------------------------
create_livewire_php "app/Livewire/RH/Benevoles/ListeUtilisateurs.php" "RH\\Benevoles" "ListeUtilisateurs" "rh.benevoles.liste-utilisateurs"

# ----------------------------
# RH → Recrutement
# ----------------------------
create_livewire_php "app/Livewire/RH/Recrutement/Campagnes.php" "RH\\Recrutement" "Campagnes" "rh.recrutement.campagnes"
create_livewire_php "app/Livewire/RH/Recrutement/Candidatures.php" "RH\\Recrutement" "Candidatures" "rh.recrutement.candidatures"

echo "✅ Livewire PHP classes populated!"
