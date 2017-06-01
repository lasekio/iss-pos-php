<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:49
 */

namespace Services;

use Model\SatellitePosition;

class GoogleHumanReadableSatellitePositionProvider implements HumanReadableSatellitePositionProvider
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * GoogleHumanReadableSatellitePositionProvider constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @inheritdoc
     */
    public function getHumanReadableSatellitePosition(SatellitePosition $position)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/geocode/json?latlng=" .
                "{$position->getLatitude()}%2C{$position->getLongitude()}&key={$this->apiKey}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \RuntimeException("cURL Error #: $err");
        }

        $data = json_decode($response, true);

        if (count($data['results']) == 0) {
            return null;
        }

        return $data['results'][0]['formatted_address'];
    }
}