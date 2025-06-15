<?php

return [
    'fields' => [
        'google_tag_manager_id' => [
            'label' => 'Google Tag Manager ID',
            'type' => 'text',
            'placeholder' => 'GTM-XXXXXXX',
            'required' => false,
        ],
        'site_name' => [
            'label' => 'Nom du site',
            'type' => 'text',
            'placeholder' => 'Mon super site',
            'required' => true,
        ],
        'site_address' => [
            'label' => 'Adresse du site',
            'type' => 'text',
            'placeholder' => '123 Rue Exemple, Cotonou',
            'required' => true,
        ],
        'site_email' => [
            'label' => 'Email du site',
            'type' => 'email',
            'placeholder' => 'contact@monsite.com',
            'required' => true,
        ],
        'site_www' => [
            'label' => 'Adresse Web (URL)',
            'type' => 'url',
            'placeholder' => 'https://www.monsite.com',
            'required' => true,
        ],
        'site_phone' => [
            'label' => 'Téléphone principal',
            'type' => 'tel',
            'placeholder' => '+33 6 12 34 56 78',
            'required' => true,
        ],
        'site_phone_2' => [
            'label' => 'Téléphone secondaire',
            'type' => 'tel',
            'placeholder' => '+33 7 98 76 54 32',
            'required' => false,
        ],
        'site_whatsapp' => [
            'label' => 'Numéro WhatsApp',
            'type' => 'tel',
            'placeholder' => '+33 1 23 45 67 89',
            'required' => false,
        ],
        'author_name' => [
            'label' => 'Nom de l’auteur',
            'type' => 'text',
            'placeholder' => 'John Doe',
            'required' => true,
        ],
        'author_email' => [
            'label' => 'Email de l’auteur',
            'type' => 'email',
            'placeholder' => 'auteur@exemple.com',
            'required' => true,
        ],
        'webmaster_name' => [
            'label' => 'Nom du Webmaster',
            'type' => 'text',
            'placeholder' => 'Cosimo Boni',
            'required' => true,
        ],
        'webmaster_email' => [
            'label' => 'Email du Webmaster',
            'type' => 'email',
            'placeholder' => 'webmaster@exemple.com',
            'required' => true,
        ],
        'site_primary_color' => [
            'label' => 'Couleur principale du site',
            'type' => 'text',
            'placeholder' => '#FF5733',
            'required' => false,
        ],
        'crisp_chat_widget_id' => [
            'label' => 'Crisp Chat Widget ID',
            'type' => 'text',
            'placeholder' => '9a1b2c3d-xxxx-yyyy-zzzz-123456abcdef',
            'required' => false,
        ],
        'created_date' => [
            'label' => 'Date de création',
            'type' => 'number',
            'placeholder' => '2017',
            'required' => true,
        ],
        'website_created_date' => [
            'label' => 'Date de mise en ligne',
            'type' => 'number',
            'placeholder' => '2020',
            'required' => true,
        ],
        'teag' => [
            'label' => 'Taux d\'intérêt',
            'type' => 'text',
            'placeholder' => '5.8%',
            'required' => false,
        ],
    ]
];
