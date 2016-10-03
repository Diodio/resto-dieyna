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
     *  @ManyToOne(targetEntity="Rubrique\Rubrique", inversedBy="rubrique") 
     * @JoinColumn(name="rubrique_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $rubrique;
    
    /**
     * @Column(type="string", length=60, nullable=false)
     * */
    protected $login;
    
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
    function getRubrique() {
        return $this->rubrique;
    }

    function setRubrique($rubrique) {
        $this->rubrique = $rubrique;
    }

    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
    }



    }
