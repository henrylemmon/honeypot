<?php

namespace App\Honeypot;

use Illuminate\Http\Request;

class Honeypot
{
    protected $request;

    protected $config;

    /**
     * Honeypot constructor.
     * @param $request
     * @param $config
     */
    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    public function enabled(): bool
    {
        return $this->config['enabled'];
    }

    public function detect()
    {
        if (! $this->enabled()) {
            return false;
        }

        if (! $this->request->has($this->config['name_field'])) {
            return true;
        }

        if (! empty($this->request->input($this->config['name_field']))) {
            return true;
        }

        if ($this->submittedTooQuickly() <= $this->config['min_time']) {
            return true;
        }
        return false;
    }

    protected function submittedTooQuickly()
    {
        return microtime(true) - $this->request->input($this->config['time_field']);
    }
}
