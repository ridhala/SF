<?php
namespace App\Controller;
use App\Entity\VinylMix;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MixController extends AbstractController


    class MixController extends AbstractController
{
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
}

class VinylMixRepository extends ServiceEntityRepository
{
// ... lines 19 - 20
        parent::__construct($registry, VinylMix::class);
    }
    public function add(VinylMix $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
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
    public function new(): Response
    {
        $mix = new VinylMix();
        $mix->setTitle('Do you Remember... Phil Collins?!');
        $mix->setDescription('A pure mix of drummers turned singers!');
        $mix->setGenre('pop');
        $mix->setTrackCount(rand(5, 20));
        $mix->setVotes(rand(-50, 50));
        dd($mix);
    }
    public function new(EntityManagerInterface $entityManager): Response
    {

        $genres = ['pop', 'rock'];
        $mix->setGenre($genres[array_rand($genres)]);

    }
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
     /**
     * @return VinylMix[] Returns an array of VinylMix objects
     */
    
        
    
        
    public function findAllOrderedByVotes(string $genre = null): array
    {

        if ($genre) {
            $queryBuilder->andWhere('mix.genre = :genre')
                ->setParameter('genre', $genre);
        }
        class VinylMixRepository extends ServiceEntityRepository
{

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
// ... lines 63 - 64
    return $queryBuilder->orderBy('mix.votes', 'DESC');
}
//    public function findOneBySomeField($value): ?VinylMix
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
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