<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateFileUploadAction;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="file_upload",
 *     indexes={
 *         @ORM\Index(name="fk_file_upload_owner", columns={"owner"})
 *     }
 * )
 * @ApiResource(
 *     iri="http://schema.org/FileUpload",
 *     normalizationContext={
 *         "groups"={"file_upload_read"}
 *     },
 *     attributes={"security"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateFileUploadAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "file_upload_create"},
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
 *                                      }
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
 *         "delete" = { "security" = "is_granted('ROLE_ADMIN') or object.getOwner() == user.getId()" }
 *     }
 * )
 * @Vich\Uploadable
 */
class FileUpload
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @ORM\Id
     * @Groups({"file_upload_read"})
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"file_upload_read"})
     */
    public $contentUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="filename", type="text", length=65535, nullable=false)
     * @Groups({"file_upload_read"})
     */
    public $filename;

    /**
     * @var File|null
     *
     * @Assert\NotNull(groups={"file_upload_create"})
     * @Assert\File(maxSize="20M")
     * @Vich\UploadableField(mapping="file_upload", fileNameProperty="filePath")
     */
    public $file;

    /**
     * @var string|null
     *
     * @ORM\Column(nullable=true)
     * @Groups({"file_upload_read"})
     */
    public $filePath;

      /**
     * @var int|null
     *
     * @ORM\Column(name="owner", type="integer", options={"unsigned"=true}, nullable=true)
     */
    protected $owner;

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

    public function getOwner(): ?int
    {
        return $this->owner;
    }

    public function setOwner(int $owner): self
    {
        $this->owner = $owner;
        return $this;
    }
}