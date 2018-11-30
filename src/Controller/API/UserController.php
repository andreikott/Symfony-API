<?php

namespace App\Controller\API;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends FOSRestController
{

    /**
     * User Registration
     * @Rest\Post("/register")
     * @param Request $request
     * @return View
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     type="string",
     *     description="Data Form",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="username", type="string", example="Name", description="Username"),
     *         @SWG\Property(property="email", type="string", example="mailbox@domain.com", description="Email"),
     *         @SWG\Property(property="password", type="string", example="Password", description="Password"),
     *     )
     * )
     * @SWG\Response(response=200, description="User registered")
     * @SWG\Tag(name="User")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder): View
    {
        $entityManager = $this->getDoctrine()->getManager();

        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);

        $entityManager->persist($user);
        $entityManager->flush();

        return View::create('User '.$user->getUsername().' successfully created', Response::HTTP_CREATED);
    }

    /**
     * Clients List
     * @Rest\Post("/users/clients")
     *
     * @SWG\Response(response=200, description="Clients list displayed")
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function clientsList()
    {
        $clients = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $clients;
    }

    /**
     * Performers List
     * @Rest\Post("/users/performers")
     *
     * @SWG\Response(response=200, description="Performers list displayed")
     * @SWG\Tag(name="User")
     * @Security(name="Bearer")
     */
    public function performersList()
    {
        $performers = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $performers;
    }
}
