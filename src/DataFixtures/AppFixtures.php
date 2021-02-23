<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Casting;
use joshtronic\LoremIpsum;
use App\Repository\MovieRepository;
use App\Repository\PersonRepository;
use App\Repository\CastingRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $lipsum = new LoremIpsum();

        // Creation des genres
        for ($i = 0; $i < 20; $i++) {
            $genre = new Genre();

            $genre->setName($lipsum->words(rand(1, 2)));

            $manager->persist($genre);
        }
        $manager->flush();

        // Creation de nouvelles personnes
        for ($i = 0; $i < 1000; $i++) {
            $person = new Person();

            $person->setFirstName($lipsum->words(rand(1, 2)))
                ->setLastName($lipsum->words(rand(1, 2)));

            $manager->persist($person);
        }
        $manager->flush();

        // Creation de nouveaux films
        for ($i = 0; $i < 100; $i++) {
            $movie = new Movie();
            $movie->setTitle($lipsum->words(rand(1, 5)))
                ->setReleaseDate(new \DateTime('@' . rand(-1383899604, 1614093996)));

            // On lui rajoute quelques genres
            // for ($j = 0; $j < rand(1, 5); $j++) {
            //     // Selection d'un genre au hasard
            //     $genre = $manager->getRepository(Genre::class)->find(rand(1, 20));
            //     dd($genre);
            //     $movie->addGenre($genre);
            // }

            // Pour chaque film, on va generer des roles
            for ($j = 0; $j < rand(1, 50); $j++) {
                $casting = new Casting();

                // Tirage au hasard parmi les personnes
                $person = $manager->getRepository(Person::class)->find(rand(1, 1000));

                $casting->setMovie($movie)
                    ->setRole($lipsum->words(rand(1, 3)))
                    // ->setPerson($person)
                    ->setCreditOrder($j + 1);

                $manager->persist($casting);
            }

            $manager->persist($movie);

            $manager->flush();
        }
    }
}
