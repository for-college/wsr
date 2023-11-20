<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiUserHasRole
{
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next, string $role): Response
  {
//    echo $request;
    if (!$request->user()->hasRole(explode('|', $role))) {
      throw new ApiException(403, 'Access Denied');
    }

    return $next($request);
  }
}
