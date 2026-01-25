<?php

namespace Mojahid\Ecommerce\Actions;

use MojarCMS\CMS\Abstracts\Action;
use MojarCMS\CMS\Facades\HookAction;
use Illuminate\Support\Facades\Log;
use MojarCMS\CMS\Models\Permission;
use MojarCMS\CMS\Models\Role;

class EcommercePermissonsAction extends Action
{   
    public function handle(): void
    {
        $this->registerInitActions();
    }

    private function registerInitActions(): void
    {
        $this->addAction(Action::INIT_ACTION, [$this, 'registerPermissions']);
        $this->addAction(Action::INIT_ACTION, [$this, 'registerRoles']);
        $this->addAction(
            Action::PERMISSION_INIT,
            [$this, 'addPermissions']
        );
    }

    public function addPermissions(): void
    {
        HookAction::registerResourcePermissions(
            'orders',
            trans('ecomm::content.orders')
        );

        HookAction::registerResourcePermissions(
            'vendor_balances',
            trans('ecomm::content.vendor_balances')
        );

        HookAction::registerResourcePermissions(
            'vendor_earnings',
            trans('ecomm::content.vendor_earnings')
        );

        HookAction::registerResourcePermissions(
            'vendor_withdrawals',
            trans('ecomm::content.vendor_withdrawals')
        );

        HookAction::registerResourcePermissions(
            'order_items',
            trans('ecomm::content.order_items')
        );
    }

    public function registerPermissions(): void
    {
        $this->registerPermissionGroups();
        // $this->createAdditionalPermissions();
        $this->registerCustomerPermissions();
    }

    private function registerPermissionGroups(): void
    {
        $groups = [
            'customer' => [
                'name' => 'customer',
                'description' => 'Customer Specific Permissions',
            ],
            'vendor' => [
                'name' => 'vendor',
                'description' => 'Vendor Specific Permissions',
            ],
        ];

        foreach ($groups as $key => $group) {
            HookAction::registerPermissionGroup($key, $group);
        }
    }

    private function createAdditionalPermissions(): void
    {
        $permissions = $this->getAdditionalPermissions();
        
        foreach ($permissions as $permission => $description) {
            Permission::firstOrCreate(
                ['name' => $permission],
                [
                    'description' => $description,
                    'guard_name' => 'web'
                ]
            );
        }
    }

    private function getAdditionalPermissions(): array
    {
        return [
            // Product taxonomies
            'taxonomy.product.categories.index' => 'View Product Categories',
            'taxonomy.product.categories.create' => 'Create Product Categories',
            'taxonomy.product.categories.edit' => 'Edit Product Categories',
            'taxonomy.product.categories.delete' => 'Delete Product Categories',
            'taxonomy.product.categories.view' => 'View Product Category Details',

            'taxonomy.product.tags.index' => 'View Product Tags',
            'taxonomy.product.tags.create' => 'Create Product Tags',
            'taxonomy.product.tags.edit' => 'Edit Product Tags',
            'taxonomy.product.tags.delete' => 'Delete Product Tags',

            'taxonomy.product.brands.index' => 'View Product Brands',
            'taxonomy.product.brands.create' => 'Create Product Brands',
            'taxonomy.product.brands.edit' => 'Edit Product Brands',
            'taxonomy.product.brands.delete' => 'Delete Product Brands',
            'taxonomy.product.brands.view' => 'View Product Brand Details',

            'taxonomy.product.vendors.index' => 'View Product Vendors',
            'taxonomy.product.vendors.create' => 'Create Product Vendors',
            'taxonomy.product.vendors.edit' => 'Edit Product Vendors',
            'taxonomy.product.vendors.delete' => 'Delete Product Vendors',
            'taxonomy.product.vendors.view' => 'View Product Vendor Details',

            // Comment management
            'post-type.product.comments.index' => 'View Product Comments',
            'post-type.product.comments.create' => 'Create Product Comments',
            'post-type.product.comments.edit' => 'Edit Product Comments',
            'post-type.product.comments.delete' => 'Delete Product Comments',
            'post-type.product.comments.view' => 'View Product Comment Details',
        ];
    }

