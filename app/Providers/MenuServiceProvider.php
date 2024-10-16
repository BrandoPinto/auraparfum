<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot()
  {
    // Definir el menú directamente
    $menuData = [
      [
        "url" => "/dashboard",
        "name" => "Inicio",
        "icon" => "menu-icon tf-icons bx bx-home-circle",
        "slug" => "dashboard"
      ],
      [
        "menuHeader" => "Administración",
        "submenu" => [
          [
            "url" => "#",
            "name" => "Mis tiendas",
            "icon" => "menu-icon tf-icons bx bx-store",
            "slug" => "mis_tiendas"
          ],
          [
            "url" => "#",
            "name" => "Mis ingresos",
            "icon" => "menu-icon tf-icons bx bx-money",
            "slug" => "mis_ingresos"
          ],
          [
            "url" => "#",
            "name" => "Usuarios",
            "icon" => "menu-icon tf-icons bx bx-user",
            "slug" => "usuarios"
          ],
          [
            "url" => "#",
            "name" => "Stock General",
            "icon" => "menu-icon tf-icons bx bx-archive",
            "slug" => "stock_general"
          ]
        ]
      ],
      [
        "menuHeader" => "Tienda",
        "submenu" => [
          [
            "url" => "#",
            "name" => "Stock tienda",
            "icon" => "menu-icon tf-icons bx bxs-store-alt",
            "slug" => "stock_tienda"
          ]
        ]
      ],
      [
        "menuHeader" => "Ventas",
        "submenu" => [
          [
            "url" => "/servicios",
            "name" => "Nueva venta",
            "icon" => "menu-icon tf-icons bx bx-list-ul",
            "slug" => "nueva_venta"
          ]
        ]
      ],

    ];

    // Filtrar el menú según el rol del usuario
    $role = 1;
    $filteredMenu = $this->filterMenuByRole($menuData, $role);

    // Compartir el menú filtrado con todas las vistas

  }

  /**
   * Filtra el menú según el rol del usuario.
   *
   * @param array $menuData
   * @param int $role
   * @return array
   */
  private function filterMenuByRole(array $menuData, $role)
  {
    // Definir qué roles tienen acceso a qué menús
    $rolePermissions = [
      1 => ['dashboard', 'mis_tiendas', 'mis_ingresos', 'usuarios', 'stock_general'],
      2 => ['dashboard', 'stock_tienda', 'nueva_venta', 'perfil'],
    ];

    $allowedSlugs = $rolePermissions[$role] ?? [];

    // Filtrar el menú
    $filteredMenu = array_filter($menuData, function ($item) use ($allowedSlugs) {
      if (isset($item['slug'])) {
        return in_array($item['slug'], $allowedSlugs);
      } elseif (isset($item['menuHeader'])) {
        // Mantener el header si tiene elementos permitidos en el submenu
        if (isset($item['submenu'])) {
          $filteredSubmenu = array_filter($item['submenu'], function ($submenuItem) use ($allowedSlugs) {
            return in_array($submenuItem['slug'], $allowedSlugs);
          });
          return count($filteredSubmenu) > 0;
        }
        return true;
      }
      return false;
    });

    return array_values($filteredMenu);
  }
}
