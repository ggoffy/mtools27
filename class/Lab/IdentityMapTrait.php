<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Lab;

trait IdentityMapTrait
{
    protected \ArrayObject $idToObject;
    protected \SplObjectStorage $objectToId;

    public function initializeIdentityMap(): void
    {
        $this->objectToId = new \SplObjectStorage();
        $this->idToObject = new \ArrayObject();
    }

    public function set($id, $object): void
    {
        $this->idToObject[$id]     = $object;
        $this->objectToId[$object] = $id;
    }

    public function getId($object)
    {
        if (!$this->hasObject($object)) {
            throw new \OutOfBoundsException();
        }

        return $this->objectToId[$object];
    }

    public function hasId($id): bool
    {
        return isset($this->idToObject[$id]);
    }

    public function hasObject($object): bool
    {
        return isset($this->objectToId[$object]);
    }

    public function getObject($id): object
    {
        if (!$this->hasId($id)) {
            throw new \OutOfBoundsException();
        }

        return $this->idToObject[$id];
    }
}

