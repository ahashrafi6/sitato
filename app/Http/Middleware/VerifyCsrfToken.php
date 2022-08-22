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
        '/tiny/upload',
        '/uppy/upload',
        '/uppy/upload/s3',
        'micro/products-from-tokens',
        'update-faqs',
    ];
}
