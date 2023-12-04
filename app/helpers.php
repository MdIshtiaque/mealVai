<?php

use App\Models\MealSystem;
use App\Models\VerificationCode;

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

function generateUniqueVerificationCode($length = 6): int
{
    do {
        $verificationCode = mt_rand(pow(10, $length - 1), pow(10, $length) - 1);
    } while (VerificationCode::where('code', $verificationCode)->exists());

    return $verificationCode;
}

