<?php

/**
 *
 * This file is part of AutoRoute for PHP.
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 */
declare(strict_types=1);

namespace AutoRoute;

class Action
{
    public function __construct(
        protected string $class,
        protected array $requiredParameters,
        protected array $optionalParameters,
    ) {
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getRequiredParameters(int $offset = 0): array
    {
        return array_slice($this->requiredParameters, $offset, null, true);
    }

    public function getOptionalParameters(): array
    {
        return $this->optionalParameters;
    }
}
