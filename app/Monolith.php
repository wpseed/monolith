<?php

namespace App;

use App\Events\ServingMonolith;
use BadMethodCallException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class Monolith
{
    /**
     * All of the registered Monolith tool scripts.
     *
     * @var array
     */
    public static $scripts = [];

    /**
     * All of the registered Monolith tool CSS.
     *
     * @var array
     */
    public static $styles = [];

    /**
     * The theme CSS files applied to Monolith.
     *
     * @var array
     */
    public static $themes = [];

    /**
     * The callback used to report Monolith's exceptions.
     *
     * @var \Closure
     */
    public static $reportCallback;

    /**
     * Register an event listener for the Monolith "serving" event.
     *
     * @param  \Closure|string  $callback
     * @return void
     */
    public static function serving($callback)
    {
        Event::listen(ServingMonolith::class, $callback);
    }

    /**
     * Get all of the additional scripts that should be registered.
     *
     * @return array
     */
    public static function allScripts()
    {
        return static::$scripts;
    }

    /**
     * Get all of the available scripts that should be registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function availableScripts(Request $request)
    {
        return static::$scripts;
    }

    /**
     * Get all of the additional stylesheets that should be registered.
     *
     * @return array
     */
    public static function allStyles()
    {
        return static::$styles;
    }

    /**
     * Get all of the available stylesheets that should be registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function availableStyles(Request $request)
    {
        return static::$styles;
    }

    /**
     * Get all of the theme stylesheets that should be registered.
     *
     * @return array
     */
    public static function themeStyles()
    {
        return static::$themes;
    }

    /**
     * Register the given script file with Monolith.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function script($name, $path)
    {
        static::$scripts[$name] = $path;

        return new static;
    }

    /**
     * Register the given remote script file with Monolith.
     *
     * @param  string  $path
     * @return static
     */
    public static function remoteScript($path)
    {
        return static::script(md5($path), $path);
    }

    /**
     * Register the given CSS file with Monolith.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function style($name, $path)
    {
        static::$styles[$name] = $path;

        return new static;
    }

    /**
     * Register the given remote CSS file with Monolith.
     *
     * @param  string  $path
     * @return static
     */
    public static function remoteStyle($path)
    {
        return static::style(md5($path), $path);
    }

    /**
     * Register the given theme CSS file with Monolith.
     *
     * @param string $publicPath
     * @return static
     */
    public static function theme($publicPath)
    {
        static::$themes[] = $publicPath;
    }

    /**
     * Dynamically proxy static method calls.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return void
     */
    public static function __callStatic($method, $parameters)
    {
        if (! property_exists(get_called_class(), $method)) {
            throw new BadMethodCallException("Method {$method} does not exist.");
        }

        return static::${$method};
    }
}
