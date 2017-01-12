<?php


require_once '../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Produit\Produit as Produit;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Produit\ProduitManager as ProduitManager;
use Rubrique\RubriqueManager as RubriqueManager;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use App as App;
                        
class ProduitController extends BaseController implements BaseAction {

    
    private $parameters;
    private $logger;
            function __construct($request) {
       
       $this->logger = new Logger(__CLASS__);
        $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if(isset($request['ACTION'])) 
                {
                    switch ($request['ACTION']) {
                        case \App::ACTION_INSERT:
                                $this->doInsert($request);
                                break;
                        case \App::ACTION_UPDATE:
                                $this->doUpdate($request);
                                break;
                        case \App::ACTION_VIEW:
                                $this->doView($request);
                                break;
                        case \App::ACTION_VIEW_DETAILS:
                                $this->doViewDetails($request);
                                break;
                        case \App::ACTION_LIST:
                                $this->doList($request);
                                break;
                        case \App::ACTION_REMOVE:
                                $this->doRemove($request);
                                break;
                    }
            } else {
                throw new Exception($this->parameters['NO_ACTION']);
            }
        } catch (Exception $e) {
            $this->doError('-1', $e->getMessage());
        }
    }

    public function doInsert($request) {
        $this->logger->log->info('Action insert produit');
        $this->logger->log->info(json_encode($request));
        try {
            $produit = new Produit();
            $produitManager = new ProduitManager();
            $produit->setCode($request['code']);
            $produit->setLibelle($request['libelle']);
            $produit->setLogin($request['login']);
            $produitExist = $produitManager->findProduitsByCode($request['code']);
            if ($produitExist == NULL){
                $produitAdded = $produitManager->insert($produit);
            if ($produitAdded->getId() != null) {
                $this->doSuccess($produitAdded->getId(), 'Produit enregistré avec succes');
            } else {
                $this->doError('-1','impossible d\'inserer ce produit');
            }
            }
            else {
                $this->doError('-1', 'Ce produit existe déja');
            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doUpdate($request) {
        $this->logger->log->info('Action Update contact');
        $this->logger->log->info(json_encode($request));
          try {
            $produitManager = new ProduitManager();
            $produit = $produitManager->findById($request['produitId']);
            $produit->setCode($request['code']);
            $produit->setLibelle($request['libelle']);
            $produit->setLogin($request['login']);
//            $produitExist = $produitManager->findProduitsByCode($request['code']);
//            if ($produitExist == NULL){
                $produitAdded = $produitManager->update($produit);
            if ($produitAdded->getId() != null) {
                $this->doSuccess($produitAdded->getId(), 'Produit mis a jour avec succes');
            } else {
                $this->doError('-1','impossible de modifier ce produit');
            }
//            }
//            else {
//                $this->doError('-1', 'Ce produit existe déja');
//            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doList($request) {
        try {
            $produitManager = new ProduitManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('code', 'libelle');
                if (isset($request['iSortCol_0'])) {
                    $sOrder = "ORDER BY  ";
                    for ($i = 0; $i < intval($request['iSortingCols']); $i++) {
                        if ($request['bSortable_' . intval($request['iSortCol_' . $i])] == "true") {
                            $sOrder .= "" . $aColumns[intval($request['iSortCol_' . $i])] . " " .
                                    ($request['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                        }
                    }

                    $sOrder = substr_replace($sOrder, "", -2);
                    if ($sOrder == "ORDER BY") {
                        $sOrder = "";
                    }
                }
                // End order from DataTable
                // Begin filter from dataTable
                $sWhere = "";
                if (isset($request['sSearch']) && $request['sSearch'] != "") {
                    //$sWhere." and ";
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $produits = $produitManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbProduits = $produitManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbProduits));
                } else {
                    $this->doSuccessO($this->dataTableFormat(array(), $request['sEcho'], 0));
                }
            } else {
                 throw new Exception('list failed');
            }
        } catch (Exception $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception('ERREUR SERVEUR');
        }
    }

    public function doRemove($request) {
        $this->logger->log->info('Action Remove produit');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['produitIds'])) {
                $this->logger->log->info('Remove with params : ' . $request['produitIds']);
                $produitIds = $request['produitIds'];
                $produitManager = new ProduitManager();
                $nbModified = $produitManager->delete($produitIds);
                $this->doSuccess($nbModified, $this->parameters['REMOVED']);
            } else {
                $this->logger->log->trace('Remove : Params not enough');
                throw new Exception('Paramètres insuffisants');
            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doView($request) {
        $this->logger->log->info('Action view contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['contactId'])) {
                $this->logger->log->info('View params : ' . $request['contactId']);
                $contactManager = new ContactManager();
                $contact = $contactManager->view($request['contactId']);
                $contactAddManager = new ContactAddManager();
                $contactAdd = $contactAddManager->retrieveAll($request['contactId']);
                $array['contact'] = (array) $contact;
                if (count($contactAdd) != 0) {
                    $array['addChamp'] = (array) $contactAdd;
                }
                // $this->logger->log->info('View contact with cellular'.$contact['cellular']);
                $this->doSuccessO($array);
            } else {
                $this->logger->log->trace('View : Params not enough');
                throw new ConstraintException($this->parameters['PARAM_NOT_ENOUGH']);
            }
        } catch (ConstraintException $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception($this->parameters['ERREUR_SERVEUR']);
        }
    }

    public function doViewDetails($request) {
        try {
            if (isset($request['produitId']) && $request['produitId']!=='') {
                $produitManager = new ProduitManager();
                $produitDetails = $produitManager->findProduduitDetails($request['produitId']);
                if ($produitDetails != null)
                    $this->doSuccessO($produitDetails);
                else
                    echo json_encode(array());
            } else {
                $this->doError('-1', 'Impossible de charger les details du produit');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'Erreur lors du traitement de votre requette');
        }
    }
    

}

        $oProduitController = new ProduitController($_REQUEST);