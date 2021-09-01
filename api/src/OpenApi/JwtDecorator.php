<?php 
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;

final class JwtDecorator implements OpenApiFactoryInterface
{
    public function __construct(OpenApiFactoryInterface $decorated) {
        $this->decorated = $decorated;
    }
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    'readOnly' => true,
                ],
            ],
        ]);
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'email' => [
                    'type' => 'string',
                    'example' => 'johndoe@example.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'apassword',
                ],
            ],
        ]);
        $operationParams = [
            'operationId' => 'postCredentialsItem',
            'tags' => ['Token'],
            'responses' => [
                '200' => [
                    'description' => 'Get JWT token',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Token',
                            ],
                        ],
                    ],
                ],
            ],
            'summary' => 'Get JWT token to login.',
            'requestBody' => new Model\RequestBody([
                'description' => 'Generate new JWT Token',
                'content' => new \ArrayObject([
                    'application/json' => [
                        'schema' => [
                            '$ref' => '#/components/schemas/Credentials',
                        ],
                    ],
                ]),
                ]),
            
        ];
        $pathParams = [
            'ref' => 'JWT Token',
            'post' => new Model\Operation($operationParams)
        ];
        $pathItem = new Model\PathItem($pathParams);
        $openApi->getPaths()->addPath('/authentication_token', $pathItem);
        return $openApi;
    }
}
?>