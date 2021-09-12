<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Form\LeadType;
use App\Repository\LeadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lead")
 */
class LeadController extends AbstractController
{
    /**
     * @Route("/", name="lead_index", methods={"GET"})
     */
    public function index(LeadRepository $leadRepository)
    { 
        // print_r($this->getUser()->getId());
        // exit;
        //  print_r($leadRepository->findByExampleField($this->getUser()->getId()));
        //  exit;
        return $this->render('lead/index.html.twig', [
            'leads' => $leadRepository->findLeadsWithBroadCasts($this->getUser()->getId()),
        ]);
    }

    /**
     * @Route("/new", name="lead_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lead = new Lead();
        $form = $this->createForm(LeadType::class, $lead);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lead->setCreatedBy($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lead);
            $entityManager->flush();

            return $this->redirectToRoute('lead_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lead/new.html.twig', [
            'lead' => $lead,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lead_show", methods={"GET"})
     */
    public function show(Lead $lead): Response
    {
        return $this->render('lead/show.html.twig', [
            'lead' => $lead,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lead_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lead $lead): Response
    {
        $form = $this->createForm(LeadType::class, $lead);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lead_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lead/edit.html.twig', [
            'lead' => $lead,
            'form' => $form->createView(),
        ]);
    }
}
