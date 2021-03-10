<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Entity\Proyecto;
use App\Entity\Etiqueta;
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
    private function agregarEtiquetas($entityManager, $etiquetas, $tarea) {
        // Verifique que el campo no esté vacío
        if ($etiquetas) {
            $etiquetasRepository = $this->getDoctrine()->getRepository(Etiqueta::class);
            foreach ($etiquetas as $etiqueta) {
                // Busque si la etiqueta existe
                $newEtiqueta = $etiquetasRepository->findOneBy(['nombre' => $etiqueta]);
                
                // Si no exite insertela en la base de datos
                if (!$newEtiqueta) {
                    $newEtiqueta = new Etiqueta();
                    $newEtiqueta->setNombre($etiqueta);
                    $entityManager->persist($newEtiqueta);
                    $entityManager->flush();
                }
                
                // Agréguelas a la relación ManyToMany
                $tarea->addEtiqueta($newEtiqueta);
            }
        }
    }

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
        $form = $this->createForm(TareaType::class, $tarea, [
            'proyecto' => $proyecto,
            'etiquetas' => $tarea->nombresEtiquetas(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            // Traiga las etiquetas del formulario
            $etiquetas = json_decode($form->get('etiquetas')->getData());
            $this->agregarEtiquetas($entityManager, $etiquetas, $tarea);

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
        $form = $this->createForm(TareaType::class, $tarea, [
            'proyecto' => $proyecto,
            'etiquetas' => $tarea->nombresEtiquetas(),
        ]);
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
