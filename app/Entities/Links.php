<?php
    namespace App\Entities;

    use Core\Entities\Entities;
    use Doctrine\ORM\Mapping\{Column, CustomIdGenerator, Entity, GeneratedValue, Id, JoinColumn, ManyToOne};
    use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
    #[Entity]
    class Links extends Entities
    {
        #[Column(name: 'uuid', type: 'string',length: 50), Id]
        #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
        private string $uuid;
        #[Column(name: 'title',nullable: true)]
        private ?string $title;

        #[Column(name: 'url')]
        private string $url;


        #[ManyToOne(targetEntity: Activity::class, inversedBy: 'links')]
        #[JoinColumn(name: 'links', referencedColumnName: 'uuid')]
        private Activity $activity;
        public function getUuid() : string
        {
            return $this->uuid;
        }

        public function setUuid(string $uuid) : Links
        {
            $this->uuid = $uuid;
            return $this;
        }

        public function getTitle() : ?string
        {
            return $this->title;
        }

        public function setTitle(?string $title) : Links
        {
            $this->title = $title;
            return $this;
        }

        public function getUrl() : string
        {
            return $this->url;
        }

        public function setUrl(string $url) : Links
        {
            $this->url = $url;
            return $this;
        }

        public function getActivity() : Activity
        {
            return $this->activity;
        }

        public function setActivity(Activity $activity) : Links
        {
            $this->activity = $activity;
            return $this;
        }


    }
