<?php

namespace App\Controller;

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
     * chargement de la page avec la liste de personnes
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $monEnregistrement = $doctrine->getRepository(Personne::class)->findAll();

        return $this->render('personne/index.html.twig', array('personnes'=>$monEnregistrement));
    }


    public function AddOrUpdate(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $personneRepository = $em->getRepository(Personne::class);

        // Recherche d'une personne existante en utilisant les champs Nom et Prenom
        $existingPersonne = $personneRepository->findOneBy(['Nom' => $request->get('Nom'), 'Prenom' => $request->get('Prenom')]);

        // Si une personne existante est trouvée, utilisez-la pour créer le formulaire
       if ($existingPersonne) {
            $personne = $existingPersonne;
            $form = $this->createForm(PersonneType::class, $personne, [
               'action' => $this->generateUrl('personne_update', ['Nom' => $personne->getNom(), 'Prenom' => $personne->getPrenom()]),
               'method' => 'GET',
               'existingPersonne' => $existingPersonne,
           ]);
        // Sinon une personne n'existante pas, créer un formulaire vide
        }  else {
            // Sinon, créez une nouvelle instance de la classe Personne
            $personne = new Personne();
            $form = $this->createForm(PersonneType::class, $personne, [
               'action' => $this->generateUrl('personne_add'),
               'method' => 'GET',
               'existingPersonne' => $existingPersonne, ]);
        }

       // test des champs valide et non vide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // persistance des données
            $personneRepository->addOrUpdate($personne, true);
            return $this->redirectToRoute('personne_index');
        }
        return $this->renderForm('personne/from_view/index.html.twig', ['form'=>$form,'isEdit' => $existingPersonne === null,]);
    }


}
