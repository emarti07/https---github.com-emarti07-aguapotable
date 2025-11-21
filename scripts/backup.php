<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../models/BackupModel.php';
$pdo = getPDO();
$b = new BackupModel($pdo);
$pathJson = $b->exportJSON();
$pathSql = $b->exportSQL();
echo "Backups creados:\nJSON: $pathJson\nSQL: $pathSql\n";
