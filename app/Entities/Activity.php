<?php

namespace App\Entities;

use App\Enums\ClassStructure;
use App\Enums\EdLevel;
use Core\Entities\Entities;
use Doctrine\ORM\Mapping\{Column,
    Entity,
    Id,
    JoinColumn,
    OneToMany,
    };
use Doctrine\Common\Collections\Collection;

{

}
#[Entity]
class Activity extends Entities
{
    #[Column(name: 'uuid', type: 'string',length: 50), Id]
    private string $uuid;

    #[Column(name: 'activityName')]
    private string $activityName;

    /**@var $objectives string[]*/
    #[Column(name: 'objectives',type: 'json')]
    private array $objectives;
    #[Column(name: 'description',nullable: true)]
    private ?string $description;
    #[Column(name:'classStructure',type: 'string',enumType: ClassStructure::class)]
    private ClassStructure $classStructure;

    #[Column(name: 'lengthMin')]
    private int $lengthMin;
    #[Column(name: 'lengthMax')]
    private int $lengthMax;
    /**@var $edLevel EdLevel[]*/
    #[Column(name: 'edLevel', type: 'json', nullable: true, enumType: EdLevel::class)]
    private ?array $edLevel;
    /**@var $tools string[]*/
    #[Column(name: 'tools',type: 'json',nullable: true)]
    private ?array $tools;

    #[OneToMany(targetEntity: HomePreparation::class, mappedBy: 'activity',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'homePreparation', referencedColumnName: 'uuid')]
    private Collection $homePreparation;

    #[OneToMany(targetEntity: Instructions::class, mappedBy: 'activity',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'instructions', referencedColumnName: 'uuid')]
    private Collection $instructions;

    #[OneToMany(targetEntity: Agenda::class, mappedBy: 'activity',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'activity_uuid', referencedColumnName: 'uuid')]
    private Collection $agenda;

    #[OneToMany(targetEntity: Links::class, mappedBy: 'activity',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'links', referencedColumnName: 'uuid')]
    private Collection $links;

    #[OneToMany(targetEntity: Gallery::class, mappedBy: 'activity',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'gallery_activity', referencedColumnName: 'uuid')]
    private Collection $gallery;

    public function getUuid() : string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) : Activity
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getActivityName() : string
    {
        return $this->activityName;
    }

    public function setActivityName(string $activityName) : Activity
    {
        $this->activityName = $activityName;
        return $this;
    }

    public function getObjectives() : array
    {
        return $this->objectives;
    }

    public function setObjectives(array $objectives) : Activity
    {
        $this->objectives = $objectives;
        return $this;
    }

    public function getDescription() : ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description) : Activity
    {
        $this->description = $description;
        return $this;
    }

    public function getClassStructure() : ClassStructure
    {
        return $this->classStructure;
    }

    public function setClassStructure(ClassStructure $classStructure) : Activity
    {
        $this->classStructure = $classStructure;
        return $this;
    }

    public function getLengthMin() : int
    {
        return $this->lengthMin;
    }

    public function setLengthMin(int $lengthMin) : Activity
    {
        $this->lengthMin = $lengthMin;
        return $this;
    }

    public function getLengthMax() : int
    {
        return $this->lengthMax;
    }

    public function setLengthMax(int $lengthMax) : Activity
    {
        $this->lengthMax = $lengthMax;
        return $this;
    }

    public function getEdLevel() : ?array
    {
        return $this->edLevel;
    }

    public function setEdLevel(?array $edLevel) : Activity
    {
        $this->edLevel = $edLevel;
        return $this;
    }

    public function getTools() : ?array
    {
        return $this->tools;
    }

    public function setTools(?array $tools) : Activity
    {
        $this->tools = $tools;
        return $this;
    }

    public function getHomePreparation() : Collection
    {
        return $this->homePreparation;
    }

    public function setHomePreparation(Collection $homePreparation) : Activity
    {
        $this->homePreparation = $homePreparation;
        return $this;
    }

    public function getInstructions() : Collection
    {
        return $this->instructions;
    }

    public function setInstructions(Collection $instructions) : Activity
    {
        $this->instructions = $instructions;
        return $this;
    }

    public function getAgenda() : Collection
    {
        return $this->agenda;
    }

    public function setAgenda(Collection $agenda) : Activity
    {
        $this->agenda = $agenda;
        return $this;
    }

    public function getLinks() : Collection
    {
        return $this->links;
    }

    public function setLinks(Collection $links) : Activity
    {
        $this->links = $links;
        return $this;
    }

    public function getGallery() : Collection
    {
        return $this->gallery;
    }

    public function setGallery(Collection $gallery) : Activity
    {
        $this->gallery = $gallery;
        return $this;
    }


}