<?php

namespace App\DataFixtures;

use App\Entity\Structure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use LogicException;

class StructureFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $structuresData = [
            [
                'name' => 'National',
                'code' => '000',
            ],
            [
                'name' => 'Territoire de l\'Oise',
                'code' => '100',
                'parent' => '000',
            ],
            [
                'name' => 'GROUPE DE BEAUVAIS',
                'code' => '1000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE JEANNETTES BEAUVAIS',
                'code' => '1001',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE LOUVETEAUX ST PAUL BEAUVA',
                'code' => '1002',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE GUIDES BEAUVAIS',
                'code' => '1003',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE SCOUTS BEAUVAIS',
                'code' => '1004',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES BEAUVAIS',
                'code' => '1005',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE COMPAGNONS BEAUVAIS',
                'code' => '1006',
                'parent' => '1000',
            ],
            [
                'name' => '1ERE FARFADETS BEAUVAIS',
                'code' => '1007',
                'parent' => '1000',
            ],
            [
                'name' => 'GROUPE 1ERE CREIL',
                'code' => '2000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX JEANNETTES CREIL',
                'code' => '2001',
                'parent' => '2000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES CREIL',
                'code' => '2002',
                'parent' => '2000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES CREIL',
                'code' => '2003',
                'parent' => '2000',
            ],
            [
                'name' => '1ERE COMPAGNONS CREIL',
                'code' => '2004',
                'parent' => '2000',
            ],
            [
                'name' => '2EME COMPAGNONS CREIL',
                'code' => '2005',
                'parent' => '2000',
            ],
            [
                'name' => '1ERE FARFADETS CREIL',
                'code' => '2006',
                'parent' => '2000',
            ],
            [
                'name' => 'GROUPE COMPIEGNE',
                'code' => '3000',
                'parent' => '100',
            ],
            [
                'name' => '2EME LOUVETEAUX JEANNETTES ST JACQUES COMPIEGNE',
                'code' => '3001',
                'parent' => '3000',
            ],
            [
                'name' => '2EME SCOUTS GUIDES ST NICOLAS COMPIEGNE',
                'code' => '3002',
                'parent' => '3000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES COMPIEGNE',
                'code' => '3003',
                'parent' => '3000',
            ],
            [
                'name' => '1ERE COMPAGNONS COMPIEGNE',
                'code' => '3004',
                'parent' => '3000',
            ],
            [
                'name' => '1ERE FARFADETS COMPIEGNE',
                'code' => '3005',
                'parent' => '3000',
            ],
            [
                'name' => '1ERE AUDACE COMPIEGNE',
                'code' => '3006',
                'parent' => '3000',
            ],
            [
                'name' => 'GROUPE DU NORD COMPIEGNOIS - CHOISY AU BAC',
                'code' => '4000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX JEANNETTES NORD COMPIEGNOIS CHOISY',
                'code' => '4001',
                'parent' => '4000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES NORD COMPIEGNOIS CHOISY AU BAC',
                'code' => '4002',
                'parent' => '4000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES NORD COMPIEGNOIS CHOISY',
                'code' => '4003',
                'parent' => '4000',
            ],
            [
                'name' => 'RÉSEAU IMPEESA NORD COMPIEGNOIS CHOISY AU BAC',
                'code' => '4004',
                'parent' => '4000',
            ],
            [
                'name' => '1ERE COMPAGNONS NORD COMPIEGNOIS CHOISY AU BAC',
                'code' => '4005',
                'parent' => '4000',
            ],
            [
                'name' => 'GROUPE CHAUMONT- GISORS',
                'code' => '5000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX CHAUMONT - GISORS',
                'code' => '5001',
                'parent' => '5000',
            ],
            [
                'name' => '1ERE SCOUTS CHAUMONT - GISORS',
                'code' => '5002',
                'parent' => '5000',
            ],
            [
                'name' => '1ERE PIONNIERS CHAUMONT - GISORS',
                'code' => '5003',
                'parent' => '5000',
            ],
            [
                'name' => '1ERE COMPAGNONS GISORS',
                'code' => '5004',
                'parent' => '5000',
            ],
            [
                'name' => '1ERE FARFADETS CHAUMONT - GISORS',
                'code' => '5005',
                'parent' => '5000',
            ],
            [
                'name' => 'GROUPE SENLIS',
                'code' => '6000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE JEANNETTES SENLIS',
                'code' => '6001',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE LOUVETEAUX SENLIS',
                'code' => '6002',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE GUIDES SENLIS',
                'code' => '6003',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE SCOUTS SENLIS',
                'code' => '6004',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES SENLIS',
                'code' => '6005',
                'parent' => '6000',
            ],
            [
                'name' => '2EME PIONNIERS CARAVELLES SENLIS',
                'code' => '6006',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE COMPAGNONS SENLIS',
                'code' => '6007',
                'parent' => '6000',
            ],
            [
                'name' => '2EME COMPAGNONS SENLIS',
                'code' => '6008',
                'parent' => '6000',
            ],
            [
                'name' => '3EME COMPAGNONS SENLIS',
                'code' => '6009',
                'parent' => '6000',
            ],
            [
                'name' => '1ERE FARFADETS SENLIS',
                'code' => '6010',
                'parent' => '6000',
            ],
            [
                'name' => 'RÉSEAU IMPEESA SENLIS',
                'code' => '6011',
                'parent' => '6000',
            ],
            [
                'name' => 'GROUPE CHANTILLY',
                'code' => '7000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX JEANNETTES CHANTILLY',
                'code' => '7001',
                'parent' => '7000',
            ],
            [
                'name' => '2EME LOUVETEAUX JEANNETTES CHANTILLY',
                'code' => '7002',
                'parent' => '7000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES CHANTILLY',
                'code' => '7003',
                'parent' => '7000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES CHANTILLY',
                'code' => '7004',
                'parent' => '7000',
            ],
            [
                'name' => '1ERE COMPAGNONS CHANTILLY',
                'code' => '7005',
                'parent' => '7000',
            ],
            [
                'name' => '1ERE FARFADETS CHANTILLY',
                'code' => '7006',
                'parent' => '7000',
            ],
            [
                'name' => 'RÉSEAU IMPEESA - CHANTILLY',
                'code' => '7007',
                'parent' => '7000',
            ],
            [
                'name' => 'GROUPE CLERMONT DE L\'OISE',
                'code' => '8000',
                'parent' => '100',
            ],
            [
                'name' => 'LOUVETEAUX JEANNETTES CLERMONT DE L\'OISE',
                'code' => '8001',
                'parent' => '8000',
            ],
            [
                'name' => 'SCOUTS GUIDES CLERMONT DE L\'OISE',
                'code' => '8002',
                'parent' => '8000',
            ],
            [
                'name' => 'FARFADETS CLERMONT DE L\'OISE',
                'code' => '8003',
                'parent' => '8000',
            ],
            [
                'name' => 'PIONNIERS CARAVELLES CLERMONT DE L\'OISE',
                'code' => '8004',
                'parent' => '8000',
            ],
            [
                'name' => 'GROUPE VAL D\'AUTOMNE - LA CROIX ST OUEN',
                'code' => '9000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX JEANNETTES LA CROIX ST OUEN',
                'code' => '9001',
                'parent' => '9000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES LA CROIX ST OUEN',
                'code' => '9002',
                'parent' => '9000',
            ],
            [
                'name' => '1ERE FARFADETS LA CROIX ST OUEN',
                'code' => '9003',
                'parent' => '9000',
            ],
            [
                'name' => 'GROUPE AMYOT D\'INVILLE - GRANDVILLIERS',
                'code' => '10000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX - JEANNETTES GRANDVILLIERS',
                'code' => '10001',
                'parent' => '10000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES GRANDVILLIERS',
                'code' => '10002',
                'parent' => '10000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES GRANDVILLIERS',
                'code' => '10003',
                'parent' => '10000',
            ],
            [
                'name' => '1ERE COMPAGNONS GRANDVILLIERS',
                'code' => '10004',
                'parent' => '10000',
            ],
            [
                'name' => '1ERE FARFADETS GRANDVILLIERS',
                'code' => '10005',
                'parent' => '10000',
            ],
            [
                'name' => 'GROUPE SAINT ESPRIT PAROISSE DU SERVAL',
                'code' => '11000',
                'parent' => '100',
            ],
            [
                'name' => '1ERE LOUVETEAUX JEANNETTES DU SERVAL',
                'code' => '11001',
                'parent' => '11000',
            ],
            [
                'name' => '1ERE SCOUTS GUIDES DU SERVAL',
                'code' => '11002',
                'parent' => '11000',
            ],
            [
                'name' => '1ERE PIONNIERS CARAVELLES DU SERVAL',
                'code' => '11003',
                'parent' => '11000',
            ],
            [
                'name' => '1ERE FARFADETS DU SERVAL',
                'code' => '11004',
                'parent' => '11000',
            ],
        ];

        $structures = [];
        foreach ($structuresData as $row) {
            if (array_key_exists('parent', $row)) {
                $parent = $structures[$row['parent']] ?? null;
                if (null === $parent) {
                    throw new LogicException(sprintf('Unable to find structure with code %s', $row['parent']));
                }
            } else {
                $parent = null;
            }
            $structure = new Structure($row['name'], $row['code'], $parent);
            $manager->persist($structure);
            $structures[$row['code']] = $structure;
            $this->addReference(sprintf('structure-%s', $row['code']), $structure);
        }

        $manager->flush();
    }
}