    private function registerCustomerPermissions(): void
    {
        $permissions = $this->getCustomerPermissions();
        $this->registerAndCreatePermissions($permissions);
    }

    private function registerAndCreatePermissions(array $permissions): void
    {
        foreach ($permissions as $permission) {
            HookAction::registerPermission(
                $permission['name'],
                [
                    'name' => $permission['name'],
                    'group' => $permission['group'],
                    'description' => $permission['description'],
                ]
            );

            Permission::firstOrCreate(
                ['name' => $permission['name']],
                [
                    'description' => $permission['description'],
                    'guard_name' => 'web'
                ]
            );
        }
    }

    private function getCustomerPermissions(): array
    {
        return [
            [
                'name' => 'customer.my_orders', 
                'description' => 'View Own Orders',
                'group' => 'customer',
            ],
            [
                'name' => 'customer.my_cart',
                'description' => 'View Own Cart',
                'group' => 'customer',
            ],
            [
                'name' => 'customer.my_wishlist',
                'description' => 'View Own Wishlist',
                'group' => 'customer',
            ],
            [
                'name' => 'customer.my_downloads',
                'description' => 'View Own Downloads',
                'group' => 'customer',
            ],
            [
                'name' => 'customer.my_reviews',
                'description' => 'View Own Reviews',
                'group' => 'customer',
            ]
        ];
    }

    public function registerRoles(): void
    {
        $roles = $this->getRoleDefinitions();
        
        foreach ($roles as $key => $role) {
            $this->createRoleWithPermissions($key, $role);
        }
    }

    private function createRoleWithPermissions(string $key, array $role): void
    {
        if (Role::where('name', $key)->exists()) {
            return;
        }

        $newRole = Role::create([
            'name' => $key,
            'description' => $role['description'],
            'guard_name' => 'web'
        ]);

        $existingPermissions = Permission::whereIn('name', $role['permissions'])
            ->pluck('name')
            ->toArray();
            
        $newRole->syncPermissions($existingPermissions);
        
        $this->logMissingPermissions($key, $role['permissions'], $existingPermissions);
    }

    private function logMissingPermissions(string $roleKey, array $requestedPermissions, array $existingPermissions): void
    {
        $missingPermissions = array_diff($requestedPermissions, $existingPermissions);
        
        if (!empty($missingPermissions)) {
            Log::warning("Missing permissions for role {$roleKey}: " . implode(', ', $missingPermissions));
        }
    }

    private function getRoleDefinitions(): array
    {
        return [
            'customer' => [
                'name' => 'Customer',
                'description' => 'Ecommerce customer role with order and profile management',
                'permissions' => [
                    'customer.my_orders',
                    'customer.my_cart',
                    'customer.my_wishlist',
                    'customer.my_downloads',
                    'customer.my_reviews',
                ]
            ],
            'vendor' => [
                'name' => 'Vendor',
                'description' => 'Ecommerce vendor role with product and order management',
                'permissions' => [
                    // Product-specific permissions
                    'post-type.products.index',
                    'post-type.products.create',
                    'post-type.products.edit',
                    'post-type.products.delete',

                    'vendor_balances.index',
                    'vendor_balances.view',
                    'vendor_earnings.index',
                    'vendor_earnings.view',
                    'vendor_withdrawals.index',
                    'vendor_withdrawals.create',
                    'vendor_withdrawals.view',
                    'vendor_withdrawals.edit',

                    'order_items.index',
                    'order_items.view',
                    'order_items.edit',
                    'order_items.delete',

                    'ticket-supports.index',
                    'ticket-supports.create',
                    'ticket-supports.edit',
                    'ticket-supports.delete',

                    'customer.my_orders',
                    'customer.my_cart',
                    'customer.my_wishlist',
                    'customer.my_downloads',
                    'customer.my_reviews',
                ]
            ]
        ];
    }
}