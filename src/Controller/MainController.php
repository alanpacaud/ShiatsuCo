<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('main/contact.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentation()
    {
        return $this->render('main/presentation.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
