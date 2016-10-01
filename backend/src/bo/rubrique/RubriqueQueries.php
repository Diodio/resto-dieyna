<?php

namespace Rubrique;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class RubriqueQueries {
    /*
     *
     */

    private $entityManager;
    private $classString;

    /*
     *
     */

    public function __construct() {
        $this->entityManager = Bootstrap::$entityManager;
        $this->classString = 'Rubrique\Rubrique';
    }

   
    public function insert($rubrique) {
        if ($rubrique != null) {
            Bootstrap::$entityManager->persist($rubrique);
            Bootstrap::$entityManager->flush();
            return $rubrique;
        }
    }

    public function update($rubrique) {
        if ($rubrique != null) {
            Bootstrap::$entityManager->merge($rubrique);
            Bootstrap::$entityManager->flush();
            return $rubrique;
        }
    }
    
    public function delete($rubriqueId) {
        $rubrique = $this->findById($rubriqueId);
        if ($rubrique != null) {
            Bootstrap::$entityManager->remove($rubrique);
            Bootstrap::$entityManager->flush();
            return $rubrique;
        } else {
            return null;
        }
    }

    public function findById($achatId) {
        if ($achatId != null) {
            return Bootstrap::$entityManager->find('Rubrique\Rubrique', $achatId);
        }
    }

    public function retrieveAll($offset, $rowCount, $orderBy = "", $sWhere = "") {
        if($sWhere !== "")
            $sWhere = " where " . $sWhere;
            $sql = 'select distinct(id), code, libelle
                    from rubrique' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayContact [$i] [] = $value ['id'];
            $arrayContact [$i] [] = $value ['code'];
            $arrayContact [$i] [] = $value ['libelle'];
            $arrayContact [$i] [] = $value ['id'];
            $i++;
        }
        return $arrayContact;
    }

    public function view($rubriqueId, $supp = null) {
        $sql = "SELECT distinct(id), code, libelle FROM rubrique WHERE id=" . $rubriqueId . " ";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $rubrique = $stmt->fetch();
        if($rubrique!=null)
            return $rubrique;
        return NULL;
    }

    public function count($sWhere = "") {
       if($sWhere !== "")
            $sWhere = " where " . $sWhere;
             $sql = 'select count(id) as nbRubriques
                    from rubrique ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbRubriques'];
    }

   
    
public function findRubriqueDetails($rubriqueId) {
        if ($rubriqueId != null) {
            $sql = 'SELECT * from rubrique, mareyeur where mareyeur.id=achat.mareyeur_id and achat.id=' . $rubriqueId;
            $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
            $stmt->execute();
            $achat = $stmt->fetchAll();
            if ($achat != null)
                return $achat;
            else
                return null;
        }
    }
    public function getEntityManager() {
        return $this->entityManager;
    }

    
}
