<?php

namespace App\Controller;

use App\Entity\Atsiliepimai;
use App\Form\AtsiliepimaiType;
use App\Repository\AtsiliepimaiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/atsiliepimai")
 */
class AtsiliepimaiController extends AbstractController
{
    /**
     * @Route("/", name="atsiliepimai_index", methods={"GET"})
     */
    public function index(AtsiliepimaiRepository $atsiliepimaiRepository): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="STUDENTAS"){
            return $this->redirectToRoute('main');
        }
        return $this->render('atsiliepimai/index.html.twig', [
            'atsiliepimais' => $atsiliepimaiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="atsiliepimai_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $atsiliepimai = new Atsiliepimai();
        $form = $this->createForm(AtsiliepimaiType::class, $atsiliepimai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($atsiliepimai);
            $entityManager->flush();

            return $this->redirectToRoute('atsiliepimai_index');
        }

        return $this->render('atsiliepimai/new.html.twig', [
            'atsiliepimai' => $atsiliepimai,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="atsiliepimai_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Atsiliepimai $atsiliepimai): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="STUDENTAS"){
            return $this->redirectToRoute('main');
        }
        if ($this->isCsrfTokenValid('delete'.$atsiliepimai->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($atsiliepimai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('atsiliepimai_index');
    }
}
