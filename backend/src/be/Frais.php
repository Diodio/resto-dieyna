<?php

namespace Frais;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="frais") * */
class Frais {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    
    /** @Column(type="datetime", nullable=false) */
    protected $date;
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $libelle;
    
    /**
     * @Column(type="decimal", scale=2, precision=10,nullable=false)
     * */
    protected $prixUnitaire;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=false)
     * */
    protected $quantite;
    
    /**
     * @Column(type="integer", options={"default":0}) 
     **/
    protected $status;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function getQuantite() {
        return $this->quantite;
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

    function setDate($date) {
        $this->date = $date;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
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

    }




