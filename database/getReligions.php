<?php
    function getAllReligions()
    {
        global $dbRel;
        $stmt = $dbRel->prepare("SELECT * FROM channel ORDER BY cType");
        $stmt->execute();
        return $stmt->fetchAll();
    }
?>