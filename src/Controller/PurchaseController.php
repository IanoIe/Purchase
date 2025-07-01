<?php

namespace App\Controller;

use App\Entity\Purchase;
use App\Form\PurchaseTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PurchaseController extends AbstractController
{
    #[Route('/purchase', name: 'app_purchase')]
    public function index(): Response
    {
        return $this->render('purchase/index.html.twig', [
            'controller_name' => 'PurchaseController',
        ]);
    }

    #[Route('/purchase/{id}', name: 'purchase_show', methods: ['GET'])]
    public function show(Purchase $purchase): Response
    {
        return $this->render('purchase/show.html.twig', [
            'purchase' => $purchase,
        ]);
    }

    #[Route('/purchase/{id}/edit', name: 'purchase_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Purchase $purchase, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PurchaseTypeForm::class, $purchase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Purchase updated successfully.');

            return $this->redirectToRoute('app_purchase');
        }

        return $this->render('purchase/edit.html.twig', [
            'purchase' => $purchase,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/purchase/{id}', name: 'purchase_delete', methods: ['POST'])]
    public function delete(Request $request, Purchase $purchase, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$purchase->getId(), $request->request->get('_token'))) {
            $em->remove($purchase);
            $em->flush();

            $this->addFlash('success', 'Purchase deleted successfully.');
        }

        return $this->redirectToRoute('app_purchase');
    }
}
