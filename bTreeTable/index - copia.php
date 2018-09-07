<?php

$tree = [
    [
        'name'        => 'Igor',
        'children'    => 2,
        'siblings'    => 0,
        'level'       => 1,
        'descendants' => [
            [
                'name'        => 'Rapid',
                'children'    => 2,
                'siblings'    => 1,
                'level'       => 2,
                'descendants' => [
                    [
                        'name'        => 'Hodor',
                        'children'    => 1,
                        'siblings'    => 1,
                        'level'       => 3,
                        'descendants' => [
                            [
                                'name'        => 'Hodor II',
                                'children'    => 1,
                                'siblings'    => 0,
                                'level'       => 4,
                                'descendants' => [
                                    [
                                        'name'     => 'Hodor III',
                                        'children' => 0,
                                        'siblings' => 0,
                                        'level'    => 5
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        'name'     => 'Rapid II',
                        'children' => 0,
                        'siblings' => 1,
                        'level'    => 3
                    ]
                ]
            ],
            [
                'name'     => 'Thunder',
                'children' => 0,
                'siblings' => 1,
                'level'    => 2
            ]
        ]
    ]
];
echo "<pre>";
print_r($tree);
echo "</pre>";

// Loop over the tree. Every person in the root of the tree
// gets his own table(s).
foreach ($tree as $person) {
    $rows = [];
    parsePerson($person, $rows);

    $rows = cleanupRows($rows);

    output($rows);
    $rows = convertRowsToHorizontal($rows);
    output($rows);
}

/**
 * Convert a person in the tree to an array to be used to print the tables.
 *
 * @param array $person
 * @param array $rows
 * @param int   $level
 * @param int   $position
 *
 * @return int
 */
function parsePerson($person, &$rows, $level = 0, $position = 0)
{
    if (!empty($person['descendants'])) {
        // The colspan of this row is the sum of the colspans of
        // its children
        $colspan = 0;

        foreach ($person['descendants'] as $descendant) {
            $colspan += parsePerson(
                $descendant,
                $rows,
                $level + 1,
                $position + $colspan
            );
        }
    } else {
        // If this person has no children, the colspan is 1.
        $colspan = 1;
    }

    $rows[$level][$position] = [
        'colspan' => $colspan,
        'name'    => $person['name']
    ];

    return $colspan;
}

/**
 * Insert empty cells where needed and sort by keys.
 *
 * @param array $rows
 *
 * @return array
 */
function cleanupRows($rows)
{
    $width = $rows[0][0]['colspan'];
    foreach ($rows as $rowNumber => $row) {
        $spanSoFar = 0;
        foreach ($row as $position => $cell) {
            // Insert empty cells in the row.
            if ($spanSoFar < $position) {
                for ($i = $spanSoFar; $i < $position; $i++) {
                    $rows[$rowNumber][$i] = ['name' => '', 'colspan' => 1];
                    $spanSoFar += 1;
                }
            }
            $spanSoFar += $cell['colspan'];
        }
        // Insert empty cells at the end of the row.
        if ($spanSoFar < $width) {
            for ($i = $spanSoFar; $i < $width; $i++) {
                $rows[$rowNumber][$i] = ['name' => '', 'colspan' => 1];
            }
        }
        // Sort cells by index.
        ksort($rows[$rowNumber]);
    }
    // Sort rows by index.
    ksort($rows);

    return $rows;
}

/**
 * Convert the table array from vertical representation to horizontal
 * representation.
 *
 * @param array $rows
 *
 * @return array
 */
function convertRowsToHorizontal($rows)
{
    // Create a new array containing all fields for the vertical representation
    // of the table.
    $newRows = [];

    // Fill the new array with data from the vertical table.
    foreach ($rows as $rowNumber => $row) {
        foreach ($row as $cellNumber => $cell) {
            $newRows[$cellNumber][$rowNumber] = [
                'name'    => $cell['name'],
                'rowspan' => $cell['colspan']
            ];
        }
    }

    ksort($newRows);

    return $newRows;
}

/**
 * Print the table.
 *
 * @param array $rows
 */
function output($rows)
{
    echo "<pre>";
    print_r($rows);
    echo "</pre>";
    echo '<table border="1">';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $cell) {
            if (!empty($cell['colspan'])) {
                echo '<td colspan="' . $cell['colspan'] . '" align="center">';
            } else {
                echo '<td rowspan="' . $cell['rowspan'] . '" align="center">';
            }
            echo $cell['name'];
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}