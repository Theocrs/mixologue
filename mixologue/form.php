<?php
    include 'config.php';

    $queryTableSaveurs = $connDB->prepare('CREATE TABLE IF NOT EXISTS saveurs (id INT(10) NOT NULL, nom VARCHAR(50), PRIMARY KEY(id))');
    $queryInsertSaveurs = $connDB->prepare('INSERT IGNORE INTO saveurs (id, nom)
     VALUES (1, "Abricot"), (2, "Caramel"), (3, "Cerise"), 
     (4, "Grenadine"), (5, "Ananas"), (6, "Cassis"), 
     (7, "Passion"), (8, "Fruit du dragon"), 
     (9, "Brownie"), (10, "Beurre de cacahuète"), 
     (11, "Kiwi"), (12, "Rhum"), (13, "Menthe pacha"), 
     (14, "Guimauve"), (15, "Barbe à papa"), (16, "Violette"), 
     (17, "Banane"), (18, "Crème anglaise")');
     $queryTableSaveurs->execute();
     $queryInsertSaveurs->execute();

     $queryAllSaveurs = $connDB->prepare('SELECT * FROM saveurs');
     $queryAllSaveurs->execute();
     $resultAllSaveurs = $queryAllSaveurs->fetchAll(PDO::FETCH_ASSOC);

     $queryTableRecettes = $connDB->prepare('CREATE TABLE IF NOT EXISTS recettes (id INT(10) NOT NULL, nom VARCHAR(50), sav1 VARCHAR(50), sav2 VARCHAR(50), sav3 VARCHAR(50), sav4 VARCHAR(50), sav5 VARCHAR(50), pourc1 VARCHAR(10), pourc2 VARCHAR(10), pourc3 VARCHAR(10), pourc4 VARCHAR(10), pourc5 VARCHAR(10), PRIMARY KEY(id))');
     $queryInsertRecettes = $connDB->prepare('INSERT IGNORE INTO recettes (id, nom, sav1, sav2, sav3, sav4, sav5, pourc1, pourc2, pourc3, pourc4, pourc5)
      VALUES (1, "Exotic Abricot", "Abricot", "Cassis", "Passion", "Fruit du dragon", "", "50%", "10%", "10%", "30%", ""), 
      (2, "Uzumaki", "Caramel", "Brownie", "Beurre de cacahuète", "", "", "60%", "20%", "20%", "", ""), 
      (3, "Cerise Fusion", "Ananas", "Cerise", "Kiwi", "Rhum", "Menthe pacha", "10%", "30%", "20%", "20%", "20%"), 
      (4, "Le Castard", "Grenadine", "Guimauve", "Barbe à papa", "", "", "50%", "30%", "20%", "", ""), 
      (5, "Toulousin", "Violette", "Banane", "Crème anglaise", "", "", "10%", "45%", "45%", "", "")');
      $queryTableRecettes->execute();
      $queryInsertRecettes->execute();

      $queryAllRecettes = $connDB->prepare('SELECT * FROM recettes');
      $queryAllRecettes->execute();
      $resultAllRecettes = $queryAllRecettes->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($_POST['récapitulatif'])) {
        $recap = $_POST['récapitulatif'];
    }
?>