<?php

namespace App\Controller;

use App\Entity\Etiqueta;
use App\Form\EtiquetaType;
use App\Repository\EtiquetaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etiqueta")
 */
class EtiquetaController extends AbstractController
{
    /**
     * @Route("/", name="etiqueta_index", methods={"GET"})
     */
    public function index(EtiquetaRepository $etiquetaRepository): Response
    {
        return $this->render('etiqueta/index.html.twig', [
            'etiquetas' => $etiquetaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiqueta_show", methods={"GET"})
     */
    public function show(Etiqueta $etiqueta): Response
    {
        return $this->render('etiqueta/show.html.twig', [
            'etiqueta' => $etiqueta,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etiqueta_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etiqueta $etiqueta): Response
    {
        $form = $this->createForm(EtiquetaType::class, $etiqueta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etiqueta_index');
        }

        return $this->render('etiqueta/edit.html.twig', [
            'etiqueta' => $etiqueta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etiqueta_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Etiqueta $etiqueta): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etiqueta->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etiqueta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etiqueta_index');
    }
}
