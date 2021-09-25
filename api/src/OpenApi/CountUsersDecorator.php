<?php 
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class CountUsersDecorator implements OpenApiFactoryInterface
{
    private $decorated;
    
    public function __construct(OpenApiFactoryInterface $decorated) {
        $this->decorated = $decorated;
    }
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['CountUsers'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'total' => [
                    'type' => 'integer',
                    'readOnly' => true,
                ],
                'byRoles' => [
                    'type' => 'array',
                    'items' => new \ArrayObject([
                        'type' => 'object',
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'readOnly' => true,
                            ],
                            'count' => [
                                'type' => 'integer',
                                'readOnly' => true,
                            ],
                        ]
                    ]),
                    'readOnly' => true,
                ],
            ]
        ]);
        $pathItem = new Model\PathItem(
            ref: 'Count Users',
            get: new Model\Operation(
                operationId: 'countUsers',
                tags: ['CountUsers'],
                responses: [
                    '200' => [
                        'description' => 'Count Users',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/CountUsers',
                                ],
                            ],
                        ],
                    ],
                ],
                summary: 'Count Users'
            ),
        );
        $openApi->getPaths()->addPath('/count_users', $pathItem);
        return $openApi;
    }
}
?>