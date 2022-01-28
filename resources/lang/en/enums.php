<?php

use App\Enums\UserRole;

return [
    UserRole::class => [
        UserRole::USER => 'User',
        UserRole::ADMIN => 'Admin',
        UserRole::INACTIVE => 'Inactive',
    ],
];