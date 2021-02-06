<?php

function renderView(string $view) {
  require_once __DIR__ . '/../views/' . $view . '.php';
}

function redirect(string $url) {
  header('location: ' . BASE_URL . $url);
}
