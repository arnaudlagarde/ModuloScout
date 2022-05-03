<?php

namespace App\DataFixtures;

use App\Entity\AgeSection;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AgeSectionFixture extends Fixture
{
    const SUPPORT_ROLE_REF = 'age-section-Support';

    public function load(ObjectManager $manager): void
    {
        $ageSectionsData = [
            [
                'name' => 'Farfadets',
                'code' => 'FA',
                'color' => '#3CBE8C',
            ],
            [
                'name' => 'Louveteaux Jeannettes',
                'code' => 'LJ',
                'color' => '#E77A3D',
            ],
            [
                'name' => 'Scouts Guides',
                'code' => 'SG',
                'color' => '#2851A3',
            ],
            [
                'name' => 'Pionniers Caravelles',
                'code' => 'PioK',
                'color' => '#CA3534',
            ],
            [
                'name' => 'Compagnons',
                'code' => 'Comp.',
                'color' => '#1B664E',
            ],
            [
                'name' => 'Audace',
                'code' => 'Aud.',
                'color' => '#F609EF',
            ],
            [
                'name' => 'Fonction support',
                'code' => 'Sup.',
                'color' => '#39336D',
                'ref' => self::SUPPORT_ROLE_REF,
            ],
        ];

        foreach ($ageSectionsData as $row) {
            $ageSection = new AgeSection($row['name'], $row['code'], $row['color']);
            $manager->persist($ageSection);
            $this->addReference($row['ref'] ?? sprintf('age-section-%s', $row['code']), $ageSection);
        }

        $manager->flush();
    }
}
