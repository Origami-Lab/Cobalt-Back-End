<?php 
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class UserRolesDecorator implements OpenApiFactoryInterface
{
    private $decorated;
    
    public function __construct(OpenApiFactoryInterface $decorated) {
        $this->decorated = $decorated;
    }
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['UserRoles'] = new \ArrayObject([
            'type' => 'array',
            'items' => new \ArrayObject([
                'type' => 'object',
                'properties' => [
                    'name' => [
                        'type' => 'string',
                        'readOnly' => true,
                    ],
                    'label' => [
                        'type' => 'string',
                        'readOnly' => true,
                    ],
                ]
            ])
        ]);
        $pathItem = new Model\PathItem(
            ref: 'User Roles',
            get: new Model\Operation(
                operationId: 'getUserRoles',
                tags: ['UserRoles'],
                responses: [
                    '200' => [
                        'description' => 'Get user roles',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/UserRoles',
                                ],
                            ],
                        ],
                    ],
                ],
                summary: 'Get user roles'
            ),
        );
        $openApi->getPaths()->addPath('/user_roles', $pathItem);
        return $openApi;
    }
}
?>