<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cours;
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
     * @param $niveau
     * @param $type
     * @return Response
     */
    public function detailAction($niveau, $type)
    {
        $user = $this->getUser();

        if ($user->hasRole('ROLE_ENSEIGNANT')){
            $new = true;
        }
        $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository('AppBundle:Cours')->findByNiveau($niveau, $type);

        return $this->render('SupportCours/detail.html.twig', array(
            'user' => $user,
            'cours' => $cours,
            'niveau' => $niveau,
            'type' => $type,
            'new' => $new
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

        if (!$user->hasRole('ROLE_ENSEIGNANT')){
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
