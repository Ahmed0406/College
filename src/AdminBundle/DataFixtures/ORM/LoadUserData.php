<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $userManager
     */
    public function load(ObjectManager $userManager)
    {
        $userManager = $this->container->get('pugx_user_manager');

        // Create a new user
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.ad');
        $user->setPlainPassword('admin');
        $user->setNom('admin');
        $user->setEnabled(true);
        $user->setRoles(['ROLE_ADMIN','ROLE_SONATA_ADMIN']);
        $userManager->updateUser($user, true);
    }
}