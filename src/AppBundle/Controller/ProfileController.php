<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Form\EleveType;
use AppBundle\Form\EnseignantType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use function Symfony\Component\VarDumper\Dumper\esc;

/**
 * Controller managing the user profile.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
    /**
     * Show the user.
     * @return RedirectResponse|Response
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        if ($user->hasRole('ROLE_ELEVE') && $user->hasRole('ROLE_USER')) {
            $profile_view = 'profile/eleve.html.twig';
        } elseif ($user->hasRole('ROLE_ENSEIGNANT') && $user->hasRole('ROLE_USER')) {
            $profile_view = 'profile/enseignant.html.twig';
        } elseif ($user->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('sonata_admin_redirect');
        } else {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('profile/profile.html.twig', array(
            'user' => $user,
            'profile_view' => $profile_view,
        ));
    }

    /**
     * @param Request $request
     * @return null|RedirectResponse|Response
     */
    public function infoAction(Request $request)
    {

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $type = null;
        $view = null;
        if ($user->hasRole('ROLE_ELEVE') && $user->hasRole('ROLE_USER')) {
            $view = 'profile/eleve/info.html.twig';
            $type = EleveType::class;
        } elseif ($user->hasRole('ROLE_ENSEIGNANT') && $user->hasRole('ROLE_USER')) {
            $view = 'profile/enseignant/info.html.twig';
            $type = EnseignantType::class;
        } elseif ($user->hasRole('ROLE_ADMIN')) {
            return $this->redirectToRoute('sonata_admin_redirect');
        } else {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm($type,$user);
        $form->setData($user);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            return $response;
        }

        return $this->render($view, array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Edit the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
