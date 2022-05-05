<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\DataTransformer\UsersOutputDataTransformer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Users;
use App\Dto\UsersOutput;

#[AsController]
class UserManagement extends AbstractController
{
    #[Route('/user-management/signup', methods: ['POST'])]
    public function signup(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $parameters = json_decode($request->getContent(), true);
        $name = @$parameters['name'];
        $email = @$parameters['email'];
        $password = @$parameters['password'];
        $avatar = @$parameters['avatar'];
        $roles = ['ROLE_SCIENTIST'];
        if(empty($email) || empty($password)){
            $errors = [
                'errors' => [
                    'code' => 400,
                    'message' => 'Email address and password are required.'
                ]
            ];
            return new JsonResponse($errors, 400);
        }
        $existingUser = $this->getDoctrine()->getRepository(Users::class)->findOneByEmail($email);
        if($existingUser){
            $errors = [
                'errors' => [
                    'code' => 409,
                    'message' => 'This email address is already being used.'
                 ]
            ];
            return new JsonResponse($errors, 409);
        }
        $user = new Users();
        $password = $passwordHasher->hashPassword($user, $password);
        $user->setEmail($email)->setPassword($password)->setRoles($roles);
        if($name){
            $user->setName($name);
        }
        if($avatar){
            $user->setAvatar($avatar);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneByEmail($email);
        $response = (new UsersOutputDataTransformer($entityManager))->transform($user, UsersOutput::class);
        return new JsonResponse($response);
    }
    
    #[Route('/user-management/forgot-password', methods: ['POST'])]
    public function forgotPassword(Request $request, MailerInterface $mailer)
    {
        $parameters = json_decode($request->getContent(), true);
        $email = @$parameters['email'];
        if(empty($email)){
            $errors = [
                'errors' => [
                    'code' => 400,
                    'message' => 'Email address is required.'
                ]
            ];
            return new JsonResponse($errors, 400);
        }
        $existingUser = $this->getDoctrine()->getRepository(Users::class)->findOneByEmail($email);
        if(!$existingUser){
            $errors = [
                'errors' => [
                    'code' => 409,
                    'message' => 'This email address does not exist.'
                ]
            ];
            return new JsonResponse($errors, 409);
        }
        $hash = md5(uniqid(rand(), true));
        $exp = (new \DateTime())->add(new \DateInterval("PT24H"));
        $existingUser->setResetPasswordHash($hash)->setResetPasswordExp($exp);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($existingUser);
        $entityManager->flush();
        $baseUrl = $this->getParameter('app.base_url');
        $mailFrom = $this->getParameter('app.mail_from');
        $html = '<h2>Password reset requested</h2>';
        $html .= '<p>Someone requested a new password for your account. Click the link below to reset your password. The link expires in 24 hrs.</p>';
        $html .= '<p><a href="'.$baseUrl.'/auth/reset-password?hash='.$hash.'">Reset My Password</a></p>';
        $html .= 'If you didn\'t make this request then you can safely ignore this email.';
        $email = (new Email())
        ->from($mailFrom)
        ->to($email)
        ->subject('Reset your password')
        ->html($html);
        $mailer->send($email);
        $response = [
            'success' => 1
        ];
        return new JsonResponse($response);
    }
    
    #[Route('/user-management/reset-password', methods: ['POST'])]
    public function resetPassword(Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $parameters = json_decode($request->getContent(), true);
        $hash = @$parameters['hash'];
        $password = @$parameters['password'];
        if(empty($hash)){
            $errors = [
                'errors' => [
                    'code' => 400,
                    'message' => 'Hash is required.'
                ]
            ];
            return new JsonResponse($errors, 400);
        }
        $errors = [
            'errors' => [
                'code' => 409,
                'message' => 'Reset password link is expired.'
            ]
        ];
        $existingUser = $this->getDoctrine()->getRepository(Users::class)->findOneBy(array('resetPasswordHash' => $hash));
        if(!$existingUser){
            return new JsonResponse($errors, 409);
        }
        $exp = $existingUser->getResetPasswordExp();
        if(!$exp){
            return new JsonResponse($errors, 409);
        }
        $now = time();
        $exp = $exp->getTimestamp();
        $diff = $exp - $now;
        if($diff < 0){
            return new JsonResponse($errors, 409);
        }
        $password = $passwordHasher->hashPassword($existingUser, $password);
        $existingUser->setResetPasswordHash(null)->setResetPasswordExp(null)->setPassword($password);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($existingUser);
        $entityManager->flush();
        $response = [
            'success' => 1
        ];
        return new JsonResponse($response);
    }
}
