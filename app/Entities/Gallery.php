<?php

namespace App\Entities;
use Core\Entities\Entities;
use Doctrine\ORM\Mapping\{
    Column,
    CustomIdGenerator,
    Entity,
    GeneratedValue,
    Id,
    JoinColumn,
    ManyToOne,
    OneToMany,
    Table
};
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
#[Entity]
class Gallery extends Entities
{
    #[Column(name: 'uuid', type: 'string'), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'title')]
    private string $title;

    #[OneToMany(targetEntity: Image::class, mappedBy: 'gallery',cascade: ['persist', 'remove'])]
    #[JoinColumn(name: 'gallery_id', referencedColumnName: 'uuid')]
    private Collection $galleryImages;

    public function getUuid() : string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid) : Gallery
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : Gallery
    {
        $this->title = $title;
        return $this;
    }

    public function getGalleryImages() : Collection
    {
        return $this->galleryImages;
    }

    public function setGalleryImages(Collection $galleryImages) : Gallery
    {
        $this->galleryImages = $galleryImages;
        return $this;
    }


}
