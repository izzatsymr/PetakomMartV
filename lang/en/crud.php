<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'all_cash' => [
        'name' => 'All Cash',
        'index_title' => 'AllCash List',
        'new_title' => 'New Cash',
        'create_title' => 'Create Cash',
        'edit_title' => 'Edit Cash',
        'show_title' => 'Show Cash',
        'inputs' => [
            'user_id' => 'User',
            'opening_cash' => 'Opening Cash',
            'closing_cash' => 'Closing Cash',
            'short_cash' => 'Short Cash',
        ],
    ],

    'inventories' => [
        'name' => 'Inventories',
        'index_title' => 'Inventories List',
        'new_title' => 'New Inventory',
        'create_title' => 'Create Inventory',
        'edit_title' => 'Edit Inventory',
        'show_title' => 'Show Inventory',
        'inputs' => [
            'product_id' => 'Product',
            'stock_quantity' => 'Stock Quantity',
        ],
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'payment_methods' => [
        'name' => 'Payment Methods',
        'index_title' => 'PaymentMethods List',
        'new_title' => 'New Payment method',
        'create_title' => 'Create PaymentMethod',
        'edit_title' => 'Edit PaymentMethod',
        'show_title' => 'Show PaymentMethod',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'products' => [
        'name' => 'Products',
        'index_title' => 'Products List',
        'new_title' => 'New Product',
        'create_title' => 'Create Product',
        'edit_title' => 'Edit Product',
        'show_title' => 'Show Product',
        'inputs' => [
            'category_id' => 'Category',
            'image' => 'Image',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
        ],
    ],

    'sales' => [
        'name' => 'Sales',
        'index_title' => 'Sales List',
        'new_title' => 'New Sale',
        'create_title' => 'Create Sale',
        'edit_title' => 'Edit Sale',
        'show_title' => 'Show Sale',
        'inputs' => [
            'user_id' => 'User',
            'payment_method_id' => 'Payment Method',
            'subtotal_sales' => 'Subtotal Sales',
            'service_tax' => 'Service Tax',
            'total_sales' => 'Total Sales',
            'status' => 'Status',
            'refunded_reason' => 'Refunded Reason',
        ],
    ],

    'schedules' => [
        'name' => 'Schedules',
        'index_title' => 'Schedules List',
        'new_title' => 'New Schedule',
        'create_title' => 'Create Schedule',
        'edit_title' => 'Edit Schedule',
        'show_title' => 'Show Schedule',
        'inputs' => [
            'user_id' => 'User',
            'date' => 'Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'matric_no' => 'Matric No',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
