<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Entity\Proyecto;
use App\Form\TareaType;
use App\Repository\TareaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto/{proyecto}/tarea")
 */
class TareaController extends AbstractController
{
    /**
     * @Route("/", name="tarea_index", methods={"GET"})
     */
    public function index(Proyecto $proyecto): Response
    {
        return $this->render('tarea/index.html.twig', [
            'tareas' => $proyecto->getTareas(),
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/new", name="tarea_new", methods={"GET","POST"})
     */
    public function new(Proyecto $proyecto, Request $request): Response
    {
        $tarea = new Tarea();
        $tarea->setProyecto($proyecto);
        $tarea->setGeneradoPor($this->getUser());
        $form = $this->createForm(TareaType::class, $tarea, [ 'proyecto' => $proyecto ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tarea);
            $entityManager->flush();

            return $this->redirectToRoute('tarea_index', [ 'proyecto' => $proyecto->getId() ]);
        }

        return $this->render('tarea/new.html.twig', [
            'tarea' => $tarea,
            'form' => $form->createView(),
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}", name="tarea_show", methods={"GET"})
     */
    public function show(Proyecto $proyecto, Tarea $tarea): Response
    {
        return $this->render('tarea/show.html.twig', [
            'tarea' => $tarea,
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tarea_edit", methods={"GET","POST"})
     */
    public function edit(Proyecto $proyecto, Request $request, Tarea $tarea): Response
    {
        $form = $this->createForm(TareaType::class, $tarea, [ 'proyecto' => $proyecto ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tarea_index', [ 'proyecto' => $proyecto->getId() ]);
        }

        return $this->render('tarea/edit.html.twig', [
            'tarea' => $tarea,
            'form' => $form->createView(),
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}", name="tarea_delete", methods={"DELETE"})
     */
    public function delete(Proyecto $proyecto, Request $request, Tarea $tarea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tarea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tarea_index', [ 'proyecto' => $proyecto->getId() ]);
    }
}
