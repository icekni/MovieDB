<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\CastingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MovieRepository $movieRepository): Response
    {
        // On fait appel a a la methode findBy du repository pour avoir les titres par ordre alphabetique
        $movies = $movieRepository->findBy([], [
            'title' => 'ASC',
        ]);

        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/movie/{id<\d+>}", name="movie_show")
     */
    public function movieShow(Movie $movie, CastingRepository $castingRepository)
    {
        // $movie = $movieRepository->findAllInOneRQ($id);
        $casting = $castingRepository->test($movie);
        // dump($movie);
        return $this->render('main/movie_show.html.twig', [
            'movie' => $movie,
            'casting' => $casting
        ]);
    }

    /**
     * @Route("/search", name="movie_search")
     */
    public function search(MovieRepository $movieRepository, Request $request): Response
    {
        // On recupere le query en GET
        $query = $request->query->get('query');

        $movies = $movieRepository->search($query);

        return $this->render('main/home.html.twig', [
            'movies' => $movies,
        ]);
    }
}
