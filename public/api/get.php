<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../app/start.php';

$test_text = 'I did not understand the topic today.';

$result = SentimentAnalysis::analyseText($test_text);


echo '<h1>This text got result of: ' . $result .  ' </h1>';

exit;