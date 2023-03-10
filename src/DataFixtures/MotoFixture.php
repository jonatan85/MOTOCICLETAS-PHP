<?php

namespace App\DataFixtures;

use App\Entity\Moto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MotoFixture extends Fixture
{   
    // Para crear datos faker, instalar fixtures. 
    public function load(ObjectManager $manager): void
    {   
      

        $faker = Factory::create();
        for ($i=0; $i <= 100; $i++){
            $moto = new Moto();
            $moto->setMarca($faker->word());
            $moto->setModelo($faker->word());
            $moto->setImg("https://www.motofichas.com/images/phocagallery/Honda/africa-twin-adventure-sports-2022/01-honda-africa-twin-adventure-sports-2022-estudio-blanco.jpg");
            $moto->setCv($faker->word());
            $moto->setCilindrada($faker->word());
            $moto->setColor($faker->word());
            $moto->setDescription($faker->text());
            $manager->persist($moto);
        }

        $manager->flush();
    }
}
