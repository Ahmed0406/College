<?php

namespace AppBundle\Controller;

use FOS\MessageBundle\Controller\MessageController as BaseMessageController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends BaseMessageController
{
    /**
     *
     * @return Response
     */
    public function inboxAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message_view = $this->verifierView($user);

        $threads = $this->getProvider()->getInboxThreads();

        return $this->container->get('templating')->renderResponse(':Message:inbox.html.twig', array(
            'threads' => $threads,
            'user' => $user,
            'message_view' => $message_view,
        ));
    }

    /**
     *
     * @return Response
     */
    public function sentAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message_view = $this->verifierView($user);
        $threads = $this->getProvider()->getSentThreads();

        return $this->container->get('templating')->renderResponse(':Message:sent.html.twig', array(
            'threads' => $threads,
            'user' => $user,
            'message_view' => $message_view,
        ));
    }

    /**
     *
     * @return Response
     */
    public function deletedAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message_view = $this->verifierView($user);
        $threads = $this->getProvider()->getDeletedThreads();

        return $this->container->get('templating')->renderResponse(':Message:deleted.html.twig', array(
            'threads' => $threads,
            'user' => $user,
            'message_view' => $message_view,
        ));
    }

    /**
     *
     * @param string $threadId
     *
     * @return Response
     */
    public function threadAction($threadId)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message_view = $this->verifierView($user);

        $thread = $this->getProvider()->getThread($threadId);
        $form = $this->container->get('fos_message.reply_form.factory')->create($thread);
        $formHandler = $this->container->get('fos_message.reply_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
                'threadId' => $message->getThread()->getId(),
            )));
        }

        return $this->container->get('templating')->renderResponse(':Message:thread.html.twig', array(
            'form' => $form->createView(),
            'thread' => $thread,
            'user' => $user,
            'message_view' => $message_view,
        ));
    }

    /**
     *
     * @return Response
     */
    public function newThreadAction()
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $message_view = $this->verifierView($user);

        $form = $this->container->get('fos_message.new_thread_form.factory')->create();
        $formHandler = $this->container->get('fos_message.new_thread_form.handler');

        if ($message = $formHandler->process($form)) {
            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
                'threadId' => $message->getThread()->getId(),
            )));
        }

        return $this->container->get('templating')->renderResponse(':Message:newThread.html.twig', array(
            'form' => $form->createView(),
            'data' => $form->getData(),
            'user' => $user,
            'message_view' => $message_view,
        ));
    }

    public function verifierView($user)
    {
        if ($user->hasRole('ROLE_ELEVE') && $user->hasRole('ROLE_USER')) {
            $message_view = 'profile/message_eleve.html.twig';
        } elseif ($user->hasRole('ROLE_ENSEIGNANT') && $user->hasRole('ROLE_USER')) {
            $message_view = 'profile/message_enseignant.html.twig';
        } elseif ($user->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('sonata_admin_redirect');
        } else {
            return $this->redirectToRoute('homepage');
        }

        return $message_view;
    }
}