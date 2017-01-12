<?php

namespace Article;

use Racine\Bootstrap as Bootstrap;
use Exception as Exception;

class ArticleQueries {
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
        $this->classString = 'Article\Article';
    }

   
    public function insert($article) {
        if ($article != null) {
            Bootstrap::$entityManager->persist($article);
            Bootstrap::$entityManager->flush();
            return $article;
        }
    }

    public function findById($articleId) {
        if ($articleId != null) {
            return Bootstrap::$entityManager->find('Article\Article', $articleId);
        }
    }
    
    public function delete($articleId) {
        $article = $this->findById($articleId);
        if ($article != null) {
            Bootstrap::$entityManager->remove($article);
            Bootstrap::$entityManager->flush();
            return $article;
        } else {
            return null;
        }
    }

   
    public function findAll() {
        $clientRepository = Bootstrap::$entityManager->getRepository($this->classString);
        $clients = $clientRepository->findAll();
        return $clients;
    }

   
    public function retrieveAll($offset, $rowCount, $orderBy = "", $sWhere = "") {
//        if($sWhere !== "")
//            $sWhere = " where " . $sWhere;
            $sql = 'select distinct(a.id), a.libelle libelleArticle, r.libelle libelleRubrique
                    from article a, rubrique r WHERE r.id=a.rubrique_id   ' . $sWhere . ' group by id ' . $orderBy . ' LIMIT ' . $offset . ', ' . $rowCount.'';
            
        $sql = str_replace("`", "", $sql);
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll();
        $arrayContact = array();
        $i = 0;
        foreach ($products as $key => $value) {
            $arrayContact [$i] [] = $value ['libelleRubrique'];
            $arrayContact [$i] [] = $value ['libelleArticle'];
            $arrayContact [$i] [] = $value ['id'];
            $i++;
        }
        return $arrayContact;
    }
    
    public function view($contactId, $supp = null) {
        $contactd = $this->findAllById($contactId);
        if ($contactd->getValidate() == true) {
            $sql = "SELECT distinct(c.id), c.firstName, c.lastName, c.cellular, c.email, co.code, co.indicative FROM Contact\Contact c, Common\Country co WHERE c.id=" . $contactId . " and c.status=1 and c.cellular like concat(co.indicative, '%') ";
        } else {
            $sql = "SELECT distinct(c.id), c.firstName, c.lastName, c.cellular, c.email FROM Contact\Contact c WHERE c.id=" . $contactId . " and c.status=1  ";
        }
        $query = Bootstrap::$entityManager->createQuery($sql);
        try {
            $contact = $query->getSingleResult();
            return $contact; 
        } catch (Exception $e) {  
            return null;
        }
    }

    
    public function count($sWhere = "") {
//       if($sWhere !== "")
//            $sWhere = " where " . $sWhere;
             $sql = 'select count(a.id) nbArticles
                    from article a, rubrique r WHERE r.id=a.rubrique_id  ' . $sWhere . '';
       
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $nbClients = $stmt->fetch();
        return $nbClients['nbArticles'];
    }

   

    public function getEntityManager() {
        return $this->entityManager;
    }

    public function isExist($rubriqueId, $libelle) {
        $sql = "SELECT id  FROM article where rubrique_id='$rubriqueId' and libelle = '$libelle'";
        $stmt = Bootstrap::$entityManager->getConnection()->prepare($sql);
        $stmt->execute();
        $article = $stmt->fetch();
        if ($article != null)
            return $article;
        else
            return null;
    }
    
    
    
   
}
