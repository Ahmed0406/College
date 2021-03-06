<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * LivreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LivreRepository extends EntityRepository
{
    public function findByBibliotheque($bibliotheque)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT l
                FROM AppBundle:Livre l
                WHERE l.bibliotheque = :biblio'
            )
            ->setParameter('biblio', $bibliotheque)
            ->getResult();
    }
}
