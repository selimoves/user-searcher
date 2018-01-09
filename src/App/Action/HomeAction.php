<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class HomeAction
        implements ServerMiddlewareInterface
{

    /** @var RouterInterface */
    private $router;

    /** @var TemplateRendererInterface */
    private $template;

    public function __construct(
            RouterInterface $router, 
            TemplateRendererInterface $template)
    {
        $this->router = $router;
        $this->template = $template;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $data = [];
        return new HtmlResponse($this->template->render('app::home', $data));
    }

}
