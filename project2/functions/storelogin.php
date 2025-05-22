<?php
    function storeLogin($host, $user, $pswd, $dbnm, $dir, $file, $umask) {         
        // sets umask
        $oldMask = umask();
        umask($umask);
        // check dir exists
        if (!file_exists($dir)) {  
            if (!mkdir($dir, umask())) {
                $e = new \Exception;
                die("<p>Failure: An unexpected error occured when attempting to store database information.</p>"
                    . "<p>Error Description: " . print_r(error_get_last()) . ")</p>"
                    . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
            }
        }
        // restore umask
        umask($oldMask);

        // check file exists
        if (!$handle = fopen($file, "w")) {
            $e = new \Exception;
            die("<p>Failure: An unexpected error occured when attempting to store database information.</p>"
            . "<p>Error Description: " . print_r(error_get_last()) . ")</p>"
            . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
        }

        // save data as php file
        $data = "<?php\n"
            . "\t" . '$host' . " = " . '"' . $host . '"' . ";\n"
            . "\t" . '$user' . " = " . '"' . $user . '"' . ";\n"
            . "\t" . '$pswd' . " = " . '"' . $pswd . '"' . ";\n"
            . "\t" . '$dbnm' . " = " . '"' . $dbnm . '"' . ";\n"
            . "?>";
        
        // write data to file
        if (!fwrite($handle, $data)) {
            $e = new \Exception;
            die("<p>Failure: An unexpected error occured when attempting to store database information.\n"
                . "Error Description: " . print_r(error_get_last()) . ")</p>\n"
                . "<pre>". var_dump($e->getTraceAsString()) . "</pre>");
        }
        fclose($handle);
    }
?>