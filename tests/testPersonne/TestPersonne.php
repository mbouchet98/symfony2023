<?php


use PHPUnit\Framework\TestCase;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method getEntityManager()
 */
class TestPersonne extends TestCase
{
    private $registry;
    public function __construct(PersonneRepository $personneRepository)
    {
        $this->personneRepository = $personneRepository;
    }

    public function testAjouterPersonne()
    {
        $personne1 =  new Personne('TEST2','TEST2');
        $personnes = $this->personneRepository->ajouterPersonne($personne1);
        return $personnes;
    }
}