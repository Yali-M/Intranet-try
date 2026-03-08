#!/bin/bash

# =========================================
# Script: Generate Blade view files
# =========================================

echo "Generating Blade view files..."

create_blade_view() {
    local file_path=$1
    local title=$2

    mkdir -p "$(dirname "$file_path")"

    cat > "$file_path" <<EOL
<div>
    <h2>$title Component</h2>
    <p>This is a placeholder for the $title Livewire component.</p>
</div>
EOL
}

# ----------------------------
# Kanban views
# ----------------------------
create_blade_view "resources/views/livewire/kanban/board.blade.php" "Kanban Board"
create_blade_view "resources/views/livewire/kanban/task.blade.php" "Kanban Task"
create_blade_view "resources/views/livewire/kanban/create-task.blade.php" "Kanban Create Task"

# ----------------------------
# RH → Absences
# ----------------------------
create_blade_view "resources/views/livewire/rh/absences/liste.blade.php" "Absences Liste"
create_blade_view "resources/views/livewire/rh/absences/demande.blade.php" "Absences Demande"

# ----------------------------
# RH → Benevoles
# ----------------------------
create_blade_view "resources/views/livewire/rh/benevoles/liste-utilisateurs.blade.php" "Benevoles Liste Utilisateurs"

# ----------------------------
# RH → Recrutement
# ----------------------------
create_blade_view "resources/views/livewire/rh/recrutement/campagnes.blade.php" "Recrutement Campagnes"
create_blade_view "resources/views/livewire/rh/recrutement/candidatures.blade.php" "Recrutement Candidatures"

echo "✅ Blade view files generated!"
