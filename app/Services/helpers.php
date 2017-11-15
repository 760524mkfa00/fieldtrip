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


/**
 * @param $serial
 * @return mixed
 *
 * Decode the URL from the email
 */
function serialDecode($serial)
{
    return unserialize(base64_decode(strtr($serial, '._-', '+/=')));

}

function serialEncode($trip_id, $user_id)
{
    return strtr(base64_encode(serialize([$trip_id, $user_id])), '+/=', '._-');
}