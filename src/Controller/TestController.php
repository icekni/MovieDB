<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test/movie/add", name="test_movie_add")
     */
    public function movieAdd(): Response
    {
        // On commence par créer une nouvelle entité
        $movie = new Movie();

        // On lui renseigne ses infos
        $movie->setTitle('Le 6eme element');
        $movie->setReleaseDate(new \DateTime('2001-01-25'));
        $movie->setCreatedAt(new \DateTime());

        dump($movie);

        // On fait appel au manager d'entité de Doctrine
        $entityManager = $this->getDoctrine()->getManager();

        // On demande a notre manager de se preparer a ajouter notre objet en bdd
        $entityManager->persist($movie);

        // On demande au manager de sauvegarder en bdd
        $entityManager->flush();

        dump($movie);


        return new Response('Bravo, votre film à été ajouté</body>');
    }

    /**
     * @Route("/test/movie/list", name="test_movie_list")
     */
    public function movieList()
    {
        // On commence par acceder au repository de l'entité Movie
        $movieRepository = $this->getDoctrine()->getRepository(Movie::class);

        // On fait appel a a la methode findAll du repository
        $movies = $movieRepository->findAll();

        dump($movies);

        return $this->render('test/list.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/test/movie/edit/{movieId}", name="test_movie_edit")
     */
    public function editMovie($movieId)
    {
        $this->getDoctrine()
            // On créé un repo
            ->getRepository(Movie::class)
            // On va chercher le bon film
            ->find($movieId)
            // On modifie
            ->setUpdatedAt(new \DateTime());

        // On envoie en bdd sans persist car movie existe deja en bdd
        $this->getDoctrine()
            ->getManager()
            ->flush();

        return $this->redirectToRoute('test_movie_list');
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(PersonRepository $personRepository)
    {
        $person = $personRepository->find(rand(1, 1000));

        dd($person);
    }
}
