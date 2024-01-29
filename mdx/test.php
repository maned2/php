<?php
require __DIR__ . '/vendor/autoload.php';

use classes\CrossJoinExpr;
use classes\MdxQuery;
use classes\DefaultExpr;
use classes\NonEmptyExpr;
use classes\RangeExpr;
use classes\SetExpr;
use classes\TupleExpr;

$tests = [
    [
        'test' => "SELECT
    [Measures].[Amount] ON COLUMNS,
    [Product].[Product].[Name] ON ROWS
FROM [Sales]",
        'val' => (new MdxQuery())
            ->columns(new DefaultExpr(['Measures', 'Amount']))
            ->rows(new DefaultExpr(['Product', 'Product', 'Name']))
            ->from('[Sales]')
    ],
    [
        'test' => "SELECT
    [Measures].[Amount] ON COLUMNS,
    ([Product].[Product].[Name].&[Носок], [Product].[Product].[Name].&[Валенок]) ON ROWS
FROM [Sales]",
        'val' => (new MdxQuery())
            ->columns(new DefaultExpr(['Measures', 'Amount']))
            ->rows(new TupleExpr([
                new DefaultExpr(['Product', 'Product', 'Name'], 'Носок'),
                new DefaultExpr(['Product', 'Product', 'Name'], 'Валенок')
            ]))
            ->from('[Sales]')
    ],
    [
        'test' => "SELECT
    [Measures].[Amount] ON COLUMNS,
    ([Product].[Product].[Name].&[Носок], [Product].[Product].[Name].&[Валенок]) ON ROWS
FROM (
    SELECT
    [Date].[Date].[Month].&[202101] ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->columns(new DefaultExpr(['Measures', 'Amount']))
            ->rows(new TupleExpr([
                new DefaultExpr(['Product', 'Product', 'Name'], 'Носок'),
                new DefaultExpr(['Product', 'Product', 'Name'], 'Валенок')
            ]))
            ->from((new MdxQuery())
                ->columns(new DefaultExpr(['Date', 'Date', 'Month'], 202101))
                ->from('[Sales]'))
    ],
    [
        'test' => "SELECT
    [Measures].[Amount] ON COLUMNS,
    ([Product].[Product].[Name].&[Носок], [Product].[Product].[Name].&[Валенок]) ON ROWS
FROM (
    SELECT
    [Date].[Date].[Month].&[202101] ON COLUMNS
FROM (
    SELECT
    [Product].[Category].[Id].&[10] ON COLUMNS
FROM [Sales]
    )
    )",
        'val' => (new MdxQuery())
            ->columns(new DefaultExpr(['Measures', 'Amount']))
            ->rows(new TupleExpr([
                new DefaultExpr(['Product', 'Product', 'Name'], 'Носок'),
                new DefaultExpr(['Product', 'Product', 'Name'], 'Валенок')
            ]))
            ->from((new MdxQuery())
                ->columns(new DefaultExpr(['Date', 'Date', 'Month'], 202101))
                ->from(
                    (new MdxQuery())
                        ->columns(new DefaultExpr(['Product', 'Category', 'Id'], 10))
                        ->from('[Sales]')
                ))
    ],
    [
        'test' => "SELECT
    [Measures].[Amount] ON COLUMNS,
    {[Product].[Product].[Name], [Date].[Year]} ON ROWS
FROM [Sales]",
        'val' => (new MdxQuery())
            ->columns(new DefaultExpr(['Measures', 'Amount']))
            ->rows(new SetExpr([
                new DefaultExpr(['Product', 'Product', 'Name']),
                new DefaultExpr(['Date', 'Year'])
            ]))
            ->from('[Sales]')
    ],
    [
        'test' => "SELECT
    {[Measures].[Amount], [Measures].[Rest]} ON COLUMNS,
    {[Product].[Product].[Name], [Date].[Year]} ON ROWS
FROM [Sales]",
        'val' => (new MdxQuery())
            ->columns(new SetExpr([
                new DefaultExpr(['Measures', 'Amount']),
                new DefaultExpr(['Measures', 'Rest']),
            ]))
            ->rows(new SetExpr([
                new DefaultExpr(['Product', 'Product', 'Name']),
                new DefaultExpr(['Date', 'Year'])
            ]))
            ->from('[Sales]')
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    MySetName ON COLUMNS,
    [Product].[Product].[Name] ON ROWS
FROM [Sales]",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns('MySetName')
            ->rows(new DefaultExpr(['Product', 'Product', 'Name']))
            ->from('[Sales]')
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    MySetName ON COLUMNS,
    [Product].[Product].[Name] ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns('MySetName')
            ->rows(new DefaultExpr(['Product', 'Product', 'Name']))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name], MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns('MySetName')
            ->rows(new NonEmptyExpr([
                new DefaultExpr(['Product', 'Product', 'Name']),
                'MySetName'
            ]))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    {[Address].[Town], MySetName} ON COLUMNS,
    NONEMPTY([Product].[Product].[Name], MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns(new SetExpr([
                new DefaultExpr(['Address', 'Town']),
                'MySetName'
            ]))
            ->rows(new NonEmptyExpr([
                new DefaultExpr(['Product', 'Product', 'Name']),
                'MySetName'
            ]))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    [Address].[Town] * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name], MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
    ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
    ->columns(new CrossJoinExpr([
        new DefaultExpr(['Address', 'Town']),
        'MySetName'
    ]))
    ->rows(new NonEmptyExpr([
        new DefaultExpr(['Product', 'Product', 'Name']),
        'MySetName'
    ]))
    ->from((new MdxQuery())
        ->columns(new RangeExpr([
            new DefaultExpr(['Date', 'Date', 'Month'], 202101),
            new DefaultExpr(['Date', 'Date', 'Month'], 202112),
        ]))
        ->from('[Sales]')
    )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    NONEMPTY([Address].[Town], MySetName) * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name], MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns(new CrossJoinExpr([new NonEmptyExpr([
                    new DefaultExpr(['Address', 'Town']),
                    'MySetName'
                ]),
                'MySetName'
            ]))
            ->rows(new NonEmptyExpr([
                new DefaultExpr(['Product', 'Product', 'Name']),
                'MySetName'
            ]))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    NONEMPTY([Address].[Town] * NONEMPTY([Branch].[Name], MySetName), MySetName) * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name] * NONEMPTY([Date].[Date].[Day], MySetName), MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns(new CrossJoinExpr([new NonEmptyExpr([
                new CrossJoinExpr([
                    new DefaultExpr(['Address', 'Town']),
                    new NonEmptyExpr([
                        new DefaultExpr(['Branch', 'Name']),
                        'MySetName'
                    ])
                ]),
                'MySetName'
            ]),
                'MySetName'
            ]))
            ->rows(new NonEmptyExpr([
                new CrossJoinExpr([
                    new DefaultExpr(['Product', 'Product', 'Name']),
                    new NonEmptyExpr([
                        new DefaultExpr(['Date','Date','Day']),
                        'MySetName'
                    ])
                ]),
                'MySetName'
            ]))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    NONEMPTY([Address].[Town] * NONEMPTY([Branch].[Name] * NONEMPTY([SaleType].[Name], MySetName), MySetName), MySetName) * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name] * NONEMPTY([Date].[Date].[Day], MySetName), MySetName) ON ROWS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )",
        'val' => (new MdxQuery())
            ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
            ->columns(new CrossJoinExpr([
                new NonEmptyExpr([
                    new CrossJoinExpr([
                        new DefaultExpr(['Address', 'Town']),
                        new NonEmptyExpr([
                            new CrossJoinExpr([
                                new DefaultExpr(['Branch', 'Name']),
                                new NonEmptyExpr([
                                    new DefaultExpr(['SaleType', 'Name']),
                                    'MySetName'
                                ])
                            ]),
                            'MySetName'
                        ])
                    ]),
                    'MySetName'
                ]),
                'MySetName'
            ]))
            ->rows(new NonEmptyExpr([
                new CrossJoinExpr([
                    new DefaultExpr(['Product', 'Product', 'Name']),
                    new NonEmptyExpr([
                        new DefaultExpr(['Date','Date','Day']),
                        'MySetName'
                    ])
                ]),
                'MySetName'
            ]))
            ->from((new MdxQuery())
                ->columns(new RangeExpr([
                    new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                    new DefaultExpr(['Date', 'Date', 'Month'], 202112),
                ]))
                ->from('[Sales]')
            )
    ],
    [
        'test' => "WITH SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}
SELECT
    NONEMPTY([Address].[Town] * NONEMPTY([Branch].[Name] * NONEMPTY([SaleType].[Name], MySetName), MySetName), MySetName) * MySetName ON COLUMNS,
    NONEMPTY([Product].[Product].[Name] * NONEMPTY([Date].[Date].[Day], MySetName), MySetName) ON ROWS
FROM (
    SELECT
    {[Product].[Product].&[134947954], [Product].[Product].&[134947981], [Product].[Product].&[11145970], [Product].[Product].&[101362503]} * {[Address].[Region].&[77], [Address].[Region].&[54]} * {[Branch].[Name].&[6332], [Branch].[Name].&[295]} ON COLUMNS
FROM (
    SELECT
    {[Date].[Date].[Month].&[202101]:[Date].[Date].[Month].&[202112]} ON COLUMNS
FROM [Sales]
    )
    )",
        'val' => (new MdxQuery())
    ->with('SET MySetName AS {[Measures].[Amount], [Measures].[Rest]}')
    ->columns(new CrossJoinExpr([
        new NonEmptyExpr([
            new CrossJoinExpr([
                new DefaultExpr(['Address', 'Town']),
                new NonEmptyExpr([
                    new CrossJoinExpr([
                        new DefaultExpr(['Branch', 'Name']),
                        new NonEmptyExpr([
                            new DefaultExpr(['SaleType', 'Name']),
                            'MySetName'
                        ])
                    ]),
                    'MySetName'
                ])
            ]),
            'MySetName'
        ]),
        'MySetName'
    ]))
    ->rows(new NonEmptyExpr([
        new CrossJoinExpr([
            new DefaultExpr(['Product', 'Product', 'Name']),
            new NonEmptyExpr([
                new DefaultExpr(['Date','Date','Day']),
                'MySetName'
            ])
        ]),
        'MySetName'
    ]))
    ->from((new MdxQuery())
        ->columns(new CrossJoinExpr([
            new SetExpr([
                new DefaultExpr(['Product', 'Product'], 134947954),
                new DefaultExpr(['Product', 'Product'], 134947981),
                new DefaultExpr(['Product', 'Product'], 11145970),
                new DefaultExpr(['Product', 'Product'], 101362503),
            ]),
            new SetExpr([
                new DefaultExpr(['Address', 'Region'], 77),
                new DefaultExpr(['Address', 'Region'], 54),
            ]),
            new SetExpr([
                new DefaultExpr(['Branch', 'Name'], 6332),
                new DefaultExpr(['Branch', 'Name'], 295),
            ]),
        ]))
        ->from((new MdxQuery())
            ->columns(new RangeExpr([
                new DefaultExpr(['Date', 'Date', 'Month'], 202101),
                new DefaultExpr(['Date', 'Date', 'Month'], 202112),
            ]))
            ->from('[Sales]'))
    )
    ]
];


foreach ($tests as $key => $test) {
    /** @var MdxQuery $mdxQuery */
    $mdxQuery = $test['val'];
    if ($mdxQuery->getRawQuery() === $test['test']) {
        print_r("test {$key} success\n");
    } else {
        $lines1 = explode(PHP_EOL, $test['test']);
        $lines2 = explode(PHP_EOL, $mdxQuery->getRawQuery());
        foreach ($lines1 as $key2 => $line) {
            if ($line !== $lines2[$key2]) {
                var_dump($line . "\n");
                var_dump($lines2[$key2]);
                exit;
            }
        }
//        print_r($mdxQuery->getRawQuery());
//        print_r($test['test']);
    }
}