<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\Bibliotheque;
use AppBundle\Entity\Livre;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BibliothequeController extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Bibliotheque
            ? $object->getNom()
            : 'Livre Ajouter'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('nom')
            ->add('livre', null, array(
                'associated_property' => 'nom'
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
            ->add('nom', 'text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('Livre', array('class' => 'col-md-3'))
            ->add('nom')
            ->end()
            ->with('livre', array('class' => 'col-md-6'))
            ->add('livre', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Livre',
                'associated_property' => 'nom',
                'label' => 'livre'
            ))
            ->end();
    }
}
