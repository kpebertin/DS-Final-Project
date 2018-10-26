<?php

$aClientNote = new ClientNoteClass($_POST);
$aClientNote->create();
echo json_encode($aClientNote);