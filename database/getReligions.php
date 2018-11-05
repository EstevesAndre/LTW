<?php
    function getAllReligions()
    {
        global $dbRel;
        $stmt = $dbRel->prepare("SELECT * FROM religion ORDER BY rel_type");
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>