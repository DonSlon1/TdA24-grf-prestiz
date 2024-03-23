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
class Agenda extends Entities
{
    #[Column(name: 'uuid', type: 'string'), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'duration')]
    private int $duration;
    #[Column(name: 'title')]
    private string $title;
    #[Column(name: 'description')]
    private ?string $description;

    public function getUuid() : string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) : Agenda
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getDuration() : int
    {
        return $this->duration;
    }

    public function setDuration(int $duration) : Agenda
    {
        $this->duration = $duration;
        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : Agenda
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description) : Agenda
    {
        $this->description = $description;
        return $this;
    }

}
