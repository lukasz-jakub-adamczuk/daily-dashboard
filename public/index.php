<?php

// error_reporting(E_ALL);
// iniset('display_error', 1);

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('APP_DIR', dirname(__DIR__));


require_once APP_DIR . '/vendor/smarty-3.1.29/libs/Smarty.class.php';

$smarty = new Smarty();

$smarty->setTemplateDir(APP_DIR . '/templates');
$smarty->setCompileDir(APP_DIR . '/templates_c');

// echo APP_DIR;


// loading events
$events = file_get_contents(APP_DIR . '/events/days-sample.yml');

require_once APP_DIR . '/vendor/yaml/sfYamlParser.php';

$sfYamlParser = new sfYamlParser();

$allEvents = $sfYamlParser->parse($events);

// echo 'aaa';

// var_dump($allEvents);

// echo jddayofweek(2, 1);

$today = date('Y-m-d');

$todayInfo = getdate();

$thisWeekEvents = [];

foreach ($allEvents as $mk => $month) {
    if (is_array($month)) {
        foreach ($month as $dk => $day) {
            // print_r($day);
            // if (strtolower($mk) == $todayInfo['month']) {
                // foreach ($month as $day) {
                    // echo $day;
            echo substr($today, 8, 2);
            foreach ($day as $ek => $event) {
                $thisWeekEvents[] = $event . '<span> (' . $dk . ')</span>';
                if ($dk == substr($today, 8, 2)) {
                    $todayEvents[] = $event . '<span> (' . $dk . ')</span>';
                }
            }
        }
    }
}

// print_r($thisWeekEvents);
$smarty->assign('today', $today);

$smarty->assign('todayEvents', $todayEvents);
$smarty->assign('thisWeekEvents', $thisWeekEvents);

$thisWeek = [];

$today = new DateTime();

// print_r($today);



// print_r($todayInfo);


// echo 'aaa';
// $this


function getWeekFrame($date = null) {
    if (is_null($date)) {
        $date = date('Y-m-d');
    }

    // echo $date.', ';

    $dateInfo = getdate(strtotime($date));
    $weekFrame = [];
    // print_r($dateInfo);

    $daysToInterval = [7, 1, 2, 3, 4, 5, 6];
    
    // week starts
    $interval = $daysToInterval[$dateInfo['wday']];

    $fromDate = new DateTime($date);
    $fromDate->sub(new DateInterval('P'.($interval-1).'D'));
    $weekFrame['from'] = $fromDate->format('Y-m-d');

    // week ends
    $interval = 7 - $daysToInterval[$dateInfo['wday']];

    // echo $dateInfo['wday'].', ';
    // echo $interval.', ';

    $toDate = new DateTime($date);
    
    $toDate->add(new DateInterval('P'.$interval.'D'));
    $weekFrame['to'] = $toDate->format('Y-m-d');

    // print_r($toDate);

    // $toDate->sub(new DateInterval('P7D'));
    // $weekFrame['from'] = $toDate->format('Y-m-d');

    return $weekFrame;
}

// print_r(getWeekFrame());

$week = getWeekFrame();

// var_dump($week);
$smarty->assign('thisWeek', $week);
// a

// echo $week['from'];
$dateTime = new DateTime($week['from']);

$dateTime->sub(new DateInterval('P1D'));
    // $weekFrame['from'] = ;
// echo strtotime($week['from']);
    // echo $dateTime->format('Y-m-d');

$week = getWeekFrame($dateTime->format('Y-m-d'));

$smarty->assign('lastWeek', $week);

// var_dump($week);
// 
// print_r($todayInfo);
// print_r($thisWeek);

// 7 - 1

// loading templates
// $html = file_get_contents(APP_DIR . '/public/_index.html');

// $html

// echo $html;

$smarty->display('index.tpl');

?>