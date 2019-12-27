<?php
    class SQLite extends SQLite3
    {
        function __construct()
        {
            $this->open('/home/fastfree/index.db');
        }

        function __destruct()
        {
            $this->close();
        }
    }
?>