<?php


namespace App\Controller;


use App\Entity\User;
use App\Service\User\UserHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * After Registration a new User you can activate the User
     *
     * @Route("/user/activate/{activateToken}", name="enable_user")
     */
    public function activateUser($activateToken, Userhandler $userHandler)
    {
        $userHandler->activate($activateToken);

        // The User is now enabled.
        // The User can login now with any client and start create first activities
        return new JsonResponse([
            'message' => 'User is enabled, Login and start creating first activities!'
        ], 200);

    }
}