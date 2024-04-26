<?php

namespace Motor\Mvc\Interfaces;

interface SessionInterface
{
    /**
     * @param string $key
     * @return mixed
     */
    public function give(string $key);

    /**
     * @param array $params
     * @return SessionInterface
     */
    public function add(array $params): self;

    public function remove(array $params): void;

    public function clear(): void;

    public function has(string $key): bool;
}
