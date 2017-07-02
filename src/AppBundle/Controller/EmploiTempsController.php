<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmploiTemps;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        $em = $this->getDoctrine()->getManager();

        $bulletin = $em->getRepository(EmploiTemps::class)->findOneBy(array(
            'user' => $user
        ));

        return $this->render('EmploiTemps/index.html.twig', array(
            'user' => $user,
            'bulletin' => $bulletin
        ));
    }
}
