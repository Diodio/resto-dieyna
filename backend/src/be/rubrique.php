<?php

namespace Rubrique;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="rubrique") * */
class Rubrique {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $code;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $libelle;
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getStatus() {
        return $this->status;
    }

    function getCreatedDate() {
        return $this->createdDate;
    }

    function getUpdatedDate() {
        return $this->updatedDate;
    }

    function getDeletedDate() {
        return $this->deletedDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCreatedDate($createdDate) {
        $this->createdDate = $createdDate;
    }

    function setUpdatedDate($updatedDate) {
        $this->updatedDate = $updatedDate;
    }

    function setDeletedDate($deletedDate) {
        $this->deletedDate = $deletedDate;
    }

        /** @PrePersist */
    public function doPrePersist() {
    	$this->status = 0;
    	$this->createdDate = new \DateTime("now");
    	$this->updatedDate = new \DateTime("now");
    }
    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
    }


    }




