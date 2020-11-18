<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=StructureRepository::class)
 * @Vich\Uploadable
 */
class Structure
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
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\OneToOne(targetEntity=Type::class, inversedBy="structure", cascade={"persist", "remove"})
     */
    private $type_id;

    /**
     * @ORM\OneToMany(targetEntity=BusinessHours::class, mappedBy="structure")
     */
    private $businessHours;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="structures", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string")
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Affluence::class, mappedBy="structure")
     */
    private $affluences;



    public function __construct()
    {
        $this->businessHours = new ArrayCollection();
        $this->affluences = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetName(): ?string
    {
        return $this->streetName;
    }

    public function setStreetName(string $streetName): self
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTypeId(): ?Type
    {
        return $this->type_id;
    }

    public function setTypeId(?Type $type_id): self
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * @return Collection|BusinessHours[]
     */
    public function getBusinessHours(): Collection
    {
        return $this->businessHours;
    }

    public function addBusinessHour(BusinessHours $businessHour): self
    {
        if (!$this->businessHours->contains($businessHour)) {
            $this->businessHours[] = $businessHour;
            $businessHour->setStructure($this);
        }

        return $this;
    }

    public function removeBusinessHour(BusinessHours $businessHour): self
    {
        if ($this->businessHours->removeElement($businessHour)) {
            // set the owning side to null (unless already changed)
            if ($businessHour->getStructure() === $this) {
                $businessHour->setStructure(null);
            }
        }

        return $this;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile && $imageFile instanceof UploadedFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @return Collection|Affluence[]
     */
    public function getAffluences(): Collection
    {
        return $this->affluences;
    }

    public function addAffluence(Affluence $affluence): self
    {
        if (!$this->affluences->contains($affluence)) {
            $this->affluences[] = $affluence;
            $affluence->setStructure($this);
        }

        return $this;
    }

    public function removeAffluence(Affluence $affluence): self
    {
        if ($this->affluences->removeElement($affluence)) {
            // set the owning side to null (unless already changed)
            if ($affluence->getStructure() === $this) {
                $affluence->setStructure(null);
            }
        }

        return $this;
    }
}
