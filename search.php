<?php
$events = [];
require("config.php");
//var_dump($_POST);
if (isset($_POST['submit'])) {
    if (isset($_GET['go'])) {
        $search = htmlentities($_POST['search'], ENT_QUOTES, 'UTF-8');
        //print_r("post = ".$search);

        $sql = ("SELECT * FROM steder
        LEFT JOIN info ON steder.sted_id = info.sted_id
        WHERE upper(kategori) LIKE upper ('%$search%')
        OR UPPER (navn) LIKE upper ('%$search%') 
        OR upper (beskrivelse) LIKE upper ('%$search%')
        ")
        or die("could not search");

        $res = $connection->query($sql);
        $num_rows = $res->fetchColumn();
        $result;
        if ($num_rows == 0) {
            $result = 'there was no search results for "' . $search . '"';
        } else {
            $result = 'Resultater for "' . $search . '"';
            $statement = $connection->prepare($sql);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $events[] = $row;
            }

        }
    }
}
