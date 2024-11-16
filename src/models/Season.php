<?php

class Season {
    public static function getCurrentYear() {
        return date("Y");
    }

    public static function getCurrentSeason() {
        $month = (int)date("m");
        if ($month >= 3 && $month <= 5) {
            return "spring";
        } elseif ($month >= 6 && $month <= 8) {
            return "summer";
        } elseif ($month >= 9 && $month <= 11) {
            return "fall";
        } else {
            return "winter";
        }
    }
}
