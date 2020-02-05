<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/",name="account_")
 */
class AccountController extends Controller
{
    /**
     * @Route("/signup", name="signup")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function signinUp(Request $request,  UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $account = new Account();
        $accountForm = $this->createForm(AccountFormType::class,$account);
        $accountForm->handleRequest($request);

        if($accountForm->isSubmitted() && $accountForm->isValid()){
        $this->addFlash('success','Votre compte a bien été enregistré!');
        $account->setPassword($passwordEncoder->encodePassword(
            $account,
            $accountForm->get('plainPassword')->getData()));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($account);
        $entityManager->flush();

        return $this->redirectToRoute("main");

        }



        return $this->render('account/index.html.twig', [
            'accountFormView' => $accountForm->createView()
        ]);
    }

    /**
     * @Route("/login", name ="login")
     * @param $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('main/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);

    }

}
