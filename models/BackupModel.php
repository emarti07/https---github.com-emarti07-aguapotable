<?php
class BackupModel {
  protected $pdo;
  public function __construct(PDO $pdo){ $this->pdo = $pdo; }

  // Export all tables to a JSON file (simple and portable)
  public function exportJSON($path = null){
    $path = $path ?: __DIR__.'/../backups/backup_'.date('Ymd_His').'.json';
    if(!is_dir(dirname($path))) mkdir(dirname($path), 0755, true);

    $tables = $this->getTables();
    $data = [];
    foreach($tables as $t){
      $stmt = $this->pdo->query('SELECT * FROM `'.$t.'`');
      $data[$t] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    return $path;
  }

  // Export simple SQL inserts for each table
  public function exportSQL($path = null){
    $path = $path ?: __DIR__.'/../backups/backup_'.date('Ymd_His').'.sql';
    if(!is_dir(dirname($path))) mkdir(dirname($path), 0755, true);

    $tables = $this->getTables();
    $out = '';
    foreach($tables as $t){
      $stmt = $this->pdo->query('SELECT * FROM `'.$t.'`');
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($rows as $r){
        $cols = array_map(function($c){ return "`$c`"; }, array_keys($r));
        $vals = array_map([$this->pdo, 'quote'], array_values($r));
        $out .= "INSERT INTO `{$t}` (".implode(',', $cols).") VALUES (".implode(',', $vals).");\n";
      }
      $out .= "\n";
    }
    file_put_contents($path, $out);
    return $path;
  }

  protected function getTables(){
    $stmt = $this->pdo->query('SHOW TABLES');
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);
    return array_map(function($r){ return $r[0]; }, $rows);
  }
}