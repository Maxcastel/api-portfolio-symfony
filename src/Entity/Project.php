<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getFrameworks'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['getFrameworks'])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?string $url = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?string $github = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['getFrameworks'])]
    private ?string $thumbnail = null;

    #[ORM\ManyToMany(targetEntity: Framework::class, inversedBy: 'projects')]
    private Collection $frameworks;

    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'projects')]
    #[Groups(['getFrameworks'])]
    private Collection $languages;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['getFrameworks'])]
    private ?Type $type = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['getFrameworks'])]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'projects')]
    #[Groups(['getFrameworks'])]
    private ?Classe $classe = null;

    public function __construct()
    {
        $this->frameworks = new ArrayCollection();
        $this->languages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): static
    {
        $this->github = $github;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Collection<int, Framework>
     */
    public function getFrameworks(): Collection
    {
        return $this->frameworks;
    }

    public function addFramework(Framework $framework): static
    {
        if (!$this->frameworks->contains($framework)) {
            $this->frameworks->add($framework);
        }

        return $this;
    }

    public function removeFramework(Framework $framework): static
    {
        $this->frameworks->removeElement($framework);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->languages->removeElement($language);

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }
}
