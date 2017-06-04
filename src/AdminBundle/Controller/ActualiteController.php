<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Actualite;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ActualiteController extends AbstractAdmin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('titre')
            ->add('date');
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

    public function toString($object)
    {
        return $object instanceof Actualite
            ? $object->getTitre()
            : 'Actualite Ajouter'; // shown in the breadcrumb on the create view
    }
}
