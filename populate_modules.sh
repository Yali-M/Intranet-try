#!/bin/bash

echo "=== Début de la génération des fichiers PHP avec boilerplate ==="

# ------------------------
# Fonction pour Livewire Components
# ------------------------
populate_component() {
    local file_path=$1
    local namespace=$2
    local class_name=$3
    local view_path=$4

    # Vérifie si le fichier existe
    if [[ -f "$file_path" ]]; then
        mkdir -p "$(dirname "$file_path")"  # Crée le dossier parent si nécessaire

        cat > "$file_path" <<EOL
<?php

namespace App\\Livewire\\$namespace;

use Livewire\Component;

class $class_name extends Component
{
    // Propriétés publiques peuvent être ajoutées ici
    // Ex: public \$tasks;

    public function render()
    {
        // Retourne la vue associée au composant
        return view('livewire.$view_path');
    }
}
EOL
        echo "[Livewire Component] $file_path créé avec boilerplate"
    fi
}

# ------------------------
# Fonction pour Services
# ------------------------
populate_service() {
    local file_path=$1
    local namespace=$2
    local class_name=$3

    if [[ -f "$file_path" ]]; then
        mkdir -p "$(dirname "$file_path")"
        cat > "$file_path" <<EOL
<?php

namespace App\\Services\\$namespace;

class $class_name
{
    // TODO: Ajouter les méthodes du service $class_name ici
}
EOL
        echo "[Service] $file_path créé avec boilerplate"
    fi
}

# ------------------------
# Fonction pour Policies
# ------------------------
populate_policy() {
    local file_path=$1
    local namespace=$2
    local class_name=$3

    if [[ -f "$file_path" ]]; then
        mkdir -p "$(dirname "$file_path")"
        cat > "$file_path" <<EOL
<?php

namespace App\\Policies\\$namespace;

use App\\Models\\User;

class $class_name
{
    // TODO: Ajouter les méthodes d'autorisation pour $class_name
}
EOL
        echo "[Policy] $file_path créé avec boilerplate"
    fi
}

# ------------------------
# Fonction pour Providers
# ------------------------
populate_provider() {
    local file_path=$1
    local namespace=$2
    local class_name=$3

    if [[ -f "$file_path" ]]; then
        mkdir -p "$(dirname "$file_path")"
        cat > "$file_path" <<EOL
<?php

namespace App\\Providers\\$namespace;

use Illuminate\\Support\\ServiceProvider;

class $class_name extends ServiceProvider
{
    public function register()
    {
        // TODO: Lier vos services ici
    }

    public function boot()
    {
        // TODO: Code de démarrage du provider
    }
}
EOL
        echo "[Provider] $file_path créé avec boilerplate"
    fi
}

# ============================
# 1. Valoris Components
# ============================
populate_component "app/Livewire/Valoris/Dashboard.php" "Valoris" "Dashboard" "valoris.dashboard"
populate_component "app/Livewire/Valoris/Points/Balance.php" "Valoris\\Points" "Balance" "valoris.points.balance"
populate_component "app/Livewire/Valoris/Points/History.php" "Valoris\\Points" "History" "valoris.points.history"

populate_component "app/Livewire/Valoris/Shop/Catalog.php" "Valoris\\Shop" "Catalog" "valoris.shop.catalog"
populate_component "app/Livewire/Valoris/Shop/Product.php" "Valoris\\Shop" "Product" "valoris.shop.product"
populate_component "app/Livewire/Valoris/Shop/Orders.php" "Valoris\\Shop" "Orders" "valoris.shop.orders"

populate_component "app/Livewire/Valoris/Declarations/Create.php" "Valoris\\Declarations" "Create" "valoris.declarations.create"
populate_component "app/Livewire/Valoris/Declarations/List.php" "Valoris\\Declarations" "List" "valoris.declarations.list"

populate_component "app/Livewire/Valoris/Admin/Products.php" "Valoris\\Admin" "Products" "valoris.admin.products"
populate_component "app/Livewire/Valoris/Admin/Orders.php" "Valoris\\Admin" "Orders" "valoris.admin.orders"
populate_component "app/Livewire/Valoris/Admin/PointsManagement.php" "Valoris\\Admin" "PointsManagement" "valoris.admin.points-management"

# ============================
# 2. System Components
# ============================
populate_component "app/Livewire/System/HeaderNav.php" "System" "HeaderNav" "system.header-nav"
populate_component "app/Livewire/System/SearchUser.php" "System" "SearchUser" "system.search-user"
populate_component "app/Livewire/System/Notifications.php" "System" "Notifications" "system.notifications"

# ============================
# 3. Services
# ============================
populate_service "app/Services/Notifications/TeamsService.php" "Notifications" "TeamsService"
populate_service "app/Services/Notifications/MattermostService.php" "Notifications" "MattermostService"
populate_service "app/Services/Notifications/NotificationService.php" "Notifications" "NotificationService"

# ============================
# 4. Policies
# ============================
populate_policy "app/Policies/KanbanPolicy.php" "" "KanbanPolicy"
populate_policy "app/Policies/ValorisPolicy.php" "" "ValorisPolicy"
populate_policy "app/Policies/AdminPolicy.php" "" "AdminPolicy"

# ============================
# 5. Providers
# ============================
populate_provider "app/Providers/AppServiceProvider.php" "" "AppServiceProvider"
populate_provider "app/Providers/AuthServiceProvider.php" "" "AuthServiceProvider"
populate_provider "app/Providers/EventServiceProvider.php" "" "EventServiceProvider"

echo "=== Tous les fichiers PHP ont été remplis avec succès ==="
