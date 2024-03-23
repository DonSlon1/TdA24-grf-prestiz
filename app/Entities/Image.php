<?php

namespace App\Entities;
use Core\Entities\Entities;
use Doctrine\ORM\Mapping\{Column, CustomIdGenerator, Entity, GeneratedValue, Id, JoinColumn, ManyToMany};
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
#[Entity]
class Image extends Entities
{
    #[Column(name: 'uuid', type: 'string'), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'low_res')]
    private ?string $lowRes;

    #[Column(name: 'high_res')]
    private string $highRes;

    public function getUuid() : string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) : Image
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getLowRes() : ?string
    {
        return $this->lowRes;
    }

    public function setLowRes(?string $lowRes) : Image
    {
        $this->lowRes = $lowRes;
        return $this;
    }

    public function getHighRes() : string
    {
        return $this->highRes;
    }

    public function setHighRes(string $highRes) : Image
    {
        $this->highRes = $highRes;
        return $this;
    }

}
