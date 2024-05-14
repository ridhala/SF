<?php

namespace App\Controller;
use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class MixController extends AbstractController
  
{
    #[Route('/mix/new')]
    #[Route('/mix/new')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');
        $genres = ['pop', 'rock'];
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        $entityManager->persist($mix);
        $entityManager->flush();
        return new Response(sprintf(
            'Mix %d is %d tracks of pure 80\'s heaven',
            $mix->getId(),
            $mix->getTrackCount()
        ));
    }

   


    #[Route('/mix/{id}/vote', name: 'app_mix_vote', methods: ['POST'])]
    public function vote(VinylMix $mix, Request $request, EntityManagerInterface $entityManager): Response
    {
        $direction = $request->request->get('direction', 'up');
        if ($direction === 'up') {
            $mix->setVotes($mix->getVotes() + 1);
        } else {
            $mix->setVotes($mix->getVotes() - 1);
        }
        $entityManager->flush();
        return $this->redirectToRoute('app_mix_show', [
            'id' => $mix->getId(),
        ]);
    }
}
    }
      
    }
    #[Route('/mix/{id}', name: 'app_mix_show')]
    public function show($id, VinylMixRepository $mixRepository): Response
    {
        $mix = $mixRepository->find($id);
        if (!$mix) {
            throw $this->createNotFoundException('Mix not found');
        }
        return $this->render('mix/show.html.twig', [
            'mix' => $mix,
        ]);
    }
}

class VinylMixRepository extends ServiceEntityRepository
{

        parent::__construct($registry, VinylMix::class);
    }
    public function add(VinylMix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
        dd($mix);
    }
        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');
        $genres = ['pop', 'rock'];
        $mix->setGenre($genres[array_rand($genres)]);
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        $entityManager->persist($mix);
        $entityManager->flush();
        return new Response(sprintf(
            'Mix %d is %d tracks of pure 80\'s heaven',
            $mix->getId(),
            $mix->getTrackCount()
        ));
    }
    
    }

    public function remove(VinylMix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    * @return VinylMix[] Returns an array of VinylMix objects
    */
   public function findAllOrderedByVotes(): array
   {
       return $this->createQueryBuilder('mix')
           ->orderBy('mix.votes', 'DESC')
           ->getQuery()
           ->getResult()
       ;
   }
   public function new(EntityManagerInterface $entityManager): Response
   {
       $mix = new VinylMix();
       $mix->setTitle('Do you Remember... Phil Collins?!');
       $mix->setDescription('A pure mix of drummers turned singers!');
       $genres = ['pop', 'rock'];
       $mix->setGenre($genres[array_rand($genres)]);
       $mix->setTrackCount(rand(5, 20));
       $mix->setVotes(rand(-50, 50));
       $entityManager->persist($mix);
       $entityManager->flush();
       return new Response(sprintf(
           'Mix %d is %d tracks of pure 80\'s heaven',
           $mix->getId(),
           $mix->getTrackCount()
       ));
   }
   #[Route('/mix/{id}', name: 'app_mix_show')]
    
}
class VinylMixRepository extends ServiceEntityRepository
{
     /**
     * @return VinylMix[] Returns an array of VinylMix objects
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     
    
    

    private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {

    }
}
/**
 * @return VinylMix[] Returns an array of VinylMix objects
 */
public function findAllOrderedByVotes(string $genre = null): array
{
    $queryBuilder = $this->addOrderByVotesQueryBuilder();
    if ($genre) {
        $queryBuilder->andWhere('mix.genre = :genre')
            ->setParameter('genre', $genre);
    }
    return $queryBuilder
        ->getQuery()
        ->getResult()
    ;
}
private function addOrderByVotesQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
{

    return $queryBuilder->orderBy('mix.votes', 'DESC');
}
  public function findOneBySomeField($value): ?VinylMix
   {
        return $this->createQueryBuilder('v')
          ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
    }
    #[Route('/browse/{slug}', name: 'app_browse')]
    public function browse(VinylMixRepository $mixRepository, string $slug = null): Response
    {
        $genre = $slug ? u(str_replace('-', ' ', $slug))->title(true) : null;
        $mixes = $mixRepository->findAll();
        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
            'mixes' => $mixes,
        ]);
    }
}