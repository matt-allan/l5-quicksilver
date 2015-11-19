<?php

namespace App\Foundation;

use ArrayAccess;
use Illuminate\Bus\MarshalException;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionParameter;

/**
 * Marshals a command/application request from an array accessible object.
 * This was ripped straight out of the illuminate/bus package.
 * The only change I made is checking for the snake_case
 * version of a parameter name before failing.
 */
trait MarshalsRequests
{
    /**
     * Marshal a command from the given array.
     *
     * @param  string $command
     * @param  array  $array
     * @return mixed
     */
    protected function marshalFromArray($command, array $array)
    {
        return $this->marshal($command, new Collection, $array);
    }

    /**
     * Marshal a command from the given array accessible object.
     *
     * @param  string       $command
     * @param  \ArrayAccess $source
     * @param  array        $extras
     * @return mixed
     */
    protected function marshal($command, ArrayAccess $source, array $extras = [])
    {
        $injected   = [];
        $reflection = new ReflectionClass($command);
        if ($constructor = $reflection->getConstructor()) {
            $injected = array_map(function ($parameter) use ($command, $source, $extras) {
                return $this->getParameterValueForCommand($command, $source, $parameter, $extras);
            }, $constructor->getParameters());
        }

        return $reflection->newInstanceArgs($injected);
    }

    /**
     * Get a parameter value for a marshaled command.
     *
     * @param  string               $command
     * @param  \ArrayAccess         $source
     * @param  \ReflectionParameter $parameter
     * @param  array                $extras
     * @return mixed
     */
    protected function getParameterValueForCommand($command, ArrayAccess $source, ReflectionParameter $parameter, array $extras = [])
    {
        if (array_key_exists($parameter->name, $extras)) {
            return $extras[$parameter->name];
        }
        if (isset($source[$parameter->name])) {
            return $source[$parameter->name];
        }
        if (isset($source[snake_case($parameter->name)])) {
            return $source[snake_case($parameter->name)];
        }
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        MarshalException::whileMapping($command, $parameter);
    }
}