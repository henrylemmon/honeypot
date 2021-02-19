<?php

namespace App\Honeypot;

use Closure;
use Illuminate\Http\Request;

class SpamBlocker
{
    protected Honeypot $honeypot;

    /**
     * Honeypot constructor.
     * @param $honeypot
     */
    public function __construct(Honeypot $honeypot)
    {
        $this->honeypot = $honeypot;
    }


    public function handle(Request $request, Closure $next)
    {
        if ($this->honeypot->detect()) {
            return $this->abort();
        }

        return $next($request);
    }

    public function abort()
    {
        abort(422, 'Spam Detected.');
    }
}
