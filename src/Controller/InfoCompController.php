<?php

namespace App\Controller;

use App\Entity\InfoComp;
use App\Form\InfoCompType;
use App\Repository\InfoCompRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/infocomp')]
class InfoCompController extends AbstractController
{
    #[Route('/', name: 'info_comp_index', methods: ['GET'])]
    public function index(InfoCompRepository $infoCompRepository): Response
    {
        return $this->render('info_comp/index.html.twig', [
            'info_comps' => $infoCompRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'info_comp_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infoComp = new InfoComp();
        $form = $this->createForm(InfoCompType::class, $infoComp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($infoComp);
            $entityManager->flush();

            return $this->redirectToRoute('info_comp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('info_comp/new.html.twig', [
            'info_comp' => $infoComp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'info_comp_show', methods: ['GET'])]
    public function show(InfoComp $infoComp): Response
    {
        return $this->render('info_comp/show.html.twig', [
            'info_comp' => $infoComp,
        ]);
    }

    #[Route('/{id}/edit', name: 'info_comp_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InfoComp $infoComp, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InfoCompType::class, $infoComp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('info_comp_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('info_comp/edit.html.twig', [
            'info_comp' => $infoComp,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'info_comp_delete', methods: ['POST'])]
    public function delete(Request $request, InfoComp $infoComp, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infoComp->getId(), $request->request->get('_token'))) {
            $entityManager->remove($infoComp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('info_comp_index', [], Response::HTTP_SEE_OTHER);
    }
}
