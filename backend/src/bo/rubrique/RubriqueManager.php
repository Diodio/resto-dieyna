<?php

namespace Rubrique;
require_once '../../common/app.php';
use Rubrique\RubriqueQueries as RubriqueQueries;
/**
 * Cette classe communique avec la classe ContactQueries
 * Elle sert d'intermédiaire entre le controleur ContactControleur et les queries 
 * qui se trouve dans ContactQueries
 */


class RubriqueManager {

    private $rubriqueQuery;
   

    public function __construct() {
        $this->rubriqueQuery = new RubriqueQueries();
    }
    
    public function insert($rubrique) {
        $this->rubriqueQuery->insert($rubrique);
    	return $rubrique;
    }
    
    
    public function update($rubrique) {
       return $this->rubriqueQuery->update($rubrique);
    }

 
    public function delete($rubriqueIds) {
        return $this->rubriqueQuery->delete($rubriqueIds);
    }
public function findById($rubriqueId) {
        return $this->rubriqueQuery->findById($rubriqueId);
    }
   
    public function view($rubriqueId) {
        $rubrique = $this->rubriqueQuery->view($rubriqueId);
        return $rubrique;
    }
    
    
   
    public function retrieveAll($offset, $rowCount, $sOrder = "", $sWhere = "") {
        return $this->rubriqueQuery->retrieveAll($offset, $rowCount, $sOrder, $sWhere);
    }

    public function count($where="") {
        return $this->rubriqueQuery->count($where);
    }
    
    public function findAchatDetails($achatId) {
        if ($achatId != null) {
            $achat = $this->achatQuery->findAchatDetails($achatId);
            $ligneAchat = $this->achatQuery->findAllProduitByAchact($achatId);
            $reglement = $this->achatQuery->findReglementByAchat($achatId);
            $achatDetail = array();
            foreach ($achat as $key => $value) {
                // $achatDetail ['id'] = $value ['achat.id'];
                $achatDetail ['numero'] = $value ['numero'];
                $achatDetail ['dateAchat'] = date_format(date_create($value ['dateAchat']), 'd-m-Y');
                $achatDetail ['heureReception'] =  $value ['heureReception'];
                $achatDetail ['nomMareyeur'] = $value ['nom'];
                $achatDetail ['adresse'] = $value ['adresse'];
                $userManager = new \Utilisateur\UtilisateurManager();
                $user = $userManager->findByLogin($value ['login'], $value ['codeUsine']);
                $achatDetail ['user'] = $user;
                $achatDetail ['poidsTotal'] = $value ['poidsTotal'];
                $achatDetail ['montantTotal'] = $value ['montantTotal'];
                $achatDetail ['modePaiement'] = $value ['modePaiement'];
                $achatDetail ['numCheque'] = $value ['numCheque'];
                $achatDetail ['datePaiement'] = $value ['datePaiement'];
                $achatDetail ['regle'] = $value ['regle'];
                $achatDetail ['reliquat'] = $value ['reliquat'];
                $achatDetail ['transport'] = $value ['transport'];
                $achatDetail['ligneAchat'] = $ligneAchat;
                $achatDetail['reglement'] = $reglement;
            }
            return $achatDetail;
        } else
            return null;
    }
    
    public function retrieveAllRubriques() {
       return $this->rubriqueQuery->retrieveAllRubriques();
    }

}
