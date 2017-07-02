<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bulletin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BulletinController
 * @Route("/profile/bulletin")
 * @package AppBundle\Controller
 */
class BulletinController extends Controller
{
    /**
     * @Route("/", name="bulletin_index")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $bulletin = $em->getRepository(Bulletin::class)->findOneBy(array(
            'user' => $user
        ));

        return $this->render('Bulletin/index.html.twig', array(
            'user' => $user,
            'bulletin' => $bulletin
        ));
    }

}
