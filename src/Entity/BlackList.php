<?php

namespace App\Entity;

use App\Repository\BlackListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlackListRepository::class)]
class BlackList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $displayName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $displayGn;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mainLineNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

        return $this;
    }

    public function getDisplayGn(): ?string
    {
        return $this->displayGn;
    }

    public function setDisplayGn(?string $displayGn): self
    {
        $this->displayGn = $displayGn;

        return $this;
    }

    public function getMainLineNumber(): ?string
    {
        return $this->mainLineNumber;
    }

    public function setMainLineNumber(string $mainLineNumber): self
    {
        $this->mainLineNumber = $mainLineNumber;

        return $this;
    }
}
