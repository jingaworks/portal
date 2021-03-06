<?php

return [
    'userManagement'     => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'         => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'               => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'               => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => '',
            'name'                      => 'Name',
            'name_helper'               => '',
            'email'                     => 'Email',
            'email_helper'              => '',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => '',
            'password'                  => 'Password',
            'password_helper'           => '',
            'roles'                     => 'Roles',
            'roles_helper'              => '',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => '',
            'created_at'                => 'Created at',
            'created_at_helper'         => '',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => '',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => '',
            'approved'                  => 'Approved',
            'approved_helper'           => '',
            'verified'                  => 'Verified',
            'verified_helper'           => '',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => '',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => '',
        ],
    ],
    'profile'            => [
        'title'          => 'Profile',
        'title_singular' => 'Profile',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'phone'             => 'Phone',
            'phone_helper'      => '',
            'avatar'            => 'Avatar',
            'avatar_helper'     => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'created_by'        => 'Created By',
            'created_by_helper' => '',
            'place'             => 'Place',
            'place_helper'      => '',
            'region'            => 'Region',
            'region_helper'     => '',
        ],
    ],
    'certificate'        => [
        'title'          => 'Certificate',
        'title_singular' => 'Certificate',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'serie'                    => 'Serie',
            'serie_helper'             => '',
            'profile'                  => 'Phone',
            'profile_helper'           => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'created_by'               => 'Created By',
            'created_by_helper'        => '',
            'region'                   => 'Region',
            'region_helper'            => '',
            'place'                    => 'Place',
            'place_helper'             => '',
            'validation_images'        => 'Imagini de verificare',
            'validation_images_helper' => '',
        ],
    ],
    'region'             => [
        'title'          => 'Region',
        'title_singular' => 'Region',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'denj'              => 'Region',
            'denj_helper'       => '',
            'mnemonic'          => 'Mnemonic',
            'mnemonic_helper'   => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'place'              => [
        'title'          => 'Place',
        'title_singular' => 'Place',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'denloc'            => 'Denloc',
            'denloc_helper'     => '',
            'region'            => 'Region',
            'region_helper'     => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'category'           => [
        'title'          => 'Category',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
            'image'             => 'Image',
            'image_helper'      => '',
            'added_by'          => 'Added By',
            'added_by_helper'   => '',
        ],
    ],
    'subcategory'        => [
        'title'          => 'Subcategory',
        'title_singular' => 'Subcategory',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'image'             => 'Image',
            'image_helper'      => '',
            'category'          => 'Category',
            'category_helper'   => '',
            'profile'           => 'Phone',
            'profile_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'product'            => [
        'title'          => 'Product',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => '',
            'title'               => 'Title',
            'title_helper'        => '',
            'slug'                => 'Slug',
            'slug_helper'         => '',
            'details'             => 'Details',
            'details_helper'      => '',
            'category'            => 'Category',
            'category_helper'     => '',
            'subcategory'         => 'Subcategory',
            'subcategory_helper'  => '',
            'price_starts'        => 'Price Starts',
            'price_starts_helper' => '',
            'price_ends'          => 'Price Ends',
            'price_ends_helper'   => '',
            'images'              => 'Images',
            'images_helper'       => '',
            'region'              => 'Region',
            'region_helper'       => '',
            'place'               => 'Place',
            'place_helper'        => '',
            'profile'             => 'Phone',
            'profile_helper'      => '',
            'created_by'          => 'Created By',
            'created_by_helper'   => '',
            'created_at'          => 'Created at',
            'created_at_helper'   => '',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => '',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => '',
        ],
    ],
    'locationManagement' => [
        'title'          => 'Location Management',
        'title_singular' => 'Location Management',
    ],
    'productManagement'  => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'accountManagement'  => [
        'title'          => 'Account Management',
        'title_singular' => 'Account Management',
    ],
    'setting'            => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
];