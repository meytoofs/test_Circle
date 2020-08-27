<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\JsonManifestVersionStrategy;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
* @Route("/mylevel")
*/
class MyLevelController extends AbstractController
{
    /**
     * @Route("/", name="my_level")
     */
    public function index()
    {
        // $response = new Response(file_get_contents('/assets/levels/1-1.json'));
        // $response->headers->set('Content-Type', 'application/json');
        // echo $response;
        return $this->render('my_level/index.html.twig', [
            'controller_name' => 'MyLevelController',
        ]);
    }
}
