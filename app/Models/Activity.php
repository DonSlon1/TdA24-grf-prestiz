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
use Doctrine\ORM\Exception\ORMException;
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
            $homePreparation->setActivity($activity);
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
            $instruction->setActivity($activity);
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
            $agenda->setActivity($activity);
            $agendaCollection->add($agenda);
        }
        $activity->setAgenda($agendaCollection);

        // Create and set Links entities
        $linksCollection = new ArrayCollection();
        foreach ($data->links ?? [] as $linkData) {
            $link = new Links();
            $link->setTitle($linkData['title'] ?? null);
            $link->setUrl($linkData['url']);
            $link->setActivity($activity);
            $linksCollection->add($link);
        }
        $activity->setLinks($linksCollection);

        // Create and set Gallery entities
        $galleryCollection = new ArrayCollection();
        foreach ($data->gallery ?? [] as $galleryData) {
            $gallery = new Gallery();
            $gallery->setTitle($galleryData['title']);
            $gallery->setActivity($activity);

            $imageCollection = new ArrayCollection();
            foreach ($galleryData['images'] ?? [] as $imageData) {
                $image = new Image();
                $image->setLowRes($imageData['lowRes'] ?? null);
                $image->setHighRes($imageData['highRes']);
                $image->setGallery($gallery);
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
    public function getAll(bool $needApproved=true): array
    {
        if ($needApproved){
            $activities = $this->entityManager->getRepository(ActivityEntity::class)->findBy(['approved' => true]);
        }else {
            $activities = $this->entityManager->getRepository(ActivityEntity::class)->findAll();
        }

        return $this->convertToArray($activities);
    }
    public function delete(string $activity): void
    {
        $activity = $this->entityManager->getRepository(ActivityEntity::class)->findOneBy(['uuid' => $activity]);
        $this->entityManager->remove($activity);
        $this->entityManager->flush();
    }
    public function getById(string $uuid,bool $neadBeApproved = true): array|null
    {
        if ($neadBeApproved){
            $activity = $this->entityManager->getRepository(ActivityEntity::class)->findOneBy(['uuid' => $uuid,'approved' => true]);
        }else{
            $activity = $this->entityManager->getRepository(ActivityEntity::class)->findOneBy(['uuid' => $uuid]);
        }
         if ($activity === null) {
             return null;
         }
         if (empty($activity)) {
             return null;
         }

        return $this->convertToArray([$activity]);
    }

    /**
     * @param ActivityEntity[] $activities
     * @return array
     */
    public function convertToArray(array $activities): array
    {
        return array_map(function (ActivityEntity $activity) {
            return [
                'uuid' => $activity->getUuid(),
                'activityName' => $activity->getActivityName(),
                'description' => $activity->getDescription(),
                'objectives' => $activity->getObjectives(),
                'classStructure' => $activity->getClassStructure()->value,
                'lengthMin' => $activity->getLengthMin(),
                'lengthMax' => $activity->getLengthMax(),
                'edLevel' => array_map(fn(EdLevel $level) => $level->value, $activity->getEdLevel() ?? []),
                'tools' => $activity->getTools(),
                'homePreparation' => $activity->getHomePreparation()->map(function (HomePreparation $prep) {
                    return [
                        'title' => $prep->getTitle(),
                        'warn' => $prep->getWarn(),
                        'note' => $prep->getNote(),
                    ];
                })->toArray(),
                'instructions' => $activity->getInstructions()->map(function (Instructions $instruction) {
                    return [
                        'title' => $instruction->getTitle(),
                        'warn' => $instruction->getWarn(),
                        'note' => $instruction->getNote(),
                    ];
                })->toArray(),
                'agenda' => $activity->getAgenda()->map(function (Agenda $agenda) {
                    return [
                        'duration' => $agenda->getDuration(),
                        'title' => $agenda->getTitle(),
                        'description' => $agenda->getDescription(),
                    ];
                })->toArray(),
                'links' => $activity->getLinks()->map(function (Links $link) {
                    return [
                        'title' => $link->getTitle(),
                        'url' => $link->getUrl(),
                    ];
                })->toArray(),
                'gallery' => $activity->getGallery()->map(function (Gallery $gallery) {
                    return [
                        'title' => $gallery->getTitle(),
                        'images' => $gallery->getGalleryImages()->map(function (Image $image) {
                            return [
                                'lowRes' => $image->getLowRes(),
                                'highRes' => $image->getHighRes(),
                            ];
                        })->toArray(),
                    ];
                })->toArray(),
            ];
        }, $activities);
    }

    public function approveActivity(string $uuid): bool
    {
        $activity = $this->entityManager->getRepository(ActivityEntity::class)->findOneBy(['uuid' => $uuid]);

        if (!$activity) {
            return false;
        }

        $activity->setApproved(true);

        try {
            $this->entityManager->flush();
        } catch (ORMException $e) {
            return false;
        }

        return true;
    }}