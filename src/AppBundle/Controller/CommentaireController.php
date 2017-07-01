<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Commentaire;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Commentaire controller.
 *
 * @Route("commentaire")
 */
class CommentaireController extends Controller
{
    /**
     *
     * @Route(name="commentaire_index")
     * @Method("GET")
     * @param Request $request
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request,Article $article)
    {
        $em = $this->getDoctrine()->getManager();

        $commentaires = $em->getRepository('AppBundle:Commentaire')->findByArticle($article);

        /**
         * @var $paginator Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $commentaires,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('commentaire/index.html.twig', array(
            'commentaires' => $result,
        ));
    }

    /**
     * Creates a new commentaire.
     *
     * @Route("/{article_id}/new", name="commentaire_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param $article_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $article_id)
    {


        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository(Article::class)->findOneBy(array(
           'id'=> $article_id
        ));

        $commentaire = new Commentaire();
        $form = $this->createForm('AppBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setUser($user);
            $commentaire->setArticle($article);

            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            } else {
                $em->persist($commentaire);
                $em->flush();

                return $this->redirectToRoute('forum_detail', array(
                    'id' => $article->getId(),
                    'type' => $article->getType()
                ));
            }
        }

        if (!$request->get('standalone')){
            throw $this->createNotFoundException('The product does not exist');
        }

        return $this->render('commentaire/new.html.twig', array(
            'commentaire' => $commentaire,
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a commentaire entity.
     *
     * @Route("/{id}", name="commentaire_show")
     * @Method("GET")
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Commentaire $commentaire)
    {
        $deleteForm = $this->createDeleteForm($commentaire);

        return $this->render('commentaire/show.html.twig', array(
            'commentaire' => $commentaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a commentaire entity.
     *
     * @param Commentaire $commentaire The commentaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commentaire $commentaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commentaire_delete', array('id' => $commentaire->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing commentaire entity.
     *
     * @Route("/{id}/edit", name="commentaire_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Commentaire $commentaire)
    {
        $deleteForm = $this->createDeleteForm($commentaire);
        $editForm = $this->createForm('AppBundle\Form\CommentaireType', $commentaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commentaire_edit', array('id' => $commentaire->getId()));
        }

        return $this->render('commentaire/edit.html.twig', array(
            'commentaire' => $commentaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a commentaire entity.
     *
     * @Route("/{id}", name="commentaire_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Commentaire $commentaire
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Commentaire $commentaire)
    {
        $form = $this->createDeleteForm($commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire);
            $em->flush();
        }

        return $this->redirectToRoute('commentaire_index');
    }
}
