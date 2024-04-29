<?php

namespace App\Controller;

use App\Entity\Mentoroffers;
use App\Entity\User;

use App\Repository\MentoroffersRepository;
use App\Form\OfferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
class OfferController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/offer', name: 'offer_index')]
    public function index(MentorOffersRepository $repository)
    {
        $mentor = $this->getUser(); // Assuming getUser() returns a User object
        $offers = $repository->findOffersByMentor($mentor);

        return $this->render('offer/index.html.twig', [
            'offers' => $offers,
        ]);
    }
    #[Route('/offer/new', name: 'offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $offer = new Mentoroffers();
        $form = $this->createForm(OfferType::class, $offer,[
           
    ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($offer);
            $this->entityManager->flush();

            $this->addFlash('success', 'Offer created successfully!');

            return $this->redirectToRoute('offer_index');
        }

        return $this->render('offer/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offer/{id}', name: 'offer_show', methods: ['GET'])]
    public function show(Mentoroffers $offer): Response
    {
        return $this->render('offer/show.html.twig', [
            'offer' => $offer,
        ]);
    }

    #[Route('/offer/{id}/edit', name: 'offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mentoroffers $offer): Response
    {
        $form = $this->createForm(OfferType::class, $offer);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash('success', 'Offer updated successfully!');

            return $this->redirectToRoute('offer_index');
        }

        return $this->render('offer/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/offer/{id}', name: 'offer_delete', methods: ['DELETE'])]
    public function delete(Request $request, Mentoroffers $offer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offer->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($offer);
            $this->entityManager->flush();
            $this->addFlash('success', 'Offer deleted successfully!');
        }

        return $this->redirectToRoute('offer_index');
    }
}