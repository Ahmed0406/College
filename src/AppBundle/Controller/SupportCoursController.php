<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cours;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class SupportCoursController
 * @Route("/support_cours")
 * @package AppBundle\Controller
 */
class SupportCoursController extends Controller
{
    /**
     * @Route("/", name="support_cours_index")
     * @return Response
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('SupportCours/index.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/{niveau}", name="support_cours_show")
     * @param $niveau
     * @return Response
     */
    public function showAction($niveau)
    {
        $user = $this->getUser();
        return $this->render('SupportCours/show.html.twig', array(
            'user' => $user,
            'niveau' => $niveau,
        ));
    }

    /**
     * @Route("/{niveau}/{type}", name="support_cours_detail")
     * @param Request $request
     * @param $niveau
     * @param $type
     * @return Response
     */
    public function detailAction(Request $request, $niveau, $type)
    {
        $user = $this->getUser();

        $verif = null;
        if ($user) {
            if ($user->hasRole('ROLE_ENSEIGNANT')) {
                $verif = 'afficher';
            }
        }

        $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository('AppBundle:Cours')->findByNiveau($niveau, $type);

        /**
         * @var $paginator Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            array_reverse($cours),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('SupportCours/detail.html.twig', array(
            'user' => $user,
            'cours' => $result,
            'niveau' => $niveau,
            'type' => $type,
            'verif' => $verif
        ));
    }

    /**
     * Creates a new cour entity.
     *
     * @Route("/{niveau}/{type}/new", name="support_cours_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $niveau
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function newAction(Request $request, $niveau, $type)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        if (!$user->hasRole('ROLE_ENSEIGNANT')) {
            throw $this->createNotFoundException('The product does not exist');
        }

        $cour = new Cours();
        $form = $this->createForm('AppBundle\Form\CoursType', $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $cour->setNiveau($niveau);
            $cour->setType($type);
            $em->persist($cour);
            $em->flush();

            return $this->redirectToRoute('support_cours_detail', array(
                'niveau' => $niveau,
                'type' => $type
            ));
        }

        return $this->render('SupportCours/new.html.twig', array(
            'user' => $user,
            'cour' => $cour,
            'form' => $form->createView(),
        ));
    }
}
