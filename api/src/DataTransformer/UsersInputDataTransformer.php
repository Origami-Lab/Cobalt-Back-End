<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;
use App\Entity\Experiments;

final class UsersInputDataTransformer implements DataTransformerInterface
{
    
    private $passwordHasher;
    
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $user = new Users();
        $email = $data->email;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $user;
        }
        $user->setEmail($email);
        $roles = [];
        $roles = $data->roles;
        if(!$roles){
            $roles = ['ROLE_SCIENTIST'];
        }
        $user->setRoles($roles);
        if($data->name){
            $user->setName($data->name);
        }
        if($data->avatar){
            $user->setAvatar($data->avatar);
        }
        $password = $data->password;
        $password = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($password);
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Users) {
          return false;
        }
        return Users::class === $to && null !== ($context['input']['class'] ?? null);
    }
}