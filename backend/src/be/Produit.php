<?php

namespace Produit;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="produit") * */
class Produit {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
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
    
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deletedDate;
    
    function getId() {
        return $this->id;
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

    
    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
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
        date_default_timezone_set('GMT');
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }


    }
