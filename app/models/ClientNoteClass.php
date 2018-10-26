<?php

class ClientNoteClass {
    public $noteID;
    public $clientID;
    public $submitterName;
    public $submitterNote;
    public $submitDate;
    
    public function __construct($row) {
        $this->noteID = isset($row['noteID']) ? $row['noteID'] : null;
        $this->clientID = isset($row['clientID']) ? $row['clientID'] : null;
        $this->submitterName = isset($row['submitterName']) ? $row['submitterName'] : null;
        $this->submitterNote = isset($row['submitterNote']) ? $row['submitterNote'] : null;
        $this->submitDate = isset($row['submitDate']) ? $row['submitDate'] : null;
    }
    
    public function create() {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $dateToday = date('Y-m-d');
        $sql = 'INSERT INTO ClientNote (clientID, submitterName, submitterNote, submitDate) VALUES (?,?,?,?)';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute (
            [
                $this->clientID,
                $this->submitterName,
                $this->submitterNote,
                $dateToday
            ]
        );
        
        $this->noteID = $db->lastInsertId();
        $this->submitDate = $dateToday;
    }
    
    public static function getClientNoteData($anID) {
        $db = new PDO(DB_SERVER, DB_USER, DB_PW);
        $sql = 'SELECT * FROM ClientNote WHERE clientID = ?;';
        $pdoStatement = $db->prepare ($sql);
        $connection = $pdoStatement->execute ([$anID]);
        $arrayOfNotes = [];
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $aNote = new ClientNoteClass($row);
            array_push($arrayOfNotes, $aNote);
        }
        return $arrayOfNotes;
    }
}