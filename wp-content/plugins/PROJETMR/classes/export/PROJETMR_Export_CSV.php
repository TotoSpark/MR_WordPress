<?php

$path =__DIR__;
preg_match('/(.*)wp\-content/i', $path, $dir);
require_once(end($dir) .'wp-load.php');

function trimming(string $val): string {
    return trim($val);
}

global $wpdb;

$sql = "SELECT A.*, 
            (SELECT B.`valeur` FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='firstname' LIMIT 1) AS 'firstname', 
            (SELECT B.`valeur` FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='email' LIMIT 1) AS 'email',
            (SELECT B.`valeur` FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_subscribersdata' . " B WHERE B.`id`=A.`id` AND B.`cle`='lastname' LIMIT 1) AS 'lastname'
            FROM " . $wpdb->prefix . PROJETMR_BASENAME . '_subscribers' . " A ";

$inscrits = $wpdb->get_results($sql, 'ARRAY_A');

ob_start();

header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private', false);
header('Content-Type: text/csv; charset=UTF-8');

$heads = array (
    'firstname',
    'lastname',
    'email',
);

print '"'.implode ('"; "', $heads). "\"\n";

foreach ($inscrits as $inscrit):

    $inscrit = array_map('trimming', $inscrit);

    $fields = array(
        (string) mb_strtoupper($inscrit['firstname'], 'UTF-8'),
        (string) $inscrit['lastname'],
        (string) strtolower( $inscrit['email']),
    );

    print '"'.implode ('"; "', $fields). "\"\n";
endforeach;

$filename = sprintf('Export_PROJETMR_subscribersdata_%s.csv', date('d-m-Y_His'));
header('Content-Disposition: attachment; filename="' .$filename . '";');
header('Content-Transfer-Encoding: binary');

ob_end_flush();

