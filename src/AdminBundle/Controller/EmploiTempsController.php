<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Bulletin;
use AppBundle\Entity\Eleve;
use AppBundle\Form\FilesType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EmploiTempsController extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Bulletin
            ? $object->getId()
            : 'Bulletin Ajouter'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('user')
            ->add('file.fileName')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ));
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $user = $container->get('doctrine.orm.default_entity_manager')
            ->getRepository(Eleve::class)
            ->findAll();

        $formMapper
            ->add('file', FilesType::class, array(
                'label' => empty($user)
            ))
            ->add('user', null, array(
                'choices' => array(
                    'user' => $user
                )
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user');
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('user.nom')
            ->add('file.fileName');
    }
}
