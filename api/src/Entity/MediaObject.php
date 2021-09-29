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
 * @ORM\Table(name="media_object")
 * @ApiResource(
 *     iri="http://schema.org/MediaObject",
 *     normalizationContext={
 *         "groups"={"media_object_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateMediaObjectAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "media_object_create"},
 *             "openapi_context"={
 *              "summary"="Upload files",
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="file",
 *                                         "format"="binary",
 *                                     },
 *                                      "filename"={
 *                                          "type"="string",
 *                                      },
 *                                      "experimentid"={
 *                                          "type"="string",
 *                                      },
 *                                      "userid"={
 *                                          "type"="string",
 *                                      },
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get",
 *         "delete"
 *     }
 * )
 * @Vich\Uploadable
 * @ApiFilter(SearchFilter::class, properties={"experimentid": "exact" , "userid": "exact"})
 */
class MediaObject
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @Groups({"media_object_read"})
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
     * @var string|null
     *
     * @ORM\Column(name="filename", type="text", length=65535, nullable=false)
     * @Groups({"media_object_read"})
     */
    public $filename;

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
     * @Groups({"media_object_read"})
     */
    public $filePath;


      /**
     * @var string|null
     *
     * @ORM\Column(name="experimentid", type="text", length=65535, nullable=false)
     * @Groups({"media_object_read"})
     */
    public $experimentid;

      /**
     * @var string|null
     *
     * @ORM\Column(name="user_id", type="text", length=65535, nullable=false)
     * @Groups({"media_object_read"})
     */
    public $userid;

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

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getExperimentid(): ?string
    {
        return $this->experimentid;
    }

    public function setExperimentid(string $experimentid): self
    {
        $this->experimentid = $experimentid;

        return $this;
    }

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }
    
    public function isStringUserid(): ?bool
    {
        return true;
    }
    
    public function isStringExperimentid(): ?bool
    {
        return true;
    }
}