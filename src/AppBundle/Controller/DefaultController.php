<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', []);
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request)
    {
        return $this->render(':default:contact.html.twig', []);
    }

    /**
     * @Route("/presentation", name="presentation")
     * @param Request $request
     * @return Response
     */
    public function presentationAction(Request $request)
    {
        return $this->render(':default:presentation.html.twig', []);
    }

    /**
     * @Route("/enseignant", name="enseignant")
     * @param Request $request
     * @return Response
     */
    public function enseignantAction(Request $request)
    {
        return $this->render(':default:enseignant.html.twig', []);
    }

    /**
     * @Route("/galerie_photos", name="galerie_photos")
     * @param Request $request
     * @return Response
     */
    public function galerie_photosAction(Request $request)
    {
        return $this->render(':default:galerie_photos.html.twig', []);
    }

    /**
     * @Route("/dep_informatique", name="dep_informatique")
     * @param Request $request
     * @return Response
     */
    public function dép_informatiqueAction(Request $request)
    {
        return $this->render(':default:dép_informatique.html.twig', []);
    }

    /**
     * @Route("/dep_physique", name="dep_physique")
     * @param Request $request
     * @return Response
     */
    public function dép_physiqueAction(Request $request)
    {
        return $this->render(':default:dép_physique.html.twig', []);
    }

    /**
     * @Route("/for_informatique", name="for_informatique")
     * @param Request $request
     * @return Response
     */
    public function for_informatiqueAction(Request $request)
    {
        return $this->render(':default:for_informatique.html.twig', []);
    }

    /**
     * @Route("/for_lettre", name="for_lettre")
     * @param Request $request
     * @return Response
     */
    public function for_lettreAction(Request $request)
    {
        return $this->render(':default:for_lettre.html.twig', []);
    }

    /**
     * @Route("/for_mathematique", name="for_mathematique")
     * @param Request $request
     * @return Response
     */
    public function for_mathématiqueAction(Request $request)
    {
        return $this->render(':default:for_mathematique.html.twig', []);
    }

    /**
     * @Route("/for_science", name="for_science")
     * @param Request $request
     * @return Response
     */
    public function for_scienceAction(Request $request)
    {
        return $this->render(':default:for_science.html.twig', []);
    }

    /**
     * @Route("/for_economie_gestion", name="for_economie_gestion")
     * @param Request $request
     * @return Response
     */
    public function for_economie_gestionAction(Request $request)
    {
        return $this->render(':default:for_economie_gestion.html.twig', []);
    }

    /**
     * @Route("/clubs", name="clubs")
     * @param Request $request
     * @return Response
     */
    public function clubsAction(Request $request)
    {
        return $this->render(':default:clubs.html.twig', []);
    }

    /**
     * @Route("/manifestation", name="manifestation")
     * @param Request $request
     * @return Response
     */
    public function manifestationAction(Request $request)
    {
        return $this->render(':default:manifestation.html.twig', []);
    }

    /**
     * @Route("/forum", name="forum")
     * @param Request $request
     * @return Response
     */
    public function forumAction(Request $request)
    {
        return $this->render(':default:forum.html.twig', []);
    }

    /**
     * @Route("/planning", name="planning")
     * @param Request $request
     * @return Response
     */
    public function planningAction(Request $request)
    {
        return $this->render(':default:planning.html.twig', []);
    }

    /**
     * @Route("/bibliotheque", name="bibliotheque")
     * @param Request $request
     * @return Response
     */
    public function bibliothequeAction(Request $request)
    {
        return $this->render(':default:bibliotheque.html.twig', []);
    }
}
