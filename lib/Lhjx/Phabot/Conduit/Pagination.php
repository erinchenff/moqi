<?php

namespace Phabeat\Conduit;

class Pagination
{
    private $client;
    private $endpoint;
    private $params;
    private $items;
    private $cursor;

    public function __construct(Client $client, $endpoint, array $params = [])
    {
        $this->client = $client;
        $this->endpoint = $endpoint;
        $this->params = $params;
    }

    public function getItems()
    {
        $this->load();

        return $this->items;
    }

    public function hasNext()
    {
        return null !== $this->cursor['after'];
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    private function load($force = false)
    {
        if (null === $this->items || $force) {
            $result = $this->client->request($this->endpoint, $this->params);

            $this->items = $result['data'];
            $this->cursor = $result['cursor'];
        }
    }
}
