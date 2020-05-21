<?php

namespace App\Serializers;

use League\Fractal\Serializer\ArraySerializer as BaseSerializer;

class ArraySerializer extends BaseSerializer
{
    /**
     * Serialize a collection.
     */
    public function collection($resourceKey, array $data)
    {
        return $resourceKey ? [$resourceKey => $data] : $data;
    }

    /**
     * Serialize an item.
     */
    public function item($resourceKey, array $data)
    {
        return $resourceKey ? [$resourceKey => $data] : $data;
    }
}
