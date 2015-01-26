<?php
namespace TNCY\SchoolBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\TranslatorInterface;

class MenuBuilder
{
    private $factory;
    private $translator;

    /**
     * @param FactoryInterface $factory
     * @param TranslatorInterface $translator
     */
    public function __construct(FactoryInterface $factory, TranslatorInterface $translator)
    {
        $this->factory = $factory;
        $this->translator = $translator;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav navbar-right'));
        $menu->addChild('route1', array('route' => 'tncy_school_index'));


        return $menu;
    }
}
