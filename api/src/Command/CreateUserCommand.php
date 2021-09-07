<?php 
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    
    private $entityManager;
    
    private $passwordHasher;
    
    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Creates a new user.')
             ->setHelp('This command allows you to create a user...');
        $this->addArgument('email', InputArgument::REQUIRED, 'The email of the user.');
        $this->addArgument('name', InputArgument::REQUIRED, 'The name of the user.');
        $this->addArgument('password', InputArgument::REQUIRED, 'User password');
        $this->addArgument('role', InputArgument::OPTIONAL, 'User role');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try{
            $email = $input->getArgument('email');
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $output->write('Cannot create new user.');
                $output->write('Invalid email address');
                return Command::INVALID;
            }
            $user = new Users();
            $user->setEmail($email);
            $name = $input->getArgument('name');
            $user->setName($name);
            $roles = [];
            $role = $input->getArgument('role');
            if($role){
                $roles[] = $role;
            }else{
                $roles[] = 'ROLE_SCIENTIST';
            }
            $user->setRoles($roles);
            $password = $input->getArgument('password');
            $password = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            $output->write('New user created.');
            return Command::SUCCESS;
        }catch (\Throwable $e){
            $output->write('Cannot create new user.');
            $output->write($e->getMessage());
            return Command::FAILURE;
        }
    }
}
