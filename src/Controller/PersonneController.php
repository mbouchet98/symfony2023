<?php

namespace App\Controller;

use App\Controller\Form\FormPersonne;
use App\Entity\Personne;
use App\Form\PersonneType;
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

    /**
     *
     * chargement de la page avec la liste de personnes
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $monEnregistrement = $doctrine->getRepository(Personne::class)->findAll();

        return $this->render('personne/index.html.twig', array('personnes'=>$monEnregistrement));
    }


    public function AddOrUpdate(Request $request): Response
    {
        $personne = new Personne('test','test');
        $form = $this->createForm(PersonneType::class, $personne);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $personne = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('personne_index');
        }


        return $this->renderForm('personne/from_view/index.html.twig', ['form'=>$form]);
    }


}
