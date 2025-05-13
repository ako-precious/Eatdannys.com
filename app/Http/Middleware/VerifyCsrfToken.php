<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class VerifyCsrfToken extends Middleware
{
    // app/Http/Middleware/VerifyCsrfToken.php
protected $except = [
    'stripe/webhook',
];}