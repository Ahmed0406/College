<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Article controller.
 *
 * @Route("forum")
 */
class ForumController extends Controller
{
    /**
     * Lists all article entities.
     *
     * @Route("/", name="forum_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('forum/index.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Creates a new article entity.
     *
     * @Route("/{type}/new", name="forum_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $type)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $article = new Article();
        $form = $this->createForm('AppBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setType($type);
            $article->setUser($user);
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('forum_show', array('type' => $type));
        }

        return $this->render('forum/new.html.twig', array(
            'user' => $user,
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{type}", name="forum_show")
     * @Method("GET")
     * @param Request $request
     * @param $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request,$type)
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findByType($type);

        /**
         * @var $paginator Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->render('forum/show.html.twig', array(
            'user' => $user,
            'articles' => $result,
            'type' => $type
        ));
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{type}/article/{id}", name="forum_detail")
     * @Method("GET")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Article $article)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $deleteForm = $this->createDeleteForm($article);

        return $this->render('forum/detail.html.twig', array(
            'user' => $user,
            'article' => $article,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a article entity.
     *
     * @param Article $article The article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('forum_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     * @Route("/{id}/edit", name="forum_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Article $article)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('AppBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('forum_edit', array('id' => $article->getId()));
        }

        return $this->render('forum/edit.html.twig', array(
            'user' => $user,
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a article entity.
     *
     * @Route("/{id}", name="forum_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Article $article)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('forum_index', array(
            'user' => $user,
        ));
    }
}
