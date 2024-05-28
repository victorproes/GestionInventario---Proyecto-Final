<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Categorías
        Permission::create([
            'name'=> 'Navegar categorías',
            'slug'=> 'categories.index',
            'description'=> 'Lista y navega por todas las categorías del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de las categorías',
            'slug'=> 'categories.show',
            'description'=> 'Ver en detalle cada categoría del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de categorías',
            'slug'=> 'categories.edit',
            'description'=> 'Editar cualquier dato de una categoría del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de categorías',
            'slug'=> 'categories.create',
            'description'=> 'Crea cualquier dato de una categoría del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar categorías',
            'slug'=> 'categories.destroy',
            'description'=> 'Eliminar cualquier dato de una categoría del sistema'
        ]);

        // Negocios
        Permission::create([
            'name'=> 'Navegar negocios',
            'slug'=> 'business.index',
            'description'=> 'Lista y navega por todos los negocios del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de negocios',
            'slug'=> 'business.edit',
            'description'=> 'Editar cualquier dato de un negocio del sistema'
        ]);

        // Clientes
        Permission::create([
            'name'=> 'Navegar clientes',
            'slug'=> 'clients.index',
            'description'=> 'Lista y navega por todos los clientes del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de los clientes',
            'slug'=> 'clients.show',
            'description'=> 'Ver en detalle cada cliente del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de clientes',
            'slug'=> 'clients.edit',
            'description'=> 'Editar cualquier dato de un cliente del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de clientes',
            'slug'=> 'clients.create',
            'description'=> 'Crea cualquier dato de un cliente del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar clientes',
            'slug'=> 'clients.destroy',
            'description'=> 'Eliminar cualquier dato de un cliente del sistema'
        ]);

        // Impresoras
        Permission::create([
            'name'=> 'Navegar impresoras',
            'slug'=> 'printers.index',
            'description'=> 'Lista y navega por todas las impresoras del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de impresoras',
            'slug'=> 'printers.edit',
            'description'=> 'Editar cualquier dato de una impresora del sistema'
        ]);

        // Productos
        Permission::create([
            'name'=> 'Navegar productos',
            'slug'=> 'products.index',
            'description'=> 'Lista y navega por todos los productos del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de los productos',
            'slug'=> 'products.show',
            'description'=> 'Ver en detalle cada producto del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de productos',
            'slug'=> 'products.edit',
            'description'=> 'Editar cualquier dato de un producto del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de productos',
            'slug'=> 'products.create',
            'description'=> 'Crea cualquier dato de un producto del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar productos',
            'slug'=> 'products.destroy',
            'description'=> 'Eliminar cualquier dato de un producto del sistema'
        ]);

        Permission::create([
            'name'=> 'Cambiar estado de producto',
            'slug'=> 'change.status.products',
            'description'=> 'Permite cambiar el estado de un producto'
        ]);

        // Proveedores
        Permission::create([
            'name'=> 'Navegar proveedores',
            'slug'=> 'providers.index',
            'description'=> 'Lista y navega por todos los proveedores del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de los proveedores',
            'slug'=> 'providers.show',
            'description'=> 'Ver en detalle cada proveedor del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de proveedores',
            'slug'=> 'providers.edit',
            'description'=> 'Editar cualquier dato de un proveedor del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de proveedores',
            'slug'=> 'providers.create',
            'description'=> 'Crea cualquier dato de un proveedor del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar proveedores',
            'slug'=> 'providers.destroy',
            'description'=> 'Eliminar cualquier dato de un proveedor del sistema'
        ]);

        // Compras
        Permission::create([
            'name'=> 'Navegar compras',
            'slug'=> 'purchases.index',
            'description'=> 'Lista y navega por todas las compras del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de las compras',
            'slug'=> 'purchases.show',
            'description'=> 'Ver en detalle cada compra del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de compras',
            'slug'=> 'purchases.create',
            'description'=> 'Crea cualquier dato de una compra del sistema'
        ]);
        Permission::create([
            'name'=> 'Generar PDF de compras',
            'slug'=> 'purchases.pdf',
            'description'=> 'Generar un PDF de una compra del sistema'
        ]);
        Permission::create([
            'name'=> 'Cambio de estado de compras',
            'slug'=> 'change_status.purchases',
            'description'=> 'Cambiar el estado de una compra del sistema'
        ]);

        Permission::create([
            'name'=> 'Subir archivo de compra',
            'slug'=> 'upload.purchases',
            'description'=> 'Puede subir comprobantes de una compra'
        ]);

        // Ventas
        Permission::create([
            'name'=> 'Navegar ventas',
            'slug'=> 'sales.index',
            'description'=> 'Lista y navega por todas las ventas del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de las ventas',
            'slug'=> 'sales.show',
            'description'=> 'Ver en detalle cada venta del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de ventas',
            'slug'=> 'sales.create',
            'description'=> 'Crea cualquier dato de una venta del sistema'
        ]);
        Permission::create([
            'name'=> 'Generar PDF de ventas',
            'slug'=> 'sales.pdf',
            'description'=> 'Generar un PDF de una venta del sistema'
        ]);
        Permission::create([
            'name'=> 'Imprimir ventas',
            'slug'=> 'sales.print',
            'description'=> 'Imprimir una venta del sistema'
        ]);
        Permission::create([
            'name'=> 'Cambio de estado de ventas',
            'slug'=> 'change.status.sales',
            'description'=> 'Cambiar el estado de una venta del sistema'
        ]);

        // Reportes
        Permission::create([
            'name'=> 'Ver reportes del día',
            'slug'=> 'reports.day',
            'description'=> 'Ver reportes del día del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver reportes por fecha',
            'slug'=> 'reports.date',
            'description'=> 'Ver reportes por fecha del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver resultados de reportes',
            'slug'=> 'reports.results',
            'description'=> 'Ver resultados de reportes del sistema'
        ]);

        // Usuarios
        Permission::create([
            'name'=> 'Navegar usuarios',
            'slug'=> 'users.index',
            'description'=> 'Lista y navega por todos los usuarios del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de los usuarios',
            'slug'=> 'users.show',
            'description'=> 'Ver en detalle cada usuario del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de usuarios',
            'slug'=> 'users.edit',
            'description'=> 'Editar cualquier dato de un usuario del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de usuarios',
            'slug'=> 'users.create',
            'description'=> 'Crea cualquier dato de un usuario del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar usuarios',
            'slug'=> 'users.destroy',
            'description'=> 'Eliminar cualquier dato de un usuario del sistema'
        ]);

        // Roles
        Permission::create([
            'name'=> 'Navegar roles',
            'slug'=> 'roles.index',
            'description'=> 'Lista y navega por todos los roles del sistema'
        ]);
        Permission::create([
            'name'=> 'Ver detalles de los roles',
            'slug'=> 'roles.show',
            'description'=> 'Ver en detalle cada rol del sistema'
        ]);
        Permission::create([
            'name'=> 'Edición de roles',
            'slug'=> 'roles.edit',
            'description'=> 'Editar cualquier dato de un rol del sistema'
        ]);
        Permission::create([
            'name'=> 'Creación de roles',
            'slug'=> 'roles.create',
            'description'=> 'Crea cualquier dato de un rol del sistema'
        ]);
        Permission::create([
            'name'=> 'Eliminar roles',
            'slug'=> 'roles.destroy',
            'description'=> 'Eliminar cualquier dato de un rol del sistema'
        ]);
    }
}
