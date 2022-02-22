<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'https://eservices.fg2020.com/#/portal/new-students',
        'https://eservices.fg2020.com/*',
        'http://eservices.fg2020.com/*'
    ];
}
