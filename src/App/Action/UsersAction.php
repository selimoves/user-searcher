<?php

namespace App\Action;

use Webimpress\HttpMiddlewareCompatibility\MiddlewareInterface as ServerMiddlewareInterface;
use Webimpress\HttpMiddlewareCompatibility\HandlerInterface as DelegateInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use App\Service\UserService;
use App\Db\Filters;

/**
 * Description of UsersAction
 *
 * @author Eldar S. Selimov <selimoves@gmail.com>
 */
class UsersAction
        implements ServerMiddlewareInterface
{

    /** @var UserService */
    private $service;

    /** @var Filters */
    private $filters;

    /**
     * 
     * @param UserService $service
     * @param Filters $filters
     */
    public function __construct(UserService $service, Filters $filters)
    {
        $this->service = $service;
        $this->filters = $filters;
    }

    /**
     * 
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return JsonResponse|EmptyResponse
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        //$params = ['country' => 'Labanon'];
        //$chain = $this->filters->createFilterChain([
        //    $this->filters->country(':country'), 
        //    'OR' => $this->filters->state('active'),
        //    'AND' => [
        //          $this->filters->id(':id2'), 
        //          'OR' => $this->filters->id(':id2')
        //     ]
        //]);
        
        $params = $request->getQueryParams();
        $chain = $this->filters->createFilterChain([
            $this->filters->country(':country')
        ]);
        
        $response = new JsonResponse($this->service->getUsers($chain, $params, 20));

        return $response->withStatus(200);
    }

}
