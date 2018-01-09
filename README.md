Hello world!!!

Фильтры расположены в App/Db/Filters/
Класс поиска пользователей: App\Service\UsersService

Пример формирования цепочки фильтров и передачи их в поиск есть в App\Action\UsersAction.

Ещё пример:

$filtersConfig = [
    'id' => Db\Filters\IdFilter::class,
    'email' => Db\Filters\EmailFilter::class,
    'country' => Db\Filters\CountryFilter::class,
    'name' => Db\Filters\NameFilter::class,
    'state' => Db\Filters\StateFilter::class,
];


Sfilters = new \App\Db\Filters\Filters($filtersConfig);


$filterChain = Sfilters->createFilterChain([
    $filters->country(':country'),
    'AND' => [
        $filters->email('<>', ':email'),
        'OR' => $filters->id(1),
    ]
]);


$params = ['country' => 'Lebanon', 'email' => 'mailbox@example.com'];

$usersService = new \App\Service\UsersService($PDO);

$resultArray = $usersService->getUsers($filterChain, $params, 1, 20);
