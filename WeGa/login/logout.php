<?php
session_start();

// Distrugerea sesiunii
session_destroy();

// Redirecționare către pagina de login sau altă pagină relevantă
header("Location: ../Acasa.html");
exit();
