<?php


require_once '../../common/app.php';
require_once App::AUTOLOAD;         
$lang='fr';

use Rubrique\Rubrique as Rubrique;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Rubrique\RubriqueManager as RubriqueManager;
use Exceptions\ConstraintException as ConstraintException;
use Log\Loggers as Logger;
use App as App;
                        
class RubriqueController extends BaseController implements BaseAction {

    
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
                        case \App::ACTION_LIST:
                                $this->doList($request);
                                break;
                        case \App::ACTION_LIST_VALID:
                                $this->doGetListRubrique($request);
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
        try {
            $rubrique = new Rubrique();
            $rubriqueManager = new RubriqueManager;
            $existedCode = $rubriqueManager->findByCode($request['code']);
            if ($existedCode == 0) {
                $rubrique->setCode($request['code']);
                $rubrique->setLibelle($request['libelle']);
                $rubrique->setLogin($request['login']);
                $Added = $rubriqueManager->insert($rubrique);
                if ($Added->getId() != null) {
                    $this->doSuccess($Added->getId(), 'Rubrique enregistré avec succes');
                } else {
                    $this->logger->log->info('Impossible de modifier cette rubrique');
                    $this->doError('-1', 'Impossible de modifier cette rubrique');
                }
            } else {
                $this->logger->log->info('Ce code éxiste déja');
                $this->doError('-1', 'Ce code éxiste déja');
            }
        } catch (Exception $e) {
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doUpdate($request) {
        $this->logger->log->info('Action update rubrique');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['rubriqueId'])) {
                $rubriqueManager = new RubriqueManager();
                $rubrique = $rubriqueManager->findById($request['rubriqueId']);
                $rubrique->setCode($request['code']);
                $rubrique->setLibelle($request['libelle']);
                $rubrique->setLogin($request['login']);
                $updated = $rubriqueManager->update($rubrique);
                if ($updated != NULL)
                    $this->doSuccess($rubrique->getId(), 'Rubrique modifiée avec succes');
                else {
                    $this->logger->log->info('Impossible de modifier cette rubrique');
                    throw new Exception('Impossible de modifier cette rubrique');
                }
            } else {
                 $this->logger->log->trace('View : Paramètres insuffisants');
                 throw new Exception('Paramètres insuffisants');
            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doList($request) {
        try {
            $rubriqueManager = new RubriqueManager();
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
                    $sSearchs = explode(" ", $request['sSearch']);
                    for ($j = 0; $j < count($sSearchs); $j++) {
                        $sWhere .= " ";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                       // $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $produits = $rubriqueManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbRubriques = $rubriqueManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbRubriques));
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
        $this->logger->log->info('Action Remove rubrique');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['rubriqueIds'])) {
                $this->logger->log->info('Remove with params : ' . $request['rubriqueIds']);
                $rubriqueIds = $request['rubriqueIds'];
                $rubriqueManager = new RubriqueManager();
                $nbModified = $rubriqueManager->delete($rubriqueIds);
                $this->doSuccess($nbModified, 'Rubrique supprimée avec succes');
            } else {
                $this->logger->log->trace('View : Paramètres insuffisants');
                throw new Exception('Paramètres insuffisants');
            }
        }  catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

    public function doView($request) {
        $this->logger->log->info('Action view contact');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['rubriqueId'])) {
                $this->logger->log->info('View params : ' . $request['rubriqueId']);
                $rubriqueManager = new RubriqueManager();
                $rubrique = $rubriqueManager->view($request['rubriqueId']);
                $this->logger->log->info('View : ' . $request['rubriqueId']);
                $this->doSuccessO($rubrique);
            } else {
                $this->logger->log->trace('View : Paramètres insuffisants');
                throw new Exception('Paramètres insuffisants');
            }
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw $e;
        } catch (Exception $e) {
            $this->logger->log->trace($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            throw new Exception('Erreur lors du traitement de votre requette');
        }
    }

public function doViewDetails($request) {
        try {
            if (isset($request['achatId'])) {
                $achatManager = new AchatManager();
                $achatDetails = $achatManager->findAchatDetails($request['achatId']);
                if ($achatDetails != null)
                    $this->doSuccessO($achatDetails);
                else
                    echo json_encode(array());
            } else {
                $this->doError('-1', 'Chargement detail achat impossible');
            }
        } catch (Exception $e) {
            $this->doError('-1', 'ERREUR_SERVEUR');
        }
    }
    
    public function doGetListRubrique($request) {
        try {
                $rubriqueManager = new RubriqueManager();
                $rubrique = $rubriqueManager->retrieveAllRubriques();
                if($rubrique !=null)
                    $this->doSuccessO($rubrique);
                else
                   echo json_encode(array());  
            
        } catch (Exception $e) {
            throw new Exception('Erreur lors du traitement de votre requette');
        } 
    }
}

        $oRubriqueController = new RubriqueController($_REQUEST);