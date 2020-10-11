<?php

namespace App\Controller;

use App\Entity\Professionnel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $email = json_decode($request->getContent())->username;
        $password = json_decode($request->getContent())->password;
        $firstname = json_decode($request->getContent())->firstname;
        $lastname = json_decode($request->getContent())->lastname;
        $numeroSiret = json_decode($request->getContent())->numeroSiret;

        $user = new Professionnel();
        $user->setEmail($email);
        $user->setPrenom($firstname);
        $user->setNom($lastname);
        $user->setNumeroSiret($numeroSiret);
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($encoder->encodePassword($user, $password));
        $em->persist($user);
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
}
