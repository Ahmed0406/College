<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ForumController extends Controller
{
    /**
     * @Route("/forum", name="forum")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('forum/index.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/forum/{type}", name="forum_show")
     * @param Request $request
     * @param $type
     * @return Response
     */
    public function showAction(Request $request, $type)
    {
        $user = $this->getUser();

        return $this->render('forum/show.html.twig', array(
            'user' => $user,
            'type' => $type
        ));
    }
}
