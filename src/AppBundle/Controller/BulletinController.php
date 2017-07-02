<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bulletin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

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
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if (!$user->hasRole('ROLE_ELEVE')) {
            throw $this->createNotFoundException('The product does not exist');
        }

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
