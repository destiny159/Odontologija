<?php

namespace App\Controller;

use App\Entity\Pacientai;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Eile;
use App\Form\PacientaiType;
use App\Repository\PacientaiRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pacientai")
 */
class PacientaiController extends AbstractController
{
    /**
     * @Route("/", name="pacientai_index", methods={"GET"})
     */
    public function index(PacientaiRepository $pacientaiRepository): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        return $this->render('pacientai/index.html.twig', [
            'pacientais' => $pacientaiRepository->findByStatus("NAUJAS"),
            'sutarti' => $pacientaiRepository->findByStatus("SUTARTAS"),
        ]);
    }

    /**
     * @Route("/mine", name="pacientai_index_mine", methods={"GET", "POST"})
     */
    public function myPatients(PacientaiRepository $pacientaiRepository, UserRepository $userRepository): Response
    {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entity = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($this->getUser()->getId());
        $entity->setYraNauju(0);
        $entityManager->persist($entity);
        $entityManager->flush();
        return $this->render('pacientai/myPatients.html.twig');
    }

    /**
     * @Route("/success", name="success")
     */
    public function success()
    {
        return $this->render('pacientai/success.html.twig');
    }

    /**
     * @Route("/new", name="pacientai_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pacientai = new Pacientai();
        $pacientai->setStatus("NAUJAS");
        $pacientai->setRegData(DateTime::createFromFormat('Y-m-d',date("Y-m-d")));
        $form = $this->createForm(PacientaiType::class, $pacientai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pacientai);
            $entityManager->flush();

            return $this->redirectToRoute('success');
        }

        return $this->render('pacientai/new.html.twig', [
            'pacientai' => $pacientai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pacientai_show", methods={"GET"})
     */
    public function show(Pacientai $pacientai): Response
    {
        if($pacientai->getAtsakingas() == $this->getUser() or $this->getUser()->getRole() == "SUPER")
        {
            return $this->render('pacientai/show.html.twig', [
                'pacientai' => $pacientai,
            ]);
        }
        else{
            return $this->redirectToRoute('pacientai_index');
        }
    }

    /**
     * @Route("/{id}/edit", name="pacientai_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pacientai $pacientai): Response
    {
        return $this->redirectToRoute('pacientai_index');

        $form = $this->createForm(PacientaiType::class, $pacientai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pacientai_index');
        }

        return $this->render('pacientai/edit.html.twig', [
            'pacientai' => $pacientai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pacientai_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pacientai $pacientai): Response
    {
        //if(())
        if ($this->isCsrfTokenValid('delete'.$pacientai->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($pacientai->getEiles() as $eil){
                $entityManager->remove($eil);
            }
            $entityManager->remove($pacientai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pacientai_index_mine');
    }

    /**
     * @Route("/{id}/choose", name="pacientas_choose")
     */
    public function choose(Pacientai $pacientai) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        if($pacientai->getAtsakingas() != null){
            return $this->redirectToRoute('pacientai_index');
        }
        try {

            $pacientai->setAtsakingas($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pacientai);
            $entityManager->flush();

            return $this->redirectToRoute('pacientai_index');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('pacientai_index');
        }
    }

    /**
     * @Route("/{id}/cancel", name="pacientas_cancel")
     */
    public function cancel(Pacientai $pacientai) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        if($pacientai->getAtsakingas() == null){
            return $this->redirectToRoute('pacientai_index');
        }

        if ($this->getUser()->getId() == $pacientai->getAtsakingas()->getId() or $this->getUser()->getRole()=="SUPER"){
            if ($pacientai->getEiles()->isEmpty()){
                try {
                    $pacientai->setAtsakingas(null);
                    $pacientai->setStatus("NAUJAS");
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($pacientai);
                    $entityManager->flush();

                    return $this->redirectToRoute('pacientai_index');
                }
                catch (\Exception $e) {
                    return $this->redirectToRoute('pacientai_index');
                }
            }
            else{
                $entityManager = $this->getDoctrine()->getManager();
                $pacientai->setAtsakingas($pacientai->getEiles()->first()->getUser());
                $pacientai->setStatus("NAUJAS");
                //$pacientai->removeEile($pacientai->getEiles()->first());
                $pacientai->getEiles()->first()->getUser()->setYraNauju(true);
                $entityManager->remove($pacientai->getEiles()->first());
                $entityManager->persist($pacientai);
                $entityManager->flush();

                return $this->redirectToRoute('pacientai_index');
            }

        }
        else{
            return $this->redirectToRoute('pacientai_index');
        }

    }

    /**
     * @Route("/{id}/queue", name="pacientas_queue")
     */
    public function queue(Pacientai $pacientai) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        if($pacientai->getStatus()!="NAUJAS"){
            return $this->redirectToRoute('pacientai_index');
        }
        $yra = false;
        if ($pacientai->getAtsakingas() != null and $pacientai->getAtsakingas() != $this->getUser()){
            if (!$pacientai->getEiles()->isEmpty()){
                foreach ($pacientai->getEiles() as $eil){
                    if ($eil->getUser() == $this->getUser()){
                        $yra = true;
                    }
                }
            }
            if (!$yra){
                $eile = new Eile();
                $eile->setData(DateTime::createFromFormat('Y-m-d H:i:s',date("Y-m-d H:i:s")));
                $eile->setPacientas($pacientai);
                $eile->setUser($this->getUser());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($eile);
                $entityManager->flush();

                return $this->redirectToRoute('pacientai_index');
            }
            else{
                return $this->redirectToRoute('pacientai_index');
            }

        }
        else{
            return $this->redirectToRoute('pacientai_index');
        }
    }

    /**
     * @Route("/{id}/sutartas", name="pacientas_sutartas")
     */
    public function sutartas(Pacientai $pacientai) {
        if($this->getUser()==null){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getRole()=="NAUJAS"){
            return $this->redirectToRoute('main');
        }
        if($this->getUser()->getMiestas()=="Vilnius"){
            return $this->redirectToRoute('main');
        }
        if ($pacientai->getAtsakingas() == null){
            return $this->redirectToRoute('pacientai_index');
        }
        if($pacientai->getAtsakingas() != $this->getUser()){
            return $this->redirectToRoute('pacientai_index');
        }
        try {

            $pacientai->setStatus("SUTARTAS");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pacientai);
            $entityManager->flush();

            return $this->redirectToRoute('pacientai_index_mine');
        }
        catch (\Exception $e) {
            return $this->redirectToRoute('pacientai_index');
        }
    }

}
