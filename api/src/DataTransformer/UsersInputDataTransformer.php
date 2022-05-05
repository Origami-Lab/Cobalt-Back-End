<?php
namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use App\Entity\Users;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Security\Core\Security;

final class UsersInputDataTransformer implements DataTransformerInterface
{
    
    private $passwordHasher;
    private $params;
    private $security;
    
    public function __construct(UserPasswordHasherInterface $passwordHasher, ParameterBagInterface $params, Security $security)
    {
        $this->passwordHasher = $passwordHasher;
        $this->params = $params;
        $this->security = $security;
    }
    /**
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $authUser = $this->security->getUser();
        $existingUser = @$context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
        $existingUserId = 0;
        if($existingUser){
            $user = $existingUser;
            $existingUserId = $user->getId();
        }else{
            $user = new Users();
        }
        $email = $data->email;
        if($email){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return $user;
            }
            $user->setEmail($email);
        }
        $roles = [];
        $roles = $data->roles;
        if(!$roles){
            if(!$existingUserId){
                $roles = ['ROLE_SCIENTIST'];
            }
        }else{
            if(in_array('ROLE_ADMIN', $roles)){
                $roles = ['ROLE_ADMIN'];
            }else{
                $validRoles = $this->params->get('app.valid_user_roles');
                $roles = array_intersect($roles, $validRoles);
                $roles = array_values($roles);
            }
        }
        if($roles){
            $ignoreRole = 0;
            if($authUser){
                $authRoles = $authUser->getRoles();
                if($authUser->getId() == $existingUserId && !in_array('ROLE_ADMIN', $authRoles)){
                    $ignoreRole = 1;
                }
            }
            if(!$ignoreRole){
                $user->setRoles($roles);
            }
        }
        if($data->name){
            $user->setName($data->name);
        }
        if($data->avatar){
            $user->setAvatar($data->avatar);
        }
        $password = $data->password;
        if($password){
            $password = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($password);
        }
        $padid = $data->padid;
        if($padid){
            $user->setPadid($padid);
        }
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