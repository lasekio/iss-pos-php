<?php
/**
 * Created by IntelliJ IDEA.
 * User: billy
 * Date: 01.06.2017
 * Time: 19:15
 */

namespace Repository;


use Model\SatellitePosition;

class RestSatellitePositionRepository implements SatellitePositionRepository
{
    /**
     * @inheritdoc
     */
    public function getSatellitePosition($satelliteId = self::ISS_SATELLITE_ID)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wheretheiss.at/v1/satellites/$satelliteId",
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
            throw new \RuntimeException("Error while fetching the satellite position: $err");
        }

        $rawData = json_decode($response, true);

        return new SatellitePosition($rawData['latitude'], $rawData['longitude']);
    }
}