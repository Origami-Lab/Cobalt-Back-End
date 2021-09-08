<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Dto\UsersOutput;
use App\Dto\UsersInput;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="email_idx", columns={"email"})})
 * @ApiResource(
 *     output=UsersOutput::class,
 *     input=UsersInput::class,
 *     attributes={"security"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *     collectionOperations={
 *          "get",
 *          "post" = { "security_post_denormalize" = "is_granted('ROLE_ADMIN')" }
 *     },
 *     itemOperations={ 
 *         "get" = { "security" = "is_granted('IS_AUTHENTICATED_FULLY')" },
 *         "put" = { "security" = "is_granted('ROLE_ADMIN')" },
 *         "delete" = { "security" = "is_granted('ROLE_ADMIN')" } 
 *     }
 * )
 * @ApiFilter(OrderFilter::class, properties={"userid","name"})
 * @ApiFilter(SearchFilter::class, properties={"name": "partial","email": "partial"})
 * @ORM\Entity
 */
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    public function __construct()
    {
        $this->experiments = new ArrayCollection();
    }
    /**
     * @var int
     *
     * @ORM\Column(name="userid", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     */
    private $email;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;
    
    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @ORM\OneToMany(targetEntity="Users2teams", mappedBy="users")
     * @ApiSubresource
     */
    private $users2teams;
    
    /** 
     * @ORM\OneToMany(targetEntity="Experiments", mappedBy="userid")
     */
    private $experiments;



    public function getUserid(): ?int
    {
        return $this->userid;
    }
    
    public function getId(): ?int
    {
        return $this->userid;
    }
    
    public function getEmail(): ?string
    {
        return $this->email;
    }
    
    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        
        return $this;
    }

    public function getLastLogin(): ?\DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }
    /**
     * @ORM\Column(name="roles", type="json", nullable=true)
     */
    private $roles = [];
    
    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_SCIENTIST';
        return array_unique($roles);
    }
    
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        
        return $this;
    }
    
    public function getSalt(){
        return null;
    }
    
    public function eraseCredentials(){
        
    }
    
    public function getUsername(){
        return $this->email;
    }
    
    public function getUserIdentifier(){
        return $this->email;
    }
    
    public function getExperiments() {
        return $this->experiments; 
    }
    
    public function getUsers2teams() {
        return $this->users2teams;
    }
}
