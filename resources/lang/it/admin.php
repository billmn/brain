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
        'add'    => 'Aggiungi',
        'open'   => 'Apri',
        'show'   => 'Mostra',
        'create' => 'Crea',
        'edit'   => 'Modifica',
        'update' => 'Aggiorna',
        'delete' => 'Elimina',
        'save'   => 'Salva',
        'close'  => 'Chiudi',
        'back'   => 'Indietro',
        'search' => 'Cerca',
    ],

    /*
    |--------------------------------------------------------------------------
    | COMMON
    |--------------------------------------------------------------------------
    */
    'common' => [
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
        'created_by' => 'Creato da',
        'updated_by' => 'Aggiornato da',
        'deleted_by' => 'Eliminato da',
        'author'     => 'Autore',
        'editor'     => 'Editore',
        'total'      => 'Totale',
        'messages'   => [
            'title' => [
                'info'    => 'Info',
                'error'   => 'Oops...',
                'warning' => 'Attenzione!',
                'success' => 'Ben fatto!',
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
            'title' => 'Conferma',
            'text'  => 'Sei sicuro di voler procedere ?',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'login' => [
            'title'    => "Esegui l'accesso",
            'email'    => 'Email',
            'password' => 'Password',
            'remember' => 'Ricordami',
            'forgot'   => 'Password dimenticata ?',
            'signin'   => 'Accedi',
        ],
        'logout' => [
            'button' => 'Esci',
        ],
        'forgot' => [
            'title' => 'Password dimenticata ?',
            'email' => 'Email',
            'login' => 'Torna al login',
            'send'  => 'Invia il link di Reset',
        ],
        'reset' => [
            'title'                 => 'Reset Password',
            'email'                 => 'Email',
            'password'              => 'Password',
            'password_confirmation' => 'Conferma Password',
            'login'                 => 'Torna al login',
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
    | HOME
    |--------------------------------------------------------------------------
    */
    'files' => [
        'title' => 'Files',
    ],

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */
    'pages' => [
        'title'         => 'Pagine',
        'sing'          => 'pagina',
        'plur'          => 'pagine',
        'choice'        => 'pagina|pagine',
        'empty'         => 'Nessuna pagina',
        'default_tpl'   => '-- Default --',
        'default_form'  => '-- Nessuna --',
        'latest_edited' => 'Ultime pagine modificate',

        'status' => [
            App\Models\Page::STATUS_DRAFT     => 'Bozza',
            App\Models\Page::STATUS_HIDDEN    => 'Nascosta',
            App\Models\Page::STATUS_PUBLISHED => 'Pubblicata',
        ],

        'tabs' => [
            'info'     => 'Info',
            'contents' => 'Contenuti',
        ],

        'fields' => [
            'title'           => 'Titolo',
            'slug'            => 'Slug',
            'status'          => 'Stato',
            'primary_image'   => 'Immagine principale',
            'secondary_image' => 'Immagine secondaria',
            'gallery'         => 'Gallery',
            'content'         => 'Contenuto',
            'excerpt'         => 'Contenuto alternativo',
            'custom_excerpt'  => 'Usa contenuto alternativo',
            'publish_start'   => 'Inizio pubblicazione',
            'publish_end'     => 'Fine pubblicazione',
            'template'        => 'Template',
            'form_id'         => 'Form',
        ],

        'message' => [
            'create_success' => 'Pagina creata con successo.',
            'update_success' => 'Pagina modificata con successo.',
            'delete_success' => 'Pagina eliminata con successo.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | MENU
    |--------------------------------------------------------------------------
    */
    'menus' => [
        'title'            => 'Menu',
        'sing'             => 'menu',
        'plur'             => 'menus',
        'choice'           => 'menu|menu',
        'empty'            => 'Nessun menu',
        'default_position' => '-- Nessuna --',

        'tabs' => [
            'info'      => 'Info',
            'items'     => 'Elementi',
            'lists'     => 'Elenco',
            'positions' => 'Posizioni',
        ],

        'fields' => [
            'enabled'     => 'Abilitato',
            'name'        => 'Nome',
            'title'       => 'Titolo',
            'description' => 'Descrizione',
        ],

        'message' => [
            'create_success'   => 'Menu creato con successo.',
            'update_success'   => 'Menu modificato con successo.',
            'delete_success'   => 'Menu eliminato con successo.',
            'position_success' => 'Positioni salvate con successo.',
        ],
    ],

    'menus_items' => [
        'title'   => 'Elementi del menu',
        'sing'    => 'elemento',
        'plur'    => 'elementi',
        'choice'  => 'elemento|elementi',
        'empty'   => 'Nessun elemento',

        'types' => [
            App\Models\MenuItem::TYPE_LINK => 'Link',
            App\Models\MenuItem::TYPE_PAGE => 'Pagina',
        ],

        'fields' => [
            'type'         => 'Tipo',
            'label'        => 'Etichetta',
            'value'        => 'Valore',
            'page_id'      => 'Pagina',
            'sublevels'    => 'Sottolivelli',
            'visible_from' => 'Visibile dal',
            'visible_to'   => 'Visible al',
        ],

        'message' => [
            'create_success' => 'Elemento creato con successo.',
            'update_success' => 'Elemento modificato con successo.',
            'delete_success' => 'Elemento eliminato con successo.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | MESSAGES
    |--------------------------------------------------------------------------
    */
    'messages' => [
        'title'  => 'Messaggi',
        'sing'   => 'messaggio',
        'plur'   => 'messaggi',
        'choice' => 'messaggio|messaggi',
        'empty'  => 'Nessun messaggio ricevuto',
        'latest' => 'Ultimi messaggi ricevuti',

        'fields' => [
            'form_id'    => 'ID Form',
            'form_name'  => 'Nome Form',
            'email'      => 'Email',
            'fields'     => 'Campi',
            'created_at' => 'Ricevuto alle',
        ],

        'message' => [
            'create_success' => 'Messaggio creato con successo.',
            'update_success' => 'Messaggio modificato con successo.',
            'delete_success' => 'Messaggio eliminato con successo.',
        ],

        'email' => [
            'owner' => [
                'subject' => 'Messaggio ricevuto dal sito web',
                'intro_1' => 'Un messaggio è stato inviato da :sender sul sito web dal modulo Contatti ":form_name", i dettagli completi dei campi sono:',
            ],
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
        'empty'   => 'Nessuna form',

        'types' => [
            App\Models\Form::TYPE_PAGE    => 'Pagina',
            App\Models\Form::TYPE_CONTACT => 'Contatti',
        ],

        'tabs' => [
            'info'          => 'Info',
            'fields'        => 'Campi',
            'notifications' => 'Notifiche',
        ],

        'descriptions' => [
            'success_message' => "Mostra un messaggio all'utente dopo aver compilato il modulo con successo.",
            'success_email'   => "Invia una mail all'utente dopo aver compilato il modulo con successo.",
        ],

        'fields' => [
            'enabled'               => 'Abilitato',
            'type'                  => 'Tipo',
            'name'                  => 'Nome',
            'title'                 => 'TItolo',
            'description'           => 'Descrizione',
            'success_message'       => 'Messaggio di successo',
            'success_email'         => 'Email di successo',
            'success_email_sender'  => 'Nome del mittente',
            'success_email_subject' => 'Oggetto',
            'success_email_content' => 'Contenuto',
            'success_email_footer'  => 'Firma',
        ],

        'message' => [
            'create_success' => 'Form creata con successo.',
            'update_success' => 'Form modificata con successo.',
            'delete_success' => 'Form eliminata con successo.',
        ],
    ],

    'forms_fields' => [
        'title'   => 'Campi del Form',
        'sing'    => 'campo',
        'plur'    => 'campi',
        'choice'  => 'campo|campi',
        'empty'   => 'No fields',

        'types' => [
            App\Models\FormField::TYPE_DATE     => 'Data',
            App\Models\FormField::TYPE_TEXT     => 'Testo',
            App\Models\FormField::TYPE_EMAIL    => 'Email',
            App\Models\FormField::TYPE_SELECT   => 'Select',
            App\Models\FormField::TYPE_HIDDEN   => 'Nascosto',
            App\Models\FormField::TYPE_RADIO    => 'Radio',
            App\Models\FormField::TYPE_CHECKBOX => 'Checkbox',
            App\Models\FormField::TYPE_TEXTAREA => 'Textarea',
        ],

        'tabs' => [
            'info'    => 'Info',
            'rules'   => 'Regole di validazione',
            'options' => 'Elenco opzioni',
        ],

        'fields' => [
            'type'        => 'Tipo',
            'name'        => 'Nome',
            'label'       => 'Etichetta',
            'value'       => 'Valore',
            'description' => 'Descrizione',
            'options'     => 'Opzioni',
            'rules'       => 'Regole',
        ],

        'message' => [
            'create_success' => 'Campo creato con successo.',
            'update_success' => 'Campo modificato con successo.',
            'delete_success' => 'Campo eliminato con successo.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | LABELS
    |--------------------------------------------------------------------------
    */
    'labels' => [
        'title'  => 'Etichette',
        'sing'   => 'etichetta',
        'plur'   => 'etichette',
        'choice' => 'etichetta|etichette',
        'empty'  => 'Nessuna etichetta in questo tema',

        'fields' => [
            'name'  => 'Nome',
            'code'  => 'Codice',
            'value' => 'Valore',
        ],

        'message' => [
            'save_success' => 'Etichetta salvata con successo.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | THEMES
    |--------------------------------------------------------------------------
    */
    'themes' => [
        'title'   => 'Temi',
        'sing'    => 'tema',
        'plur'    => 'temi',
        'choice'  => 'tema|temi',
        'current' => 'Attuale',
        'enable'  => 'Usa questo',

        'message' => [
            'enable_success' => 'Tema abilitato con successo.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */
    'settings' => [
        'title' => 'Impostazioni',

        // General section
        // -------------------------------------------
        'general' => [
            'title'   => 'Generali',
            'scripts' => 'Scripts',

            'fields' => [
                'home_title'      => 'Titolo Homepage',
                'website_title'   => 'Titolo Sito Web',
                'website_footer'  => 'Footer Sito Web',
                'website_styles'  => 'Stili Sito Web',
                'website_scripts' => 'Scripts Sito Web',
            ],
        ],

        // Users section
        // -------------------------------------------
        'users' => [
            'title'  => 'Utenti',
            'sing'   => 'utente',
            'plur'   => 'utenti',
            'choice' => 'utente|utenti',
            'empty'  => 'Nessun utente',

            'fields' => [
                'name'     => 'Nome',
                'email'    => 'Email',
                'password' => 'Password',
                'password_confirmation' => 'Conferma Password',
            ],

            'message' => [
                'create_success' => 'Utente creato con successo.',
                'update_success' => 'Utente modificato con successo.',
                'delete_success' => 'Utente eliminato con successo.',
            ],
        ],

        // Not found section
        // -------------------------------------------
        'notfound' => [
            'title' => 'Pagina non trovata',

            'fields' => [
                'title'   => 'Titolo',
                'content' => 'Contenuto',
            ],
        ],

        // Maintenance section
        // -------------------------------------------
        'maintenance' => [
            'title' => 'Manutenzione',

            'status' => [
                'online'  => 'Online',
                'offline' => 'Offline',
            ],

            'fields' => [
                'title'   => 'Titolo',
                'status'  => 'Stato',
                'content' => 'Contenuto',
            ],
        ],

        'message' => [
            'saved_success' => 'Impostazioni salvate con successo.',
        ],
    ],

];
