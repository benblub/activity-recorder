<?php
namespace App\Controller;

use ApiPlatform\Core\Api\IriConverterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    const UNAUTHORIZED = 401;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Use an X-AUTH Api Token to Communicate with our API
     * Post email and Password to get a Api Token.
     *
     * @Route("/api/login", name="login_get_token", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserApiTokenAndIri(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        IriConverterInterface $iriConverter
    ) : Response
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);

            $user = $this->manager->getRepository(User::class)
                ->findOneBy([
                    'email' => $data['email'],
                ]);

            if (!$passwordEncoder->isPasswordValid($user, $data['password'])) {
                return new JsonResponse([
                    'error' => 'Email or Password wrong',
                ], self::UNAUTHORIZED);
            }
        } else {
            $user = $this->manager->getRepository(User::class)
                ->findOneBy([
                    'email' => $request->get('email'),
                ]);

            if (!$passwordEncoder->isPasswordValid($user, $request->get('password'))) {
                return new JsonResponse([
                    'error' => 'Email or Password wrong',
                ], self::UNAUTHORIZED);
            }
        }

        return new JsonResponse([
            'apiToken' => $user->getApiToken(),
            'iri' => $iriConverter->getIriFromItem($user)
        ], 200);
    }

    /**
     * @Route("/weblogin", name="web_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
}