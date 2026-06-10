<?php

namespace lmd\Model;

use lmd\Library\Msg;

class BikeModel extends Database
{

    public function __construct()
    {
    }

    public function updateBike($id, $data)
    {
        try {
            $pdo = $this->linkDB();

            $bikeNo = $data['bikeNo'];
            $damage = $data['damage'];
            $sql = "UPDATE bike SET bikeNo = :bikeNo, damage = :damage WHERE id = :id";
            $pdo->prepare($sql)->execute([
                ':bikeNo' => $bikeNo,
                ':damage' => $damage,
                ':id' => $id
            ]);
            return new Msg(false, '');
        } catch (\PDOException $e) {
            return new Msg(true, 'Fehler beim Aktualisieren eines Rades', $e);
        }

    }

    public function writeBike($data)
    {

            $pdo = $this->linkDB();
        try {
            $bikeNo = $data['bikeNo'];
            $bikeTypeId = $data['bikeTypeId'];
            $storeLocationId = $data['storeLocationId'];
            $stmt = $pdo->prepare("INSERT INTO bike (id, bikeNo, bikeTypeId, storeLocationId) VALUES (:id, :bikeNo, :bikeTypeId, :storeLocationId)");
            $stmt->execute([
                ':id' => $this->createUUID(),
                ':bikeNo' => $bikeNo,
                ':bikeTypeId' => $bikeTypeId,
                ':storeLocationId' => $storeLocationId
            ]);
            return new Msg(false, '');
        } catch (\PDOException $e) {
            return new Msg(true, 'Fehler beim Anlegen eines Fahrrades', $e);
        }
    }
}
