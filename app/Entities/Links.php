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
    class Links extends Entities
    {
        #[Column(name: 'uuid', type: 'string'), Id]
        #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
        private string $uuid;
        #[Column(name: 'title')]
        private ?string $title;

        #[Column(name: 'url')]
        private string $url;

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

    }
