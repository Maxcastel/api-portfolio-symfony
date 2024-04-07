<?php

namespace App\Entity;

use App\Repository\FrameworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrameworkRepository::class)]
class Framework
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['getFrameworks', 'getLanguages', 'getTypes', 'getCategory', 'getClasses', 'getProjects'])]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Groups(['getFrameworks', 'getLanguages', 'getTypes', 'getCategory', 'getClasses', 'getProjects'])]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'frameworks')]
    #[Groups(['getFrameworks'])]
    private Collection $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addFramework($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            $project->removeFramework($this);
        }

        return $this;
    }
}
