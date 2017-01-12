<?php

require_once '../../common/app.php';
require_once App::AUTOLOAD;
$lang = 'fr';

use Article\Article as Article;
use Article\ArticleManager as ArticleManager;
use Bo\BaseController as BaseController;
use Bo\BaseAction as BaseAction;
use Log\Loggers as Logger;
use Exceptions\ConstraintException as ConstraintException;
use App as App;

class ArticleController extends BaseController implements BaseAction {

    private $parameters;
    private $logger;

    function __construct($request) {
        $this->logger = new Logger(__CLASS__);
        $this->parameters = parse_ini_file("../../../../lang/trad_fr.ini");
        try {
            if (isset($request['ACTION'])) {
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
            $article = new Article();
            $articleManager = new ArticleManager();
            $rubriqueManager = new Rubrique\RubriqueManager();
            if ($request['rubriqueId'] != '') {
                $rubrique = $rubriqueManager->findById($request['rubriqueId']);
                if ($rubrique != NULL) {
                    $isExist=$articleManager->isExist($request['rubriqueId'],$request['libelle']);
                    if($isExist==NULL){
                    $article->setRubrique($rubrique);
                    $article->setLibelle($request['libelle']);
                    $article->setLogin($request['login']);
                    $articleAdded = $articleManager->insert($article);
                    if ($articleAdded->getId() != null) {
                        $this->doSuccess($articleAdded->getId(), 'Article enregistré avec succes');
                    } else {
                        $this->doError('-1', 'impossible d\'inserer cet article');
                    }
                    }
                    else{
                        $this->doError('-1', 'Cet article existe déja');
                    }
                } else {
                    $this->doError('-1', 'Veuillez choisir une rubrique SVP.');
                }
            } else {    
                $this->doError('-1', 'impossible d\'inserer cet article');
            }
        } catch (Exception $e) {
            throw new Exception('Erreur lors du traitement de votre requete');
        }
    }

    public function doUpdate($request) {
        
    }

    public function doList($request) {
        try {
            $articleManager = new ArticleManager();
            if (isset($request['iDisplayStart']) && isset($request['iDisplayLength'])) {
                // Begin order from dataTable
                $sOrder = "";
                $aColumns = array('a.libelle', 'r.libelle');
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
                        $sWhere .= " AND (";
                        for ($i = 0; $i < count($aColumns); $i++) {
                            $sWhere .= "(" . $aColumns[$i] . " LIKE '%" . $sSearchs[$j] . "%') OR";
                            if ($i == count($aColumns) - 1)
                                $sWhere = substr_replace($sWhere, "", -3);
                        }
                        $sWhere = $sWhere .=")";
                    }
                }
                // End filter from dataTable
                $produits = $articleManager->retrieveAll($request['iDisplayStart'], $request['iDisplayLength'], $sOrder, $sWhere);
                if ($produits != null) {
                    $nbArticles = $articleManager->count($sWhere);
                    $this->doSuccessO($this->dataTableFormat($produits, $request['sEcho'], $nbArticles));
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
        $this->logger->log->info('Action Remove article');
        $this->logger->log->info(json_encode($request));
        try {
            if (isset($request['articleIds'])) {
                $this->logger->log->info('Remove with params : ' . $request['articleIds']);
                $articleIds = $request['articleIds'];
                $articleManager = new ArticleManager();
                $nbModified = $articleManager->delete($articleIds);
                if ($nbModified != NULL)
                    $this->doSuccess($nbModified, $this->parameters['REMOVED']);
                else
                    $this->doError('-1', 'Impossible de supprimer cet article');
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

}

$oArticleController = new ArticleController($_REQUEST);
