<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Lab;

interface IdentityMapInterface
{
    public function set($id, $object): void;

    public function getId($object);

    public function hasId($id): bool;

    public function hasObject($object): bool;

    public function getObject($id): object;
}

