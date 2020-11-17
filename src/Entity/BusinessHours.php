<?php

namespace App\Entity;

use App\Repository\BusinessHoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BusinessHoursRepository::class)
 */
class BusinessHours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $openTime;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $closeTime;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="businessHours")
     */
    private $structure;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenTime(): ?string
    {
        return $this->openTime;
    }

    public function setOpenTime(string $openTime): self
    {
        $this->openTime = $openTime;

        return $this;
    }

    public function getCloseTime(): ?string
    {
        return $this->closeTime;
    }

    public function setCloseTime(string $closeTime): self
    {
        $this->closeTime = $closeTime;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }
}
