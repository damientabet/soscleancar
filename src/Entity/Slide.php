<?php

namespace App\Entity;

use App\Repository\SlideRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SlideRepository::class)
 */
class Slide
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $video_link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $container_alignment;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $text_alignment;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $container_apparaition;

    /**
     * @ORM\Column(type="text")
     */
    private $button_link;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $button_title;

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

    public function getImgName(): ?string
    {
        return $this->img_name;
    }

    public function setImgName(string $img_name): self
    {
        $this->img_name = $img_name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->video_link;
    }

    public function setVideoLink(string $video_link): self
    {
        $this->video_link = $video_link;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getContainerAlignment(): ?string
    {
        return $this->container_alignment;
    }

    public function setContainerAlignment(string $container_alignment): self
    {
        $this->container_alignment = $container_alignment;

        return $this;
    }

    public function getTextAlignment(): ?string
    {
        return $this->text_alignment;
    }

    public function setTextAlignment(string $text_alignment): self
    {
        $this->text_alignment = $text_alignment;

        return $this;
    }

    public function getContainerApparaition(): ?string
    {
        return $this->container_apparaition;
    }

    public function setContainerApparaition(string $container_apparaition): self
    {
        $this->container_apparaition = $container_apparaition;

        return $this;
    }

    public function getButtonLink(): ?string
    {
        return $this->button_link;
    }

    public function setButtonLink(string $button_link): self
    {
        $this->button_link = $button_link;

        return $this;
    }

    public function getButtonTitle(): ?string
    {
        return $this->button_title;
    }

    public function setButtonTitle(string $button_title): self
    {
        $this->button_title = $button_title;

        return $this;
    }
}
