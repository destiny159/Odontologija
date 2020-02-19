<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
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
     * @Route("/privatumoPolitika", name="privacy")
     */
    public function privacy()
    {
        return $this->render('main/privatumo_politika.html');
    }

    /**
     * @Route("/taisykles", name="rules")
     */
    public function rules()
    {
        return $this->render('main/taisykles.html');
    }

    /**
     * @Route("/registracija/Vilnius", name="reg_vilnius")
     */
    public function regVilnius()
    {
        return $this->render('main/regVilnius.html.twig');
    }

}
