<?php

namespace App\Http\Middleware;

use Closure;

class Pickadate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $newInput = [];

        $pickadateFields = array_where($request->all(), function ($value, $key) {
            return ends_with($key, '_pickadate');
        });

        foreach ($request->all() as $key => $value) {
            if (array_key_exists("{$key}_pickadate", $pickadateFields)) {
                $newInput[$key] = $pickadateFields["{$key}_pickadate"];
            } elseif (! ends_with($key, '_pickadate')) {
                $newInput[$key] = $value;
            }
        }

        $request->replace($newInput);

        return $next($request);
    }
}
