<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmploiTemps;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class EmploiTempsController
 * @Route("/profile/emploi_temps")
 * @package AppBundle\Controller
 */
class EmploiTempsController extends Controller
{
    /**
     * @Route("/", name="emploi_temps_index")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $view = null;
        if ($user->hasRole('ROLE_ELEVE') && $user->hasRole('ROLE_USER')) {
            $view = 'profile/message_eleve.html.twig';
        } elseif ($user->hasRole('ROLE_ENSEIGNANT') && $user->hasRole('ROLE_USER')) {
            $view = 'profile/message_enseignant.html.twig';
        } elseif ($user->hasRole('ROLE_ADMIN')) {
            $this->redirectToRoute('sonata_admin_redirect');
        } else {
            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getManager();

        $emploi = $em->getRepository(EmploiTemps::class)->findOneBy(array(
            'user' => $user
        ));

        return $this->render('EmploiTemps/index.html.twig', array(
            'user' => $user,
            'emploi' => $emploi,
            'view' => $view
        ));
    }
}
