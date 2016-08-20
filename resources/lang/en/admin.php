<?php

return [

    /*
    |--------------------------------------------------------------------------
    | APP
    |--------------------------------------------------------------------------
    */
    'app' => [
        'name' => 'Brain',
    ],

    /*
    |--------------------------------------------------------------------------
    | ACTIONS
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'add'    => 'Add',
        'open'   => 'Open',
        'show'   => 'Show',
        'create' => 'Create',
        'edit'   => 'Edit',
        'update' => 'Update',
        'delete' => 'Delete',
        'save'   => 'Save',
        'close'  => 'Close',
        'back'   => 'Back',
        'search' => 'Search',
    ],

    /*
    |--------------------------------------------------------------------------
    | COMMON
    |--------------------------------------------------------------------------
    */
    'common' => [
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'created_by' => 'Created by',
        'updated_by' => 'Updated by',
        'deleted_by' => 'Delete by',
        'author'     => 'Author',
        'editor'     => 'Editor',
        'total'      => 'Total',
        'messages'   => [
            'title' => [
                'info'    => 'Info',
                'error'   => 'Oops...',
                'warning' => 'Warning!',
                'success' => 'Good job!',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | DIALOG
    |--------------------------------------------------------------------------
    */
    'dialog' => [
        'confirm' => [
            'title' => 'Confirm',
            'text'  => 'Are you sure you want to proceed ?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'login' => [
            'title'    => 'Please sign in',
            'email'    => 'Email address',
            'password' => 'Password',
            'remember' => 'Remember me',
            'forgot'   => 'Forgot your password ?',
            'signin'   => 'Sign in',
        ],
        'logout' => [
            'button' => 'Logout',
        ],
        'forgot' => [
            'title' => 'Forgot Password ?',
            'email' => 'Email address',
            'login' => 'Back to login',
            'send'  => 'Send Reset Link',
        ],
        'reset' => [
            'title'                 => 'Reset Password',
            'email'                 => 'Email address',
            'password'              => 'Password',
            'password_confirmation' => 'Confirm Password',
            'login'                 => 'Back to login',
            'reset'                 => 'Reset Password',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */
    'home' => [
        'title' => 'Home',
    ],

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */
    'pages' => [
        'title'        => 'Pages',
        'sing'         => 'page',
        'plur'         => 'pages',
        'choice'       => 'page|pages',
        'empty'        => 'No pages',
        'default_tpl'  => '-- Default --',
        'default_form' => '-- None --',

        'status' => [
            App\Models\Page::STATUS_DRAFT     => 'Draft',
            App\Models\Page::STATUS_HIDDEN    => 'Hidden',
            App\Models\Page::STATUS_PUBLISHED => 'Published',
        ],

        'tabs' => [
            'info'     => 'Info',
            'contents' => 'Contents',
        ],

        'fields' => [
            'title'           => 'Title',
            'slug'            => 'Slug',
            'status'          => 'Status',
            'primary_image'   => 'Primary Image',
            'secondary_image' => 'Secondary Image',
            'gallery'         => 'Gallery',
            'content'         => 'Content',
            'excerpt'         => 'Excerpt',
            'custom_excerpt'  => 'Custom Excerpt',
            'publish_start'   => 'Publish Start',
            'publish_end'     => 'Publish End',
            'template'        => 'Template',
            'form_id'         => 'Form',
        ],

        'message' => [
            'create_success' => 'Page created successfully.',
            'update_success' => 'Page updated successfully.',
            'delete_success' => 'Page deleted successfully.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | MENU
    |--------------------------------------------------------------------------
    */
    'menus' => [
        'title'        => 'Menu',
        'sing'         => 'menu',
        'plur'         => 'menus',
        'choice'       => 'menu|menus',
        'empty'        => 'No menus',

        'tabs' => [
            'info'  => 'Info',
            'items' => 'Items',
        ],

        'fields' => [
            'enabled'     => 'Enabled',
            'name'        => 'Name',
            'title'       => 'Title',
            'description' => 'Description',
        ],

        'message' => [
            'create_success' => 'Menu created successfully.',
            'update_success' => 'Menu updated successfully.',
            'delete_success' => 'Menu deleted successfully.',
        ],
    ],

    'menus_items' => [
        'title'   => 'Menu Items',
        'sing'    => 'item',
        'plur'    => 'items',
        'choice'  => 'item|items',
        'empty'   => 'No items added',

        'types' => [
            App\Models\MenuItem::TYPE_LINK => 'Link',
            App\Models\MenuItem::TYPE_PAGE => 'Page',
        ],

        'fields' => [
            'type'         => 'Type',
            'label'        => 'Label',
            'value'        => 'Value',
            'page_id'      => 'Page',
            'sublevels'    => 'Sublevels',
            'visible_from' => 'Visible from',
            'visible_to'   => 'Visible to',
        ],

        'message' => [
            'create_success' => 'Field created successfully.',
            'update_success' => 'Field updated successfully.',
            'delete_success' => 'Field deleted successfully.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | FORMS
    |--------------------------------------------------------------------------
    */
    'forms' => [
        'title'   => 'Forms',
        'sing'    => 'form',
        'plur'    => 'forms',
        'choice'  => 'form|forms',
        'empty'   => 'No forms created',

        'types' => [
            App\Models\Form::TYPE_PAGE    => 'Page',
            App\Models\Form::TYPE_CONTACT => 'Contact',
        ],

        'tabs' => [
            'info'   => 'Info',
            'fields' => 'Fields',
        ],

        'fields' => [
            'enabled'     => 'Enabled',
            'type'        => 'Type',
            'name'        => 'Name',
            'title'       => 'Title',
            'description' => 'Description',
        ],

        'message' => [
            'create_success' => 'Form created successfully.',
            'update_success' => 'Form updated successfully.',
            'delete_success' => 'Form deleted successfully.',
        ],
    ],

    'forms_fields' => [
        'title'   => 'Form Fields',
        'sing'    => 'field',
        'plur'    => 'fields',
        'choice'  => 'field|fields',
        'empty'   => 'No fields added',

        'types' => [
            App\Models\FormField::TYPE_DATE     => 'Date',
            App\Models\FormField::TYPE_TEXT     => 'Text',
            App\Models\FormField::TYPE_SELECT   => 'Select',
            App\Models\FormField::TYPE_HIDDEN   => 'Hidden',
            App\Models\FormField::TYPE_RADIO    => 'Radio',
            App\Models\FormField::TYPE_CHECKBOX => 'Checkbox',
            App\Models\FormField::TYPE_TEXTAREA => 'Textarea',
        ],

        'tabs' => [
            'info'    => 'Info',
            'rules'   => 'Validation rules',
            'options' => 'List options',
        ],

        'fields' => [
            'type'        => 'Type',
            'name'        => 'Name',
            'label'       => 'Label',
            'value'       => 'Value',
            'description' => 'Description',
            'options'     => 'Options',
            'rules'       => 'Rules',
        ],

        'message' => [
            'create_success' => 'Field created successfully.',
            'update_success' => 'Field updated successfully.',
            'delete_success' => 'Field deleted successfully.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | THEMES
    |--------------------------------------------------------------------------
    */
    'themes' => [
        'title'   => 'Themes',
        'sing'    => 'theme',
        'plur'    => 'themes',
        'choice'  => 'theme|themes',
        'current' => 'Current',
        'enable'  => 'Use this',

        'message' => [
            'enable_success' => 'Theme enabled successfully.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'title' => 'Settings',

        // General section
        // -------------------------------------------
        'general' => [
            'title'   => 'General',
            'scripts' => 'Scripts',

            'fields' => [
                'timezone'        => 'Timezone',
                'home_title'      => 'Homepage title',
                'website_title'   => 'Website title',
                'website_footer'  => 'Website footer',
                'website_styles'  => 'Website styles',
                'website_scripts' => 'Website scripts',
            ],
        ],

        // Users section
        // -------------------------------------------
        'users' => [
            'title'  => 'Users',
            'sing'   => 'user',
            'plur'   => 'users',
            'choice' => 'user|users',
            'empty'  => 'No users',

            'fields' => [
                'name'     => 'Name',
                'email'    => 'Email',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password',
            ],

            'message' => [
                'create_success' => 'User created successfully.',
                'update_success' => 'User updated successfully.',
                'delete_success' => 'User deleted successfully.',
            ],
        ],

        // Not found section
        // -------------------------------------------
        'notfound' => [
            'title' => 'Page not found',

            'fields' => [
                'title'   => 'Title',
                'content' => 'Content',
            ],
        ],

        // Maintenance section
        // -------------------------------------------
        'maintenance' => [
            'title' => 'Maintenance',

            'status' => [
                'online'  => 'Online',
                'offline' => 'Offline',
            ],

            'fields' => [
                'title'   => 'Title',
                'status'  => 'Status',
                'content' => 'Content',
            ],
        ],

        'message' => [
            'saved_success' => 'Settings saved successfully.',
        ],
    ],

];
