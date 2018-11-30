<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="product")
     * @Serializer\Exclude()
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RequestEntity", mappedBy="product")
     * @Serializer\Exclude()
     */
    private $requests;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->requests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setProduct($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getProduct() === $this) {
                $project->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RequestEntity[]
     */
    public function getRequests(): Collection
    {
        return $this->requests;
    }

    public function addRequest(RequestEntity $request): self
    {
        if (!$this->requests->contains($request)) {
            $this->requests[] = $request;
            $request->setProduct($this);
        }

        return $this;
    }

    public function removeRequest(RequestEntity $request): self
    {
        if ($this->requests->contains($request)) {
            $this->requests->removeElement($request);
            // set the owning side to null (unless already changed)
            if ($request->getProduct() === $this) {
                $request->setProduct(null);
            }
        }

        return $this;
    }
}
