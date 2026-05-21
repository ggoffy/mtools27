<?php declare(strict_types=1);

namespace XoopsModules\Mtools\Lab;

/**
 * Experimental data-mapper contract. Not part of the stable Common API.
 */
interface DataMapperInterface
{
    public function create();

    public function get($int_id);

    public function insert(\XoopsObject $object);

    public function delete(\XoopsObject $object);
}

