<?php

namespace App\Traits;

trait DistanceFromLatLongs
{

    // Example of array
    // [
    //     [27.2101167, 94.128415],
    //     [27.210146, 94.1283178],
    //     Add the rest of your coordinates here
    // ];

    public function getDistance($array)
    {
        $totalDistance = 0;
        $previousPoint = $array[0]; // Start with the first point

        foreach ($array as $point) {
            if ($point !== $previousPoint) { // Avoid calculating the distance with itself
                $totalDistance += $this->haversineGreatCircleDistance($previousPoint[0], $previousPoint[1],$point[0], $point[1]);
                $previousPoint = $point;
            }
        }

        // Convert the distance to kilometers (from meters)
        $totalDistanceKm = round($totalDistance / 1000, 2);
        return $totalDistanceKm;
    }

    public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // Convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
