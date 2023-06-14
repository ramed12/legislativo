<?php
if ( ! function_exists('FindString'))
{
    function FindString($haystack, $needle, $offset = 0, &$results = array()) {
        $offset = strpos($haystack, $needle, $offset);
        if($offset === false) {
            return $results;
        } else {
            $results[] = $offset;
            return FindString($haystack, $needle, ($offset + 1), $results);
        }
    }
}
