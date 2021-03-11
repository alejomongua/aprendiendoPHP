<?php

namespace App\Controller;

use App\Entity\Proyecto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $proyectos = $user->getProyectosAutorizados()->filter(function(Proyecto $proyecto)
        {
            return $proyecto->getEstado() == 'En proceso';
        });

        return $this->render('main/home.html.twig', [
            'proyectos' => $proyectos,
        ]);
    }
}
