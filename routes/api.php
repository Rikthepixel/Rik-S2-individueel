<?php
$WebsiteRoot = $_SERVER['DOCUMENT_ROOT'];

Router::Get("/Games", [$WebsiteRoot.\Objects\Controllers\GameController::class, 'GetAll']);
Router::Get("/Games/{:id}/", [$WebsiteRoot.\Objects\Controllers\GameController::class, 'GetSingle']);