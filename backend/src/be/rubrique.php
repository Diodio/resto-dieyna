<?php

namespace Rubrique;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="rubrique") * */
class Achat {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    function getId() {
    	return $this->id;
    }
    function setId($id) {
    	$this->id = $id;
    }
    
    /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $code;
    function setCode($code) {
    	$this->code = $code;
    }
    function getCode() {
    	return $this->code;
    }
    
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $libelle;
    function setLibelle($libelle) {
    	$this->libelle = $libelle;
    }
    function getLibelle() {
    	return $this->libelle;
    }
    
    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    public function setStatus($status) {
    	$this->status = $status;
    }
    public function getStatus() {
    	return $this->status;
    }
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;
	public function getCreatedDate() {
    	return $this->createdDate;
    }
    public function setCreatedDate($createdDate) {
    	$this->createdDate = $createdDate;
    }

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;
    public function getUpdatedDate() {
    	return $this->updatedDate;
    }
    public function getUpdatedDate() {
    	return $this->updatedDate;
    }

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    public function setDeletedDate($deletedDate) {
    	$this->deletedDate = $deletedDate;
    }
    public function getDeletedDate() {
    	return $this->deletedDate;
    }
    
    /** @PrePersist */
    public function doPrePersist() {
    	$this->status = 0;
    	$this->createdDate = new \DateTime("now");
    	$this->updatedDate = new \DateTime("now");
    }

    }




