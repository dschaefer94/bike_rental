<?php

namespace lmd\Model;

use lmd\Library\Msg;

class CustomerModel extends Database
{
    public function __construct()
    {
    }

    public function deleteCustomer($id)
    {
        try {
            //TODO: Buchungshistorie wird durch "xx-deleted-user-xx" ersetzt, nicht gelöscht, Rollback?
            $pdo = $this->linkDB();
            $stmt = $pdo->prepare("DELETE FROM customer WHERE id = :id");
            $stmt->execute([
                ':id' => $id
            ]);
            return new Msg(false, '');
        } catch (\PDOException $e) {
            return new Msg(true, 'Löschen des Benutzers nicht möglich', $e);
        }
    }
}