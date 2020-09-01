<?php

namespace App\Controller;

use App\Entity\Level;
use App\Form\VoteType;
use App\Form\LevelType;
use App\Data\SearchData;
use App\Entity\NoteHistory;
use App\Form\SearchDataType;
use App\Repository\LevelRepository;
use App\Repository\NoteHistoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/level")
 */
class LevelController extends AbstractController
{
    /**
     * @Route("/", name="level_index", methods={"GET"})
     */
    public function index(Request $request, LevelRepository $repository): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchDataType::class, $data);
        $form-> handleRequest($request);
        [$min, $max] = $repository->findMinMax($data);
        $level = $repository->findSearch($data);
        $levels = $this->getDoctrine()->getRepository(Level::class)->findAll();
        return $this->render('level/index.html.twig', [
            'level' => $levels,
            'level' => $level,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max,
            
        ]);
    }

    // /**
    //  * @Route("/new", name="level_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $level = new Level();
    //     $form = $this->createForm(LevelType::class, $level);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($level);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('level_index');
    //     }

    //     return $this->render('level/new.html.twig', [
    //         'level' => $level,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/{id}", name="level_show", methods={"GET", "POST"})
     */
    public function show(Request $request, Level $level, NoteHistoryRepository $repository): Response
    {
        $id = $level->getId();
        $total_score = $repository->getAVG($id);
        $note = new NoteHistory();
        $note->setLevelId($level);
        $form = $this->createForm(VoteType::class, $note, [
            // 'id' => $id,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($note);
            $entityManager->flush();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('level_show', ['id' => $id]);
        }
        return $this->render('level/show.html.twig', [
            'level' => $level,
            'form' => $form->createView(),
            'total_score' => $total_score,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="level_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Level $level): Response
    {
        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('level_index');
        }

        return $this->render('level/edit.html.twig', [
            'level' => $level,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="level_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Level $level): Response
    {
        if ($this->isCsrfTokenValid('delete'.$level->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($level);
            $entityManager->flush();
        }

        return $this->redirectToRoute('level_index');
    }
}
