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
    Table
};
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[Entity]
#[Table(name: 'email_addresses')]
class EmailAddresses extends Entities
{
    #[Column(name: 'uuid', type: 'string'), Id]
    #[GeneratedValue(strategy: "CUSTOM"), CustomIdGenerator(class: UuidGenerator::class)]
    private string $uuid;
    #[Column(name: 'email', type: 'string', length: 50)]
    private string $email;

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): EmailAddresses
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): EmailAddresses
    {
        $this->email = $email;
        return $this;
    }


}