<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Honeypot
{
    public function handle(Request $request, Closure $next)
    {
        $config = config('honeypot');

        if (! $config['enabled']) {
            return $next($request);
        }

        if (! $request->has($config['name_field'])) {
            $this->abort();
        }

        if (! empty($request->input($config['name_field']))) {
            $this->abort();
        }

        if ($this->timeToSubmitForm($request, $config) <= $config['min_time']) {
            $this->abort();
        }

        return $next($request);
    }

    protected function timeToSubmitForm(Request $request, array $config)
    {
        return microtime(true) - $request->input($config['time_field']);
    }

    public function abort()
    {
        abort(422, 'Spam Detected.');
    }
}
