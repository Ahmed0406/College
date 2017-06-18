<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\Livre;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LivreController extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Livre
            ? $object->getNom()
            : 'Livre Ajouter'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('ref')
            ->add('bibliotheque.nom', null ,array(
                'label' => 'bibliotheque'
            ))
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
            ->with('Livre', array('class' => 'col-md-9'))
            ->add('nom', 'text')
            ->add('ref')
            ->end()/*---------------------------------*/
            ->with('bibliotheque', array('class' => 'col-md-3'))
            ->add('bibliotheque', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Bibliotheque',
                'property' => 'nom',
            ))
            ->end();


    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('bibliotheque', null, array(), 'entity', array(
                'class' => 'AppBundle\Entity\Bibliotheque',
                'choice_label' => 'nom',
            ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nom')
            ->add('ref')
            ->add('bibliotheque.nom', null ,array(
                'label' => 'bibliotheque'
            ));
    }
}
