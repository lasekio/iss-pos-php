<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:46
 */

namespace Services;

use Model\SatellitePosition;

interface HumanReadableSatellitePositionProvider
{
    /**
     * @param SatellitePosition $position
     * @return string | null
     */
    public function getHumanReadableSatellitePosition(SatellitePosition $position);
}