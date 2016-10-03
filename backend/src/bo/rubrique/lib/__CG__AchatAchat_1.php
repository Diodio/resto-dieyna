<?php

namespace DoctrineORM\Proxies\__CG__\Achat;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Achat extends \Achat\Achat implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array('dateAchat' => NULL, 'heureReception' => NULL, 'datePaiement' => NULL, 'produit' => NULL, 'reglement' => NULL);



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->dateAchat, $this->heureReception, $this->datePaiement, $this->produit, $this->reglement);

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * 
     * @param string $name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', array($name));

            return $this->$name;
        }

        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);
    }

    /**
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', array($name, $value));

            $this->$name = $value;

            return;
        }

        $this->$name = $value;
    }

    /**
     * 
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', array($name));

            return isset($this->$name);
        }

        return false;
    }

    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'numero', 'dateAchat', 'heureReception', 'poidsTotal', 'montantTotal', 'reliquat', 'transport', 'modePaiement', 'numCheque', 'datePaiement', 'codeUsine', 'login', 'produit', 'reglement', 'status', 'regle', 'createdDate', 'updatedDate', 'deletedDate', 'mareyeur');
        }

        return array('__isInitialized__', 'id', 'numero', 'poidsTotal', 'montantTotal', 'reliquat', 'transport', 'modePaiement', 'numCheque', 'codeUsine', 'login', 'status', 'regle', 'createdDate', 'updatedDate', 'deletedDate', 'mareyeur');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Achat $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->dateAchat, $this->heureReception, $this->datePaiement, $this->produit, $this->reglement);
        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumero()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumero', array());

        return parent::getNumero();
    }

    /**
     * {@inheritDoc}
     */
    public function getDateAchat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateAchat', array());

        return parent::getDateAchat();
    }

    /**
     * {@inheritDoc}
     */
    public function getProduit()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProduit', array());

        return parent::getProduit();
    }

    /**
     * {@inheritDoc}
     */
    public function setId($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', array($id));

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function setNumero($numero)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumero', array($numero));

        return parent::setNumero($numero);
    }

    /**
     * {@inheritDoc}
     */
    public function setDateAchat($dateAchat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateAchat', array($dateAchat));

        return parent::setDateAchat($dateAchat);
    }

    /**
     * {@inheritDoc}
     */
    public function setProduit($produit)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProduit', array($produit));

        return parent::setProduit($produit);
    }

    /**
     * {@inheritDoc}
     */
    public function getPoidsTotal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPoidsTotal', array());

        return parent::getPoidsTotal();
    }

    /**
     * {@inheritDoc}
     */
    public function getMontantTotal()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMontantTotal', array());

        return parent::getMontantTotal();
    }

    /**
     * {@inheritDoc}
     */
    public function getModePaiement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getModePaiement', array());

        return parent::getModePaiement();
    }

    /**
     * {@inheritDoc}
     */
    public function getNumCheque()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNumCheque', array());

        return parent::getNumCheque();
    }

    /**
     * {@inheritDoc}
     */
    public function setPoidsTotal($poidsTotal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPoidsTotal', array($poidsTotal));

        return parent::setPoidsTotal($poidsTotal);
    }

    /**
     * {@inheritDoc}
     */
    public function setMontantTotal($montantTotal)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMontantTotal', array($montantTotal));

        return parent::setMontantTotal($montantTotal);
    }

    /**
     * {@inheritDoc}
     */
    public function setModePaiement($modePaiement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setModePaiement', array($modePaiement));

        return parent::setModePaiement($modePaiement);
    }

    /**
     * {@inheritDoc}
     */
    public function setNumCheque($numCheque)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNumCheque', array($numCheque));

        return parent::setNumCheque($numCheque);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', array());

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', array($status));

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getCodeUsine()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCodeUsine', array());

        return parent::getCodeUsine();
    }

    /**
     * {@inheritDoc}
     */
    public function getLogin()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLogin', array());

        return parent::getLogin();
    }

    /**
     * {@inheritDoc}
     */
    public function setCodeUsine($codeUsine)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCodeUsine', array($codeUsine));

        return parent::setCodeUsine($codeUsine);
    }

    /**
     * {@inheritDoc}
     */
    public function setLogin($login)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLogin', array($login));

        return parent::setLogin($login);
    }

    /**
     * {@inheritDoc}
     */
    public function doPrePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPrePersist', array());

        return parent::doPrePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function getPaiement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPaiement', array());

        return parent::getPaiement();
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedDate', array());

        return parent::getCreatedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedDate', array());

        return parent::getUpdatedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedDate', array());

        return parent::getDeletedDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getMareyeur()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMareyeur', array());

        return parent::getMareyeur();
    }

    /**
     * {@inheritDoc}
     */
    public function setPaiement($paiement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPaiement', array($paiement));

        return parent::setPaiement($paiement);
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedDate($createdDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedDate', array($createdDate));

        return parent::setCreatedDate($createdDate);
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedDate($updatedDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedDate', array($updatedDate));

        return parent::setUpdatedDate($updatedDate);
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedDate($deletedDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedDate', array($deletedDate));

        return parent::setDeletedDate($deletedDate);
    }

    /**
     * {@inheritDoc}
     */
    public function setMareyeur($mareyeur)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMareyeur', array($mareyeur));

        return parent::setMareyeur($mareyeur);
    }

    /**
     * {@inheritDoc}
     */
    public function getHeureReception()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHeureReception', array());

        return parent::getHeureReception();
    }

    /**
     * {@inheritDoc}
     */
    public function setHeureReception($heureReception)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHeureReception', array($heureReception));

        return parent::setHeureReception($heureReception);
    }

    /**
     * {@inheritDoc}
     */
    public function getRegle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRegle', array());

        return parent::getRegle();
    }

    /**
     * {@inheritDoc}
     */
    public function setRegle($regle)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRegle', array($regle));

        return parent::setRegle($regle);
    }

    /**
     * {@inheritDoc}
     */
    public function getReliquat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReliquat', array());

        return parent::getReliquat();
    }

    /**
     * {@inheritDoc}
     */
    public function getReglement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReglement', array());

        return parent::getReglement();
    }

    /**
     * {@inheritDoc}
     */
    public function setReliquat($reliquat)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReliquat', array($reliquat));

        return parent::setReliquat($reliquat);
    }

    /**
     * {@inheritDoc}
     */
    public function setReglement($reglement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReglement', array($reglement));

        return parent::setReglement($reglement);
    }

    /**
     * {@inheritDoc}
     */
    public function getDatePaiement()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDatePaiement', array());

        return parent::getDatePaiement();
    }

    /**
     * {@inheritDoc}
     */
    public function setDatePaiement($datePaiement)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDatePaiement', array($datePaiement));

        return parent::setDatePaiement($datePaiement);
    }

    /**
     * {@inheritDoc}
     */
    public function getTransport()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTransport', array());

        return parent::getTransport();
    }

    /**
     * {@inheritDoc}
     */
    public function setTransport($transport)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTransport', array($transport));

        return parent::setTransport($transport);
    }

}
