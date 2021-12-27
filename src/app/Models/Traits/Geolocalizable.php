<?php

namespace App\Models\Traits;


/**
 * @method getTable()
 */
trait Geolocalizable
{

    /**
     * Trait Configuration function
     * Return the latitude and longitude field names in the model
     * @return array
     */
    abstract public function geolocalizable(): array;


    /**
     * Get the elements within a radius from a location
     *
     * @param $query
     * @param $location
     * @param $radius
     * @return mixed
     */
    public function scopeIsWithinMaxDistance($query, $location, $radius = 25)
    {
        $config = $this->geolocalizable();
        $table = $this->getTable();

        $haversine = "(6371 * acos(cos(radians($location->latitude))
                     * cos(radians($table.{$config['latitude_field_name']}))
                     * cos(radians($table.{$config['longitude_field_name']})
                     - radians($location->longitude))
                     + sin(radians($location->latitude))
                     * sin(radians($table.{$config['latitude_field_name']}))))";


        return $query
            ->select()
            ->selectRaw("{$haversine} AS distance")
            ->whereRaw("{$haversine} < ?", [$radius]);
    }


}
