<?php

namespace App\Models;

use App\Entities\Activity as ActivityEntity;
use App\Entities\Agenda;
use App\Enums\ClassStructure;
use App\Enums\EdLevel;
use App\Entities\Gallery;
use App\Entities\HomePreparation;
use App\Entities\Image;
use App\Entities\Instructions;
use App\Entities\Links;
use Core\Models\Model;
use Core\Http\Request;
use Core\Entities\EntitiesManager;
use Core\Http\Response;
use Doctrine\Common\Collections\ArrayCollection;
use stdClass;

readonly class Activity extends Model
{
    public function __construct(
        EntitiesManager $entityManagerInterface
    )
    {
        parent::__construct($entityManagerInterface);
    }

    public function create(stdClass $data) : ActivityEntity
    {
        // Create new Activity entity
        $activity = new ActivityEntity();
        $activity->setUuid($data->uuid);
        $activity->setActivityName($data->activityName);
        $activity->setDescription($data->description ?? null);
        $activity->setObjectives($data->objectives);
        $activity->setClassStructure(ClassStructure::from($data->classStructure));
        $activity->setLengthMin($data->lengthMin);
        $activity->setLengthMax($data->lengthMax);
        $activity->setEdLevel(isset($data->edLevel) ? array_map(fn($level) => EdLevel::from($level), $data->edLevel) : null);
        $activity->setTools($data->tools ?? null);

        // Create and set HomePreparation entities
        $homePreparationCollection = new ArrayCollection();
        foreach ($data->homePreparation ?? [] as $homePreparationData) {
            $homePreparation = new HomePreparation();
            $homePreparation->setTitle($homePreparationData['title']);
            $homePreparation->setWarn($homePreparationData['warn'] ?? null);
            $homePreparation->setNote($homePreparationData['note'] ?? null);
            $homePreparationCollection->add($homePreparation);
        }
        $activity->setHomePreparation($homePreparationCollection);

        // Create and set Instructions entities
        $instructionsCollection = new ArrayCollection();
        foreach ($data->instructions ?? [] as $instructionData) {
            $instruction = new Instructions();
            $instruction->setTitle($instructionData['title']);
            $instruction->setWarn($instructionData['warn'] ?? null);
            $instruction->setNote($instructionData['note'] ?? null);
            $instructionsCollection->add($instruction);
        }
        $activity->setInstructions($instructionsCollection);

        // Create and set Agenda entities
        $agendaCollection = new ArrayCollection();
        foreach ($data->agenda ?? [] as $agendaData) {
            $agenda = new Agenda();
            $agenda->setDuration($agendaData['duration']);
            $agenda->setTitle($agendaData['title']);
            $agenda->setDescription($agendaData['description'] ?? null);
            $agendaCollection->add($agenda);
        }
        $activity->setAgenda($agendaCollection);

        // Create and set Links entities
        $linksCollection = new ArrayCollection();
        foreach ($data->links ?? [] as $linkData) {
            $link = new Links();
            $link->setTitle($linkData['title'] ?? null);
            $link->setUrl($linkData['url']);
            $linksCollection->add($link);
        }
        $activity->setLinks($linksCollection);

        // Create and set Gallery entities
        $galleryCollection = new ArrayCollection();
        foreach ($data->gallery ?? [] as $galleryData) {
            $gallery = new Gallery();
            $gallery->setTitle($galleryData['title']);

            $imageCollection = new ArrayCollection();
            foreach ($galleryData->images ?? [] as $imageData) {
                $image = new Image();
                $image->setLowRes($imageData['lowRes'] ?? null);
                $image->setHighRes($imageData['highRes']);
                $imageCollection->add($image);
            }
            $gallery->setGalleryImages($imageCollection);
            $galleryCollection->add($gallery);
        }
        $activity->setGallery($galleryCollection);

        // Persist the Activity entity
        $entityManager = $this->getEntityManager();
        $entityManager->persist($activity);
        $entityManager->flush();


        return $activity;
        // Return the created Activity entity
    }
}