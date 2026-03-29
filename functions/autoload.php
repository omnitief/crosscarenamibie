<?php
foreach (glob(__DIR__ . "/classes/*.php") as $filename) {
	require_once $filename;
}

foreach (glob(__DIR__ . "/hooks/*.php") as $filename) {
	require_once $filename;
}

foreach (glob(__DIR__ . "/hooks/style/*.php") as $filename) {
	require_once $filename;
}

foreach(glob(__DIR__ . '/*.php') as $filename) {
	require_once $filename;
}

foreach(glob(__DIR__ . '/acf/*.php') as $filename) {
	require_once $filename;
}