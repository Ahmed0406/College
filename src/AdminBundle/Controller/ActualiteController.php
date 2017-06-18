<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Actualite;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ActualiteController extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Actualite
            ? $object->getTitre()
            : 'Actualite Ajouter'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('titre')
            ->add('date')
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
        $formMapper
            ->add('titre', 'text')
            ->add('description', 'textarea');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('titre')
            ->add('date');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Actualite', array('class' => 'col-md-8'))
            ->add('titre')
            ->add('description')
            ->add('type')
            ->add('date')
            ->end();
    }
}
