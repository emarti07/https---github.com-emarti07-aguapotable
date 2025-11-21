<?php
class ClientModel {
  protected $pdo;
  public function __construct(PDO $pdo){ $this->pdo = $pdo; }
  public function getAll(){
    $stmt = $this->pdo->query('SELECT id, name, phone FROM clients ORDER BY id DESC');
    return $stmt->fetchAll();
  }
  public function getById($id){
    $stmt = $this->pdo->prepare('SELECT * FROM clients WHERE id = :id');
    $stmt->execute(['id'=>$id]);
    return $stmt->fetch();
  }
  public function create($data){
    $stmt = $this->pdo->prepare('INSERT INTO clients (name, phone, address) VALUES (:name, :phone, :address)');
    $stmt->execute(['name'=>$data['name'],'phone'=>$data['phone'] ?? null,'address'=>$data['address'] ?? null]);
    return $this->pdo->lastInsertId();
  }
  public function update($id,$data){
    $stmt = $this->pdo->prepare('UPDATE clients SET name=:name, phone=:phone, address=:address WHERE id=:id');
    return $stmt->execute(['name'=>$data['name'],'phone'=>$data['phone'] ?? null,'address'=>$data['address'] ?? null,'id'=>$id]);
  }
  public function delete($id){
    $stmt = $this->pdo->prepare('DELETE FROM clients WHERE id=:id');
    return $stmt->execute(['id'=>$id]);
  }
  public function countAll(){
    $stmt = $this->pdo->query('SELECT COUNT(*) as c FROM clients');
    $r = $stmt->fetch(); return $r ? (int)$r['c'] : 0;
  }
}