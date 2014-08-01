<?php
/**
 * LoginAudit
 *
 * Add plugins to build
 *
 * @package loginaudit
 * @subpackage build
 */

$plugs = array(
    'loginaudit' => array(
        'desc' => 'Record every manager login / logout',
        'events' => array(
            'OnManagerLogin',
            'OnBeforeManagerLogout',
        ),
    ),
);

$plugins = array();
$i = 0;

foreach($plugs as $key => $pl) {
    $i++;
    $sfilename = strtolower($key);
    $file = $sources['plugins'].'plugin.' . $sfilename . '.php';
    $plugins[$i]= $modx->newObject('modPlugin');
    $plugins[$i]->fromArray(array(
        'id' => $i,
        'name' => $key,
        'description' => $pl['desc'],
        'plugincode' => getSnippetContent($file),
        'category' => 0,
        /*'static' => 1,
        'static_file' => str_replace(MODX_ROOT, '', $file),*/
    ), '', true, true);

    $events = array();
    foreach ($pl['events'] as $event) {
        $events[$event] = $modx->newObject('modPluginEvent');
        $events[$event]->fromArray(array(
            'event' => $event,
            'priority' => 0,
            'propertyset' => 0,
        ), '', true, true);
    }

    if (is_array($events) && !empty($events)) {
        $plugins[$i]->addMany($events);
        $modx->log(xPDO::LOG_LEVEL_INFO, 'Packaged in '.count($events).' Plugin Events for ' . $key);
        flush();
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, 'Could not find plugin events for ' . $key);
    }
    unset($events);
}

return $plugins;
