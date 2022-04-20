<?php 
namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model;
use ApiPlatform\Core\OpenApi\Model\RequestBody;

final class UserManagementDecorator implements OpenApiFactoryInterface
{
    private $decorated;
    
    public function __construct(OpenApiFactoryInterface $decorated) {
        $this->decorated = $decorated;
    }
    public function __invoke(array $context = []): OpenApi
    {
        $openApi = ($this->decorated)($context);
        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['UserSignup'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'name' => [
                    'type' => 'string'
                ],
                'email' => [
                    'type' => 'string'
                ],
                'password' => [
                    'type' => 'string'
                ],
                'avatar' => [
                    'type' => 'string'
                ]
            ]
        ]);
        $schemas['ForgotPassword'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'email' => [
                    'type' => 'string'
                ]
            ]
        ]);
        $schemas['ResetPassword'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'hash' => [
                    'type' => 'string'
                ],
                'password' => [
                    'type' => 'string'
                ]
            ]
        ]);
        $schemas['Errors'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'errors' => [
                    'type' => 'object',
                    'properties' => [
                        'code' => [
                            'type' => 'integer'
                        ],
                        'message' => [
                            'type' => 'string'
                        ]
                    ]
                ]
            ]
        ]);
        $schemas['Success'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'errors' => [
                    'type' => 'object',
                    'properties' => [
                        'success' => [
                            'type' => 'integer'
                        ]
                    ]
                ]
            ]
        ]);
        $pathItem = new Model\PathItem(
            ref: 'User Management',
            post: new Model\Operation(
                operationId: 'signup',
                tags: ['User Management'],
                requestBody: new RequestBody(
                    description: 'User Signup',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/UserSignup',
                            ],
                        ],
                    ]),
                    required: true
                ),
                responses: [
                    '200' => [
                        'description' => 'User',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Users.UsersOutput',
                                ],
                            ],
                        ],
                    ],
                    '400' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ],
                    '409' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ]
                ],
                summary: 'signup'
            ),
        );
        $openApi->getPaths()->addPath('/user-management/signup', $pathItem);

        $pathItem = new Model\PathItem(
            ref: 'User Management',
            post: new Model\Operation(
                operationId: 'forgotPassword',
                tags: ['User Management'],
                requestBody: new RequestBody(
                    description: 'User Signup',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/ForgotPassword',
                            ],
                        ],
                    ]),
                    required: true
                    ),
                responses: [
                    '200' => [
                        'description' => 'User',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Success',
                                ],
                            ],
                        ],
                    ],
                    '400' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ],
                    '409' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ]
                ],
                summary: 'forgotPassword'
            ),
        );
        $openApi->getPaths()->addPath('/user-management/forgot-password', $pathItem);

        $pathItem = new Model\PathItem(
            ref: 'User Management',
            post: new Model\Operation(
                operationId: 'resetPassword',
                tags: ['User Management'],
                requestBody: new RequestBody(
                    description: 'User Signup',
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/ResetPassword',
                            ],
                        ],
                    ]),
                    required: true
                    ),
                responses: [
                    '200' => [
                        'description' => 'User',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Success',
                                ],
                            ],
                        ],
                    ],
                    '400' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ],
                    '409' => [
                        'description' => 'Errors',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Errors',
                                ],
                            ],
                        ],
                    ]
                ],
                summary: 'resetPassword'
                ),
            );
        $openApi->getPaths()->addPath('/user-management/reset-password', $pathItem);
        
        return $openApi;
    }
}
?>