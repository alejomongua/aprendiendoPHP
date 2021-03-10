<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Etiqueta;
use App\Form\ProyectoType;
use App\Repository\ProyectoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto")
 */
class ProyectoController extends AbstractController
{
    /**
     * @Route("/", name="proyecto_index", methods={"GET"})
     */
    public function index(ProyectoRepository $proyectoRepository): Response
    {
        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="proyecto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $proyecto = new Proyecto();
        $proyecto->setGeneradoPor($this->getUser());
        $proyecto->addAutorizado($this->getUser());
        $form = $this->createForm(ProyectoType::class, $proyecto, [ 'etiquetas' => $proyecto->nombresEtiquetas() ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            // Traiga las etiquetas del formulario
            $etiquetas = json_decode($form->get('etiquetas')->getData());
            
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
                    $proyecto->addEtiqueta($newEtiqueta);
                }
    
            }

            $entityManager->persist($proyecto);
            $entityManager->flush();

            return $this->redirectToRoute('proyecto_index');
        }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form->createView(),
            'javascript' => 'proyectoNew',
        ]);
    }

    /**
     * @Route("/{id}", name="proyecto_show", methods={"GET"})
     */
    public function show(Proyecto $proyecto): Response
    {
        return $this->render('proyecto/show.html.twig', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proyecto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Proyecto $proyecto): Response
    {
        $form = $this->createForm(ProyectoType::class, $proyecto, [ 'etiquetas' => $proyecto->nombresEtiquetas() ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('proyecto_index');
        }

        return $this->render('proyecto/edit.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proyecto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Proyecto $proyecto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proyecto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $proyecto->setEstado('Abortado');
            $entityManager->flush();
        }

        return $this->redirectToRoute('proyecto_index');
    }
}
