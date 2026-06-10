<?php

namespace lmd\Model;

use lmd\Library\Msg;

class BookingModel extends Database
{
    public function __construct()
    {
    }

    public function showBikesForBooking()
    {
        $duration = $_GET['duration'];
        if ($duration < 3) {
            return new Msg(true, 'Zwischen Buchung und Abholung müssen mindestens 3 Tage liegen', null);
        }
        if ($duration > 14) {
            return new Msg(true, 'Die maximale Leihdauer beträgt 14 Tage', null);
        }
        $typ = (isset($_GET['type'])) && $_GET['type'] != '' ? ' AND bikeType.description = :type ' : '';


            $pdo = $this->linkDB();
        try {
            $sql = "SELECT bike.id, bike.bikeNo, bikeType.fee * :duration * :factor as price 
                    FROM bike 
                    INNER JOIN bikeType ON bike.bikeTypeId = bikeType.id 
                    WHERE bike.storeLocationId = :storeLocationId 
                    $typ 
                    AND bike.id NOT IN (
                      SELECT bikeId 
                      FROM booking 
                      WHERE pickupDate <= :return 
                      AND DATE_ADD(pickupDate, INTERVAL days DAY) >= :start
                  )";
            $return = (new \DateTime($_GET['start']))->modify('+' . $duration . ' days');
            $factor = 1;
            if ($duration >= 8) {
                $factor = 0.9;
            }
            if ($duration = 1) {
                $factor = 1.2;
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':start' => $_GET['start'],
                ':return' => $return->format('Y-m-d'),
                ':duration' => $duration,
                ':storeLocationId' => $_GET['storeLocationId'],
                ':type' => $_GET['type'],
                ':factor' => $factor,
            ]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return new Msg(true, 'Fehler beim Abrufen der Fahrräder für die Buchung', $e);
        }
    }
}