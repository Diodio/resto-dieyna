<?php

namespace Approvisionnement;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="approvisionnement") * */
class Approvisionnement {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /** @Column(type="datetime", nullable=true) */
    protected $date;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=false)
     * */
    protected $quantite;
    
    /**
     * @Column(type="decimal", scale=2, precision=10,nullable=false)
     * */
    protected $prixUnitaire;
    
    
    /** @ManyToOne(targetEntity="Produit\Produit", inversedBy="produit", cascade={"persist"}) */
    protected $produit;
    
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

    function getDate() {
        return $this->date;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getType() {
        return $this->type;
    }

    function getProduit() {
        return $this->produit;
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

    function setDate($date) {
        $this->date = $date;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setProduit($produit) {
        $this->produit = $produit;
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

    
    function getPrixUnitaire() {
        return $this->prixUnitaire;
    }

    function setPrixUnitaire($prixUnitaire) {
        $this->prixUnitaire = $prixUnitaire;
    }

    /** @PrePersist */
    public function doPrePersist() {
        date_default_timezone_set('GMT');
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

    /** @PreUpdate */
    public function doPreUpdate() {
        date_default_timezone_set('GMT');
        $this->updatedDate = new \DateTime("now");
    }
   
    }
