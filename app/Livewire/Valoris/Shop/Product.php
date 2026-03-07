
│  ├─ Livewire/
│  │  │
│  │  ├─ Valoris/
│  │  │  ├─ Dashboard.php
│  │  │  │
│  │  │  ├─ Points/
│  │  │  │   ├─ Balance.php
│  │  │  │   └─ History.php
│  │  │  │
│  │  │  ├─ Shop/
│  │  │  │   ├─ Catalog.php
│  │  │  │   ├─ Product.php
│  │  │  │   └─ Orders.php
│  │  │  │
│  │  │  ├─ Declarations/
│  │  │  │   ├─ Create.php
│  │  │  │   └─ List.php
│  │  │  │
│  │  │  └─ Admin/
│  │  │      ├─ Products.php
│  │  │      ├─ Orders.php
│  │  │      └─ PointsManagement.php
│  │  │
│  │  └─ System/
│  │      ├─ HeaderNav.php
│  │      ├─ SearchUser.php
│  │      └─ Notifications.php
│  │
│  ├─ Models/
│  │  ├─ User.php
│  │  ├─ Kanboard.php
│  │  ├─ KanboardColonne.php
│  │  ├─ KanboardTache.php
│  │  │
│  │  ├─ ValorisProduit.php
│  │  ├─ ValorisAchat.php
│  │  ├─ ValorisHistory.php
│  │  ├─ ValorisDeclaration.php
│  │  └─ ValorisDeclarationMembre.php
│  │
│  ├─ Notifications/
│  │  ├─ PointsAddedNotification.php
│  │  ├─ GoodieOrderNotification.php
│  │  └─ KanbanTaskNotification.php
│  │
│  ├─ Policies/
│  │  ├─ KanbanPolicy.php
│  │  ├─ ValorisPolicy.php
│  │  └─ AdminPolicy.php
│  │
│  ├─ Providers/
│  │  ├─ AppServiceProvider.php
│  │  ├─ AuthServiceProvider.php
│  │  └─ EventServiceProvider.php
│  │
│  ├─ Services/
│  │  ├─ Auth/
│  │  │   ├─ AzureService.php
│  │  │   └─ KeycloakService.php
│  │  │
│  │  ├─ Notifications/
│  │  │   ├─ TeamsService.php
│  │  │   ├─ MattermostService.php
│  │  │   └─ NotificationService.php
│  │  │
│  │  ├─ Storage/
│  │  │   ├─ SharepointService.php
│  │  │   └─ InternalStorageService.php
│  │  │
│  │  ├─ KanbanService.php
│  │  ├─ PointsService.php
│  │  ├─ ShopService.php
│  │  └─ DeclarationService.php
│  │
│  └─ View/
│      └─ Components/
│          ├─ Layout.php
│          └─ Sidebar.php
│
├─ bootstrap/
│
├─ config/
│  ├─ services.php
│  ├─ valoris.php
│  ├─ kanban.php
│  └─ intranet.php
│
