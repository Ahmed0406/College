<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\Actualite;
use AppBundle\Entity\Article;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleController extends AbstractAdmin
{
    public function toString($object)
    {
        return $object instanceof Article
            ? $object->getTitre()
            : 'Article Ajouter'; // shown in the breadcrumb on the create view
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('titre')
            ->add('description')
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
        $container = $this->getConfigurationPool()->getContainer();
        $user = $container->get('security.token_storage')->getToken()->getUser();
        dump($user);
        $formMapper
            ->add('titre', 'text')
            ->add('description', 'textarea')
            ->add('user', null, array(
                'choices' => array(
                    'user' => $user
                )
            ))
            ->add('type');
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
            ->with(null, array('class' => 'row'))
            ->with('Article', array('class' => 'col-md-8'))
            ->add('titre')
            ->add('description')
            ->add('date')
            ->end()
            ->with(null, array('class' => 'row'))
            ->with('Commentaire', array('class' => 'col-md-10'))
            ->add('commentaire', 'sonata_type_model', array(
                'class' => 'AppBundle\Entity\Commentaire',
                'associated_property' => 'message',
                'label' => 'Commentaire'
            ))
            ->end();
    }
}
