<?php

namespace Repository;

use Model\SatellitePosition;

/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:12
 */
interface SatellitePositionRepository
{
    const ISS_SATELLITE_ID = "25544";

    /**
     * @param string $satelliteId
     * @return SatellitePosition
     */
    public function getSatellitePosition($satelliteId = self::ISS_SATELLITE_ID);
}