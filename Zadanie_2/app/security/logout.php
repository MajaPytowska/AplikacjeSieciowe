<?php
require_once dirname(__FILE__).'/../../config.php';

// Zakończenie sesji
session_start();
session_destroy();


header("Location: "._APP_URL); // przekierowanie na stronę główną