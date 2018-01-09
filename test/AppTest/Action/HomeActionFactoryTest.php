<?php

namespace AppTest\Action;

use App\Action\HomeAction;
use App\Action\HomeActionFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeActionFactoryTest extends TestCase
{
    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    public function testFactoryWithoutTemplate()
    {
        $factory = new HomeActionFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);

        $this->assertInstanceOf(HomeActionFactory::class, $factory);

        $homePage = $factory($this->container->reveal());

        $this->assertInstanceOf(HomeAction::class, $homePage);
    }

    public function testFactoryWithTemplate()
    {
        $factory = new HomeActionFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $this->assertInstanceOf(HomeActionFactory::class, $factory);

        $homePage = $factory($this->container->reveal());

        $this->assertInstanceOf(HomeAction::class, $homePage);
    }
}
