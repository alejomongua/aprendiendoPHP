<?php

function renderView(string $view) {
  require_once __DIR__ . '/../views/' . $view . '.php';
}
