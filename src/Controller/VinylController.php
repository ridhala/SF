<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
    }

class VinylController extends AbstractController
{
    #[Route('/')]
    public function homepage(): Response
    {
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'PB & Jams',
        ]);
    }
    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if ($slug) {
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'All Genres';
        }
        return new Response($title);
        //return new Response('Breakup vinyl? Angsty 90s rock? Browse the collection!');
    }
}
class VinylController
{
    public function homepage()
    {
        die('Vinyl: Definitely NOT a fancy-looking frisbee!');
    }
    #[Route('/browse/{slug}')]
    public function browse(string $slug = null): Response
    {
        if ($slug) {
            $title = 'Genre: '.u(str_replace('-', ' ', $slug))->title(true);
        } else {
            $title = 'All Genres';
        }
        return new Response($title);
}
#[Route('/')]
public function homepage(): Response

use Symfony\Component\Routing\Annotation\Route;
class VinylController
{
    #[Route('/')]
    public function homepage()
    {
        die('Vinyl: Definitely NOT a fancy-looking frisbee!');
    }
}
#[Route('/browse')]
public function browse(): Response
{
    return new Response('Breakup vinyl? Angsty 90s rock? Browse the collection!');
}
}

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;




class VinylController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    function homepage(): Response
    {
        $tracks = [
            ['song' => 'Gangsta\'s Paradise', 'artist' => 'Coolio'],
            ['song' => 'Waterfalls', 'artist' => 'TLC'],
            ['song' => 'Creep', 'artist' => 'Radiohead'],
            ['song' => 'Kiss from a Rose', 'artist' => 'Seal'],
            ['song' => 'On Bended Knee', 'artist' => 'Boyz II Men'],
            ['song' => 'Fantasy', 'artist' => 'Mariah Carey'],
        ];
        return $this->render('vinyl/homepage.html.twig', [
            'title' => 'ISET Kélibia',
            'tracks' => $tracks,
        ]);
    }
    #[Route('/browse/{slug}', name: 'app_browse')]
    function browse(string $slug = null): Response
    {

        $genre = $slug ? u(str_replace("-", " ", $slug))->title(true) : null;

        return $this->render('vinyl/browse.html.twig', [
            'genre' => $genre,
        ]);
    }
}
