<?php

$names = [
    'Charlotte',
    'Megan',
    'Sophie',
    'Emily',
    'Jessica',
    'Lucy',
    'Chloe',
    'Olivia',
    'Hannah',
    'Ellie',
    'Katie',
    'Ella',
    'Amelia',
    'Amy',
    'Holly',
    'Grace',
    'Alice',
    'Daisy',
    'Isabella',
    'Paige',
    'Caitlin',
    'Anna',
    'Leah',
    'Millie',
    'Molly',
    'Oliver',
    'Joseph',
    'Harry',
    'Joshua',
    'James',
    'William',
    'Samuel',
    'Daniel',
    'Jack',
    'Thomas',
    'Matthew',
    'Luke',
    'Ethan',
    'Lewis',
    'Benjamin',
    'Mohammed',
    'Callum',
    'Alexander',
    'Louis',
    'Harrison',
    'Edward',
    'Brandon',
    'Jacob',
    'Michael',
    'Liam'
];

$data = [];
$bars = mt_rand(5, 15);
for ($i = 0; $i < $bars; $i++) {
    shuffle($names);
    $data[] = [
        'name' => array_pop($names),
        'value' => mt_rand(50, 500)
    ];
}

