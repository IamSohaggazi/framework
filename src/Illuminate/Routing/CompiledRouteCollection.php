<?php

namespace Illuminate\Routing;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Matcher\CompiledUrlMatcher;
use Symfony\Component\Routing\RequestContext;

class CompiledRouteCollection
{
    /**
     * An array of the routes.
     *
     * @var array
     */
    private $routes;

    /**
     * Create a new CompiledRouteCollection instance.
     *
     * @param  array  $routes
     * @return void
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Find the first route matching a given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Route
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function match(Request $request)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new CompiledUrlMatcher($this->routes, $context);

        $attributes = $matcher->matchRequest($request);

        return $attributes;

        throw new NotFoundHttpException;
    }
}
