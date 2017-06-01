<?php

namespace Controller;
use Repository\SatellitePositionRepository;
use Services\HumanReadableSatellitePositionProvider;
use View\IssPosition\ShowView;

/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:09
 */
final class IssPositionController
{
    /**
     * @var SatellitePositionRepository
     */
    private $satellitePositionRepository;

    /**
     * @var HumanReadableSatellitePositionProvider
     */
    private $humanReadableSatellitePositionProvider;

    public function __construct(
        SatellitePositionRepository $satellitePositionRepository,
        HumanReadableSatellitePositionProvider $humanReadableSatellitePositionProvider
    ) {
        $this->satellitePositionRepository = $satellitePositionRepository;
        $this->humanReadableSatellitePositionProvider = $humanReadableSatellitePositionProvider;
    }

    public function showAction()
    {
        //https://maps.googleapis.com/maps/api/staticmap?size=512x512&zoom=1&markers=10,90&center=0,0

        $position = $this->satellitePositionRepository->getSatellitePosition();
        $view = new ShowView();

        $humanReadableSatellitePosition =
            $this->humanReadableSatellitePositionProvider
                ->getHumanReadableSatellitePosition($position);

        return $view->render([
            'satelliteLatitude' => $position->getLatitude(),
            'satelliteLongitude' => $position->getLongitude(),
            'humanReadablePosition' => $humanReadableSatellitePosition,
        ]);
    }
}