<?php   /* This file is used in cases we need to do arithmetics*/

namespace Controllers;


class Math
{
    static function filterFourNumbers($filteredValue)
    {
        echo "String matches pattern!";
        $hours = substr($filteredValue, 0, 2); // extract the first two characters (hours)
        $minuts = substr($filteredValue, 3, 2); // same but lasts
        $totalMinutes = ($hours * 60) + $minuts; // calculate the total number of minuts
        $filteredValue = $totalMinutes;
        return $filteredValue;
    }

    static function filterThreeNumbers($filteredValue)
    {
        echo "String matches pattern!";
        $hours = substr($filteredValue, 0, 1); // extract the first character (hours)
        $minuts = substr($filteredValue, 2, 2); // same but lasts
        $totalMinutes = ($hours * 60) + $minuts; // calculate the total number of minuts
        $filteredValue = $totalMinutes;
        return $filteredValue;
    }    
}
