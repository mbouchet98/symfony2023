<?php

namespace App\Controller;

use App\Controller\Form\FormPersonne;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;

class PersonneController extends AbstractController
{

    public function formAction(Request $request)
    {
        $form = $this->createForm(FormPersonne::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->get('session')->set('data', $data);
            return $this->redirectToRoute('index.html.twig');
        }

        return $this->render('form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/personne", name="app_personne")
     * chargement de la page avec la liste de personnes
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $monEnregistrement = $doctrine->getRepository(Personne::class)->findAll();

        return $this->render('personne/index.html.twig', array('personnes'=>$monEnregistrement));
    }
}
