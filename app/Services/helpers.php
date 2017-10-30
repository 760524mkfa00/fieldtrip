<?php namespace Fieldtrip\Services;

/**
 * @param array $dataArray
 * @param array $ordering
 * @return array
 */

function sortData(array $dataArray, array $ordering)
{

    usort($dataArray, function ($rowA, $rowB) use ($ordering) {
        foreach ($ordering as $key => $sortDirection) {
            switch ($sortDirection) {
                case 'desc':
                    $direction = -1;
                    break;
                case 'asc':
                default:
                    $direction = 1;
                    break;
            }
            if ($rowA[$key] > $rowB[$key]) {
                return $direction;
            } else {
                if ($rowA[$key] < $rowB[$key]) {
                    return $direction * -1;
                }
            }
        }

        return 0;
    });

    return $dataArray;
}