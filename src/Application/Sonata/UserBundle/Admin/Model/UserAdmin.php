<?php
namespace Application\Sonata\UserBundle\Admin\Model;

use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends SonataUserAdmin
{
    /**
    * {@inheritdoc}
    */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
        ->tab('User')
            ->with('Profile')
                ->add('avatar', 'sonata_type_model_list', array('required' => false), array())
                ->add('background', 'sonata_type_model_list', array('required' => false), array())
            ->end()
            ->with('Social')
                ->add('github','text',array('required' => false))
                // ...
            ->end()
        ;
    }
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
        ->with('Social')
            ->add('github')
        ->end()

        ;

    }

    public function getPersistentParameters()
    {
        if (!$this->getRequest()) {
            return array();
        }

        return array(
            'provider' => $this->getRequest()->get('provider'),
            'context'  => $this->getRequest()->get('context'),
        );
    }

}