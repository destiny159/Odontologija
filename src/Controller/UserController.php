<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/nepatvirtinti", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
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
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findByRole("NAUJAS"),
        ]);

    }

    /**
 * @Route("/patvirtinti", name="user_patvirtinti", methods={"GET"})
 */
    public function indexPatvirtinti(UserRepository $userRepository): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        return $this->render('user/indexPatvirtinti.html.twig', [
            'users' => $userRepository->findByRole("STUDENTAS"),
        ]);
    }

    /**
     * @Route("/adminai", name="user_adminai", methods={"GET"})
     */
    public function indexAdminai(UserRepository $userRepository): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        return $this->render('user/indexAdminai.html.twig', [
            'users' => $userRepository->findByRole("ADMIN"),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/{id}/approve", name="user_approve")
     */
    public function approve(User $user) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="STUDENTAS"){
            return $this->redirectToRoute('main');
        }

        try {

            $user->setRole("STUDENTAS");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_index');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('user_index');
        }
    }

    /**
     * @Route("/{id}/makeadm", name="user_make_admin")
     */
    public function makeAdmin(User $user) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }

        try {

            $user->setRole("ADMIN");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_patvirtinti');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('user_patvirtinti');
        }
    }

    /**
     * @Route("/{id}/demote", name="user_demote")
     */
    public function demote(User $user) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }

        try {

            $user->setRole("STUDENTAS");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_adminai');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('user_adminai');
        }
    }

    /**
     * @Route("/{id}/makenew", name="user_make_new")
     */
    public function makeNew(User $user) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()!="SUPER"){
            return $this->redirectToRoute('main');
        }

        try {

            $user->setRole("NAUJAS");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('user_patvirtinti');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('user_patvirtinti');
        }
    }
}
