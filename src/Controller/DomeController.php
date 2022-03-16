<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DomeController extends AbstractController
{
    /**
     * @Route("/dome", name="app_dome")
     */
    public function index(): Response
    {
        return $this->render('dome/index.html.twig');
    }
}
