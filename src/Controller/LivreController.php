<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class LivreController extends AbstractController
{

    public function index(ManagerRegistry $doctrine): Response
    {
        $monEnregistrement = $doctrine->getRepository(Livre::class)->findAll();

        return $this->render('livre/index.html.twig', array('livres'=>$monEnregistrement));
    }

    public function AddOrUpdate(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $livreRepository = $em->getRepository(Livre::class);

        // Recherche d'une personne existante en utilisant les champs Nom et Prenom
        $existingLivre = $livreRepository->findOneBy(['nomLivre' => $request->get('nomLivre'), 'resumerLivre' => $request->get('resumerLivre')]);

        // Si une personne existante est trouvée, utilisez-la pour créer le formulaire
        if ($existingLivre) {
            $livre = $existingLivre;
            $form = $this->createForm(LivreType::class, $livre, [
                'action' => $this->generateUrl('livre_update', ['nomLivre' => $livre->getNomLivre(), 'resumerLivre' => $livre->getResumerLivre()]),
                'method' => 'GET',
                'existingLivre' => $existingLivre,

            ]);
            // Sinon une personne n'existante pas, créer un formulaire vide
        }  else {
            // Sinon, créez une nouvelle instance de la classe Personne
            $livre = new Livre();
            $form = $this->createForm(LivreType::class, $livre, [
                'action' => $this->generateUrl('livre_add'),
                'method' => 'GET',
                'existingLivre' => $existingLivre,

            ]);
        }

        // test des champs valide et non vide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // persistance des données
            $existingLivre->addOrUpdate($livre, true);
            return $this->redirectToRoute('livre_index');
        }
        return $this->renderForm('livre/from_view/index.html.twig', ['form'=>$form,'isEdit' => $existingLivre === null]);
    }

    public function delete(Request $request,Livre $livre): Response
    {

        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $livreRepository = $entityManager->getRepository(Livre::class);
            $livreRepository->remove($livre,true);
            return $this->redirectToRoute('livre_index');
        }

        return $this->redirectToRoute('livre_index');
    }
}
