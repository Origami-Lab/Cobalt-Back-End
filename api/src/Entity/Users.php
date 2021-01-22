<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ApiResource
 * @ORM\Entity
 */
class Users
{
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
     * @var string|null
     *
     * @ORM\Column(name="mfa_secret", type="string", length=32, nullable=true)
     */
    private $mfaSecret;

   

    /**
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=true)
     */
    private $token;

    /**
     * @var bool
     *
     * @ORM\Column(name="limit_nb", type="boolean", nullable=false, options={"default"="15"})
     */
    private $limitNb = '15';

    /**
     * @var string
     *
     * @ORM\Column(name="sc_create", type="string", length=1, nullable=false, options={"default"="c"})
     */
    private $scCreate = 'c';

    /**
     * @var string
     *
     * @ORM\Column(name="sc_edit", type="string", length=1, nullable=false, options={"default"="e"})
     */
    private $scEdit = 'e';

    /**
     * @var string
     *
     * @ORM\Column(name="sc_submit", type="string", length=1, nullable=false, options={"default"="s"})
     */
    private $scSubmit = 's';

    /**
     * @var string
     *
     * @ORM\Column(name="sc_todo", type="string", length=1, nullable=false, options={"default"="t"})
     */
    private $scTodo = 't';

  

    /**
     * @var bool
     *
     * @ORM\Column(name="inc_files_pdf", type="boolean", nullable=false, options={"default"="1"})
     */
    private $incFilesPdf = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="pdfa", type="boolean", nullable=false, options={"default"="1"})
     */
    private $pdfa = true;

    

  

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    



    public function getUserid(): ?int
    {
        return $this->userid;
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

    public function getMfaSecret(): ?string
    {
        return $this->mfaSecret;
    }

    public function setMfaSecret(?string $mfaSecret): self
    {
        $this->mfaSecret = $mfaSecret;

        return $this;
    }

   

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getLimitNb(): ?bool
    {
        return $this->limitNb;
    }

    public function setLimitNb(bool $limitNb): self
    {
        $this->limitNb = $limitNb;

        return $this;
    }

    public function getScCreate(): ?string
    {
        return $this->scCreate;
    }

    public function setScCreate(string $scCreate): self
    {
        $this->scCreate = $scCreate;

        return $this;
    }

    public function getScEdit(): ?string
    {
        return $this->scEdit;
    }

    public function setScEdit(string $scEdit): self
    {
        $this->scEdit = $scEdit;

        return $this;
    }

    public function getScSubmit(): ?string
    {
        return $this->scSubmit;
    }

    public function setScSubmit(string $scSubmit): self
    {
        $this->scSubmit = $scSubmit;

        return $this;
    }

    public function getScTodo(): ?string
    {
        return $this->scTodo;
    }

    public function setScTodo(string $scTodo): self
    {
        $this->scTodo = $scTodo;

        return $this;
    }


    public function getIncFilesPdf(): ?bool
    {
        return $this->incFilesPdf;
    }

    public function setIncFilesPdf(bool $incFilesPdf): self
    {
        $this->incFilesPdf = $incFilesPdf;

        return $this;
    }

    public function getPdfa(): ?bool
    {
        return $this->pdfa;
    }

    public function setPdfa(bool $pdfa): self
    {
        $this->pdfa = $pdfa;

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

}
