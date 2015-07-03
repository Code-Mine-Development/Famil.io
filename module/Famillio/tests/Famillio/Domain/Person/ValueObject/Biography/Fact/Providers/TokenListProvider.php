<?php
/**
 * Created by PhpStorm.
 * User: adamgrabek
 * Date: 13/06/15
 * Time: 16:26
 */

namespace Famillio\Model\Person\ValueObject\Biography\Fact\Providers;

/**
 * Class TokenListProvider
 *
 * @package Famillio\Model\Person\ValueObject\Biography\Fact\Providers
 */
class TokenListProvider
{
    /**
     * @return array
     */
    static public function getData() : array
    {
        $nameToken     = '{NAME}';
        $dateToken     = '{DATE}';
        $timeToken     = '{TIME}';
        $locationToken = '{LOCATION}';


        return [
            [
                'tokens'              => [
                    [
                        $nameToken,
                        $dateToken,
                        $locationToken,
                    ],
                    [
                        $nameToken,
                        $dateToken,
                    ],
                    [
                        $nameToken,
                        $dateToken,
                        $timeToken,
                        $locationToken,
                    ],
                ],
                'expectedDifferences' => [
                    $timeToken,
                    $locationToken,
                ],
            ],
            [
                'tokens'              => [
                    [
                        $nameToken,
                        $dateToken,
                    ],
                    [
                        $nameToken,
                        $dateToken,
                    ],
                ],
                'expectedDifferences' => [],
            ],
            [
                'tokens' => [
                    [
                        $locationToken,
                        $nameToken,
                        $dateToken,
                    ],
                    [
                        $nameToken,
                        $locationToken,
                        $dateToken
                    ],
                    [
                        $dateToken,
                        $nameToken,
                        $locationToken
                    ],
                    [
                        $locationToken,
                        $dateToken,
                        $nameToken
                    ]
                ],
                'expectedDifferences' => NULL
            ],
            [
                'tokens' => [
                    [
                        $locationToken,
                        $nameToken
                    ],
                    []
                ],
                'expectedDifferences' => [
                    $locationToken,
                    $nameToken
                ]
            ]
        ];
    }
}