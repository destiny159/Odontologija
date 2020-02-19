<?php

namespace App\Controller;

use App\Entity\Klinikiniai;
use App\Form\KlinikiniaiType;
use App\Repository\KlinikiniaiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klinikiniai")
 */
class KlinikiniaiController extends AbstractController
{
    /**
     * @Route("/", name="klinikiniai_index", methods={"GET"})
     */
    public function index(KlinikiniaiRepository $klinikiniaiRepository): Response
    {
        return $this->render('klinikiniai/index.html.twig', [
            'klinikiniais' => $klinikiniaiRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="klinikiniai_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        $klinikiniai = new Klinikiniai();
        $form = $this->createForm(KlinikiniaiType::class, $klinikiniai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $klinikiniai->setAtsakingas($this->getUser());
            $klinikiniai->setMiestas($this->getUser()->getMiestas());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($klinikiniai);
            $entityManager->flush();

            return $this->redirectToRoute('klinikiniai_index');
        }

        return $this->render('klinikiniai/new.html.twig', [
            'klinikiniai' => $klinikiniai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="klinikiniai_show", methods={"GET"})
     */
    public function show(Klinikiniai $klinikiniai): Response
    {
        if(true){
            return $this->redirectToRoute('klinikiniai_index');
        }
        return $this->render('klinikiniai/show.html.twig', [
            'klinikiniai' => $klinikiniai,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="klinikiniai_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Klinikiniai $klinikiniai): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()== $klinikiniai->getAtsakingas() || $this->getUser()->getRole()=="ADMIN" || $this->getUser()->getRole()=="SUPER")
        {
            $form = $this->createForm(KlinikiniaiType::class, $klinikiniai);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('klinikiniai_index');
            }

            return $this->render('klinikiniai/edit.html.twig', [
                'klinikiniai' => $klinikiniai,
                'form' => $form->createView(),
            ]);
        }
        else{
            return $this->redirectToRoute('main');
        }

    }

    /**
     * @Route("/{id}", name="klinikiniai_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Klinikiniai $klinikiniai): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()== $klinikiniai->getAtsakingas() || $this->getUser()->getRole()=="ADMIN" || $this->getUser()->getRole()=="SUPER")
        {
            if ($this->isCsrfTokenValid('delete'.$klinikiniai->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($klinikiniai);
                $entityManager->flush();
            }

            return $this->redirectToRoute('klinikiniai_index');
        }
        else{
            return $this->redirectToRoute('main');
        }

    }
}
