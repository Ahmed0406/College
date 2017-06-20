<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Bibliotheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Bibliotheque controller.
 *
 * @Route("bibliotheque")
 */
class BibliothequeController extends Controller
{
    /**
     * Lists all bibliotheque entities.
     *
     * @Route("/", name="bibliotheque")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $bibliotheques = $em->getRepository('AppBundle:Bibliotheque')->findAll();

        return $this->render('bibliotheque/index.html.twig', array(
            'user' => $user,
            'bibliotheques' => $bibliotheques,
        ));
    }

    /**
     * Finds and displays a bibliotheque entity.
     *
     * @Route("/{nom_biblio}/{id}", name="bibliotheque_show")
     * @Method("GET")
     * @param Bibliotheque $bibliotheque
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Bibliotheque $bibliotheque, $nom_biblio)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $livres = null;
        if ($bibliotheque->getNom() == $nom_biblio) {
            $livres = $em->getRepository('AppBundle:Livre')->findByBibliotheque($bibliotheque);
        }

        return $this->render('bibliotheque/show.html.twig', array(
            'user' => $user,
            'livres' => $livres,
            'nom_biblio' => $nom_biblio
        ));
    }
}
