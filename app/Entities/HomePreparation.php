<?php

namespace App\Entities;

use Core\Entities\Entities;
use Doctrine\ORM\Mapping\{
    Column,
    CustomIdGenerator,
    Entity,
    GeneratedValue,
    Id,
};
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
#[Entity]
class HomePreparation extends Entities
{
    #[Column(name: 'uuid', type: 'string'), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'title')]
    private string $title;

    #[Column(name: 'warn')]
    private ?string $warn;

    #[Column(name: 'note')]
    private ?string $note;

    public function getUuid() : string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) : HomePreparation
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : HomePreparation
    {
        $this->title = $title;
        return $this;
    }

    public function getWarn() : ?string
    {
        return $this->warn;
    }

    public function setWarn(?string $warn) : HomePreparation
    {
        $this->warn = $warn;
        return $this;
    }

    public function getNote() : ?string
    {
        return $this->note;
    }

    public function setNote(?string $note) : HomePreparation
    {
        $this->note = $note;
        return $this;
    }

}