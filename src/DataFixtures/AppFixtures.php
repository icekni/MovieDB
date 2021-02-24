<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Review;
use App\Entity\Casting;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $genres = [];

        // Creation des genres
        for ($i = 0; $i < 20; $i++) {
            $genre = new Genre();

            $genre->setName($faker->word());

            // On stocke dans notre tableau
            $genres[] = $genre;

            $manager->persist($genre);
        }


        $persons = [];
        // Creation de nouvelles personnes
        for ($i = 0; $i < 1000; $i++) {
            $person = new Person();

            $person->setFirstName($faker->firstName())
                ->setLastName($faker->lastName());

            $persons[] = $person;

            $manager->persist($person);
        }

        // Creation de nouveaux films
        for ($i = 0; $i < 100; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->catchPhrase())
                ->setReleaseDate(new \DateTime('@' . rand(-1383899604, time())));

            // On lui rajoute quelques genres
            for ($j = 0; $j < rand(1, 3); $j++) {
                // Selection d'un genre au hasard
                $genre = $genres[rand(0, count($genres) - 1)];

                $movie->addGenre($genre);
            }

            // Pour chaque film, on va generer des roles
            for ($j = 0; $j < rand(1, 50); $j++) {
                $casting = new Casting();

                // Tirage au hasard parmi les personnes
                $person = $manager->getRepository(Person::class)->find(rand(1, 1000));

                $casting->setMovie($movie)
                    ->setRole($faker->jobTitle())
                    // ->setPerson($person)
                    ->setCreditOrder($j + 1)
                    // On lui assigne une personne
                    ->setPerson($persons[rand(0, count($persons) - 1)]);

                $manager->persist($casting);
            }

            // Pour chaque film, on va generer des reviews
            for ($j = 0; $j < rand(0, 30); $j++) {
                $review = new Review();

                $review->setContent($faker->realText())
                    ->setPublishedAt($faker->dateTimeBetween('-50 years'));

                $movie->addReview($review);

                $manager->persist($review);
            }

            $manager->persist($movie);
        }
        $manager->flush();
    }
}
