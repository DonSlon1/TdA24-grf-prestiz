<?php

namespace App\Entities;

use Core\Entities\Entities;
use Doctrine\ORM\Mapping\{Column, CustomIdGenerator, Entity, GeneratedValue, Id, JoinColumn, ManyToOne};
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
#[Entity]
class HomePreparation extends Entities
{
    #[Column(name: 'uuid', type: 'string',length: 50), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'title')]
    private string $title;

    #[Column(name: 'warn',nullable: true)]
    private ?string $warn;

    #[Column(name: 'note',nullable: true)]
    private ?string $note;
    #[ManyToOne(targetEntity: Activity::class, inversedBy: 'homePreparation')]
    #[JoinColumn(name: 'homePreparation', referencedColumnName: 'uuid')]
    private Activity $activity;

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

    public function getActivity() : Activity
    {
        return $this->activity;
    }

    public function setActivity(Activity $activity) : HomePreparation
    {
        $this->activity = $activity;
        return $this;
    }

}