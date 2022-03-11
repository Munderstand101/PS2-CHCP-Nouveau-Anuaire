<?php

namespace App\Entity;

use App\Repository\InfoCompRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoCompRepository::class)]
class InfoComp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $mainLineNumber;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $champComp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainLineNumber(): ?string
    {
        return $this->mainLineNumber;
    }

    public function setMainLineNumber(?string $mainLineNumber): self
    {
        $this->mainLineNumber = $mainLineNumber;

        return $this;
    }

    public function getChampComp(): ?string
    {
        return $this->champComp;
    }

    public function setChampComp(?string $champComp): self
    {
        $this->champComp = $champComp;

        return $this;
    }
}
