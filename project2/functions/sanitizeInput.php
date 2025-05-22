<?php
    /**
     * Takes a string input, removing leading or trailing: whitespace; backslashes, and formats HTML special characters. 
     * Hopefully, nullifies any attempted user manipulation of the PHP Code.
     *
     * @param string $input value to sanitize
     * 
     * @return string $output sanitized $input
     */
    function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $output = $input;
        return $output;
    }
?>