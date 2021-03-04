<?php

namespace Copper;

abstract class CopperResource
{
    /**
     * @var CopperClient
     */
    protected $client;

    /**
     * CopperResource constructor.
     *
     * @param CopperClient $client
     */
    public function __construct(CopperClient $client)
    {
        $this->client = $client;
    }
}
