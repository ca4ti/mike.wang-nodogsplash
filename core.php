<?php
    class SQLite extends SQLite3
    {
        function __construct()
        {
            $this->open('index.db');
        }

        function __destruct()
        {
            echo $this->close();
        }
    }
?>