<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Lab;

/**
 * Experimental repository bridge. Keep consumers on Common until this has tests.
 */
class Repository extends \XoopsPersistableObjectHandler implements RepositoryInterface
{
    private IdentityMap $identityMap;

    public function load($entity)
    {
        $entity = ucfirst((string)$entity) . 'Mapper';

        if ($this->identityMap->hasId($entity)) {
            return $this->identityMap->getObject($entity);
        }

        $this->identityMap->set($entity, new $entity($this->db));

        return $this->identityMap->getObject($entity);
    }
}

