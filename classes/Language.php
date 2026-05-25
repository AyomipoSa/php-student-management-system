<?php

require_once __DIR__ . "/Database.php";

class Language {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function all($sort = 'ASC') {

        $sort = strtoupper($sort) === 'DESC' ? 'DESC' : 'ASC';

        $languages = [];

        $sql = "SELECT languageID, languageName 
                FROM languages 
                ORDER BY languageName $sort";

        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $languages[$row['languageID']] = $row['languageName'];

            }
        }

        return $languages;
    }

    public function create($languageName) {

        $stmt = $this->conn->prepare(
            "INSERT INTO languages (languageName)
             VALUES (?)"
        );

        $stmt->bind_param("s", $languageName);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function update($languageID, $languageName) {

        $stmt = $this->conn->prepare(
            "UPDATE languages
             SET languageName = ?
             WHERE languageID = ?"
        );

        $stmt->bind_param("si", $languageName, $languageID);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function delete($languageID) {

        $stmt = $this->conn->prepare(
            "DELETE FROM languages
             WHERE languageID = ?"
        );

        $stmt->bind_param("i", $languageID);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
}

?>