<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateMediaObjectAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity
 * @ORM\Table(name="media_object", indexes={@ORM\Index(name="fk_media_object_experiments_id", columns={"experiment_id"}), @ORM\Index(name="fk_media_object_users_userid", columns={"userid"})})
 * @ApiResource(iri="http://schema.org/MediaObject", collectionOperations={
 *     "get",
 *     "post"={
 *         "method"="POST",
 *         "path"="/media_objects",
 *         "controller"=CreateMediaObjectAction::class,
 *         "defaults"={"_api_receive"=false},
 *         "denormalization_context"={"groups"={"media_object_post"}},
 *         "validation_groups"={"media_object_post"},
 *         "swagger_context" = {
 *            "consumes" = {
 *                "multipart/form-data",
 *             },
 *             "parameters" = {
 *                 {
 *                      "name" = "file",
 *                      "in" = "formData",
 *                      "required" = "true",
 *                      "type" = "file",
 *                      "description" = "The file to upload"
 *                 }
 *             },
 *         }
 *     },
 * }) 
 * @Vich\Uploadable
 * @ApiFilter(SearchFilter::class, properties={"experimentid": "/experiments/id"})
 */
class MediaObject
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"media_object_read"})
     */
    public $contentUrl;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"media_object_create"})
     * @Vich\UploadableField(mapping="media_object", fileNameProperty="filePath")
     */
    public $file;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     */
    public $filePath;

    /**
     * @var \Experiments
     *
     * @ORM\ManyToOne(targetEntity="Experiments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="experiment_id", referencedColumnName="id")
     * })
     */
    private $experimentid;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="userid", referencedColumnName="userid")
     * })
     */
    private $userid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setContentUrl(string $contentUrl): self
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }

    public function getFile(): ?Users
    {
        return $this->file;
    }

    public function setFile(?Users $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getExperimentId(): ?Experiments
    {
        return $this->experimentid;
    }

    public function setExperimentId(?Experiments $experimentid): self
    {
        $this->experimentid = $experimentid;

        return $this;
    }

    public function getUserid(): ?Users
    {
        return $this->userid;
    }

    public function setUserid(?Users $userid): self
    {
        $this->userid = $userid;

        return $this;
    }
    
}