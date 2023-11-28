<?php

use App\Models\MealSystem;

/**
 * @return int
 * For Unique Code Generation
 */
function generateUniqueCode(): int
{
    do {
        $code = mt_rand(1000, 9999); // Generate a 4-digit code
    } while (MealSystem::where('code', $code)->exists()); // Check if it exists in the DB

    return $code;
}

