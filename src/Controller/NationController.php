<?php

namespace App\Controller;

use App\Entity\Nation;
use App\Form\NationType;
use App\Repository\NationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nation")
 */
class NationController extends AbstractController
{
    /**
     * @Route("/", name="nation_index", methods="GET")
     *
     * @param NationRepository $nationRepository
     * @return Response
     */
    public function index(NationRepository $nationRepository): Response
    {
        return $this->render('nation/index.html.twig', ['nations' => $nationRepository->findAllSort(['name' => 'ASC'])]);
    }

    /**
     * @Route("/new", name="nation_new", methods="GET|POST")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $nation = new Nation();
        $form = $this->createForm(NationType::class, $nation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nation);
            $em->flush();

            return $this->redirectToRoute('nation_index');
        }

        return $this->render('nation/new.html.twig', [
            'nation' => $nation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nation_show", methods="GET")
     *
     * @param Nation $nation
     * @return Response
     */
    public function show(Nation $nation): Response
    {
        return $this->render('nation/show.html.twig', ['nation' => $nation]);
    }

    /**
     * @Route("/{id}/edit", name="nation_edit", methods="GET|POST")
     *
     * @param Request $request
     * @param Nation $nation
     * @return Response
     */
    public function edit(Request $request, Nation $nation): Response
    {
        $form = $this->createForm(NationType::class, $nation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nation_edit', ['id' => $nation->getId()]);
        }

        return $this->render('nation/edit.html.twig', [
            'nation' => $nation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nation_delete", methods="DELETE")
     *
     * @param Request $request
     * @param Nation $nation
     * @return Response
     */
    public function delete(Request $request, Nation $nation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nation->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nation);
            $em->flush();
        }

        return $this->redirectToRoute('nation_index');
    }
}
