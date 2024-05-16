<?php

namespace App\Serializer;

use App\Enum\PriorityEnum;
use App\Enum\StatusEnum;
use App\Model\Task;
use Symfony\Component\Serializer\SerializerInterface;

class TaskSerializer
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function deserialize($fileContent)
    {
        return $this->serializer->deserialize($fileContent, 'App\Model\Task[]', 'json');
    }


}