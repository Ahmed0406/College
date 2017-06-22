<?php

namespace AppBundle\Controller;

use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $actualite = $em->getRepository('AppBundle:Actualite')->findAll();

        /**
         * @var $paginator Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            array_reverse($actualite),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );


        return $this->render('default/index.html.twig',array(
            'user' => $user,
            'actualite' => $result,
        ));
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:contact.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/presentation", name="presentation")
     * @param Request $request
     * @return Response
     */
    public function presentationAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:presentation.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/enseignant", name="enseignant")
     * @param Request $request
     * @return Response
     */
    public function enseignantAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:enseignant.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/galerie_photos", name="galerie_photos")
     * @param Request $request
     * @return Response
     */
    public function galerie_photosAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:galerie_photos.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/dep_informatique", name="dep_informatique")
     * @param Request $request
     * @return Response
     */
    public function dép_informatiqueAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:dep_informatique.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/dep_physique", name="dep_physique")
     * @param Request $request
     * @return Response
     */
    public function dép_physiqueAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:dep_physique.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/for_informatique", name="for_informatique")
     * @param Request $request
     * @return Response
     */
    public function for_informatiqueAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:for_informatique.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/for_lettre", name="for_lettre")
     * @param Request $request
     * @return Response
     */
    public function for_lettreAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:for_lettre.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/for_mathematique", name="for_mathematique")
     * @param Request $request
     * @return Response
     */
    public function for_mathématiqueAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:for_mathematique.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/for_science", name="for_science")
     * @param Request $request
     * @return Response
     */
    public function for_scienceAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:for_science.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/for_economie_gestion", name="for_economie_gestion")
     * @param Request $request
     * @return Response
     */
    public function for_economie_gestionAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:for_economie_gestion.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/clubs", name="clubs")
     * @param Request $request
     * @return Response
     */
    public function clubsAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:clubs.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/manifestation", name="manifestation")
     * @param Request $request
     * @return Response
     */
    public function manifestationAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:manifestation.html.twig', array(
            'user' => $user,
        ));
    }



    /**
     * @Route("/planning", name="planning")
     * @param Request $request
     * @return Response
     */
    public function planningAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render(':default:planning.html.twig', array(
            'user' => $user,
        ));
    }
}
