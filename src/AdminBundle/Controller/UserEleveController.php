<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Eleve;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserEleveController extends AbstractAdmin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('nom');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('email', 'email')
            ->add('username')
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('enabled')
            ->add('nom', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom');
    }

    public function toString($object)
    {
        return $object instanceof Eleve
            ? $object->getUsername()
            : 'User est Ajouter'; // shown in the breadcrumb on the create view
    }
}
