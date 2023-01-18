<?php

namespace App\Controller;

use App\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{

    /**
     * @Route("/personne", name="app_personne")
     */
    public function index(): Response
    {

        $person1 = new Personne("test","test2");
        $person2 = new Personne("test","test2");
        $person3 = new Personne("test","test2");

        $listePersonnes = array($person1, $person2, $person3);

        return $this->render('personne/index.html.twig', [
            'personne' => 'Personne',
            'listePersonne' => $listePersonnes,
            ]);

    }


}
