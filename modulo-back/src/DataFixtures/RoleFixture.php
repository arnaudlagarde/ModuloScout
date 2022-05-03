<?php

namespace App\DataFixtures;

use App\Entity\AgeSection;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use LogicException;

class RoleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rolesData = [
            [
                'name' => 'Délégué territorial',
                'feminineName' => 'Déléguée territoriale',
                'code' => 'DT',
            ],
            [
                'name' => 'Responsable du pôle Pédagogie',
                'code' => 'RPP',
            ],
            [
                'name' => 'Responsable du pôle Administration et finances',
                'code' => 'RPAF',
            ],
            [
                'name' => 'Cleophas territorial',
                'feminineName' => 'Cleophas territoriale',
                'code' => 'Cleo-T',
            ],
            [
                'name' => 'Secrétaire territorial',
                'feminineName' => 'Secrétaire territoriale',
                'code' => 'Sec-T',
            ],
            [
                'name' => 'Trésorier territorial',
                'feminineName' => 'Trésorière territoriale',
                'code' => 'Treso-T',
            ],
            [
                'name' => 'Aumônier territorial',
                'code' => 'Aum-T',
            ],
            [
                'name' => 'Accompagnateur pédagogique Farfadets',
                'feminineName' => 'Accompagnatrice pédagogique Farfadets',
                'code' => 'AP',
                'ageSection' => 'FA',
            ],
            [
                'name' => 'Accompagnateur pédagogique Louveteaux Jeannettes',
                'feminineName' => 'Accompagnatrice pédagogique Louveteaux Jeannettes',
                'code' => 'AP',
                'ageSection' => 'LJ',
            ],
            [
                'name' => 'Accompagnateur pédagogique Scouts Guides',
                'feminineName' => 'Accompagnatrice pédagogique Scouts Guides',
                'code' => 'AP',
                'ageSection' => 'SG',
            ],
            [
                'name' => 'Accompagnateur pédagogique Pionniers Caravelles',
                'feminineName' => 'Accompagnatrice pédagogique Pionniers Caravelles',
                'code' => 'AP',
                'ageSection' => 'PioK',
            ],
            [
                'name' => 'Accompagnateur pédagogique Compagnons',
                'feminineName' => 'Accompagnatrice pédagogique Compagnons',
                'code' => 'AP',
                'ageSection' => 'Comp.',
            ],
            [
                'name' => 'Chargé de mission territorial',
                'feminineName' => 'Chargée de mission territoriale',
                'code' => 'CDM-T',
            ],
            [
                'name' => 'Responsable de Groupe',
                'code' => 'RG',
            ],
            [
                'name' => 'Responsable de Groupe Adjoint',
                'feminineName' => 'Responsable de Groupe Adjointe',
                'code' => 'RGA',
            ],
            [
                'name' => 'Secrétaire de Groupe',
                'code' => 'Sec',
            ],
            [
                'name' => 'Trésorier de Groupe',
                'feminineName' => 'Trésorière de Groupe',
                'code' => 'Treso',
            ],
            [
                'name' => 'Animateur Cléophas',
                'feminineName' => 'Animatrice Cléophas',
                'code' => 'Cleo',
            ],
            [
                'name' => 'Aumônier de Groupe',
                'code' => 'Aum',
            ],
            [
                'name' => 'Responsable Audace',
                'code' => 'C',
                'ageSection' => 'Aud.',
            ],
            [
                'name' => 'Parent animateur Farfadets',
                'code' => 'PAF',
                'ageSection' => 'FA',
            ],
            [
                'name' => 'Responsable Farfadets',
                'code' => 'RF',
                'ageSection' => 'FA',
            ],
            [
                'name' => 'Responsable d\'unité Louveteaux Jeannettes',
                'code' => 'C',
                'ageSection' => 'LJ',
            ],
            [
                'name' => 'Responsable d\'unité Scouts Guides',
                'code' => 'C',
                'ageSection' => 'SG',
            ],
            [
                'name' => 'Responsable d\'unité Pionniers Caravelles',
                'code' => 'C',
                'ageSection' => 'PioK',
            ],
            [
                'name' => 'Accompagnateur Compagnons',
                'feminineName' => 'Accompagnatrice Compagnons',
                'code' => 'ACCOCO',
                'ageSection' => 'Comp.',
            ],
            [
                'name' => 'Chargé de mission groupe',
                'feminineName' => 'Chargée de mission groupe',
                'code' => 'CDM',
            ],
            [
                'name' => 'Référent technique marin',
                'feminineName' => 'Référente technique marin',
                'code' => 'RTM',
            ],
            [
                'name' => 'Membre du réseau Impeesa',
                'code' => 'Impeesa',
            ],
        ];

        foreach ($rolesData as $row) {
            $section = $row['ageSection'] ?? false;
            $ageSectionRef = $section ? sprintf('age-section-%s', $section) : AgeSectionFixture::SUPPORT_ROLE_REF;
            $ageSection = $this->getReference($ageSectionRef);
            if (!$ageSection instanceof AgeSection) {
                throw new LogicException('Invalid reference to age section');
            }
            $role = new Role($row['name'], $row['code'], $ageSection, $row['feminineName'] ?? null);
            $manager->persist($role);

            $this->addReference(sprintf('role-%s-%s', $row['code'], $row['ageSection'] ?? ''), $role);
        }

        $manager->flush();
    }
}
