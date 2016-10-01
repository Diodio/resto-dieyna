<?php

/*
 * 2SMOBILE 
 * ----------------------------------------
 *  @author     Kiwi <pathe.gueye@kiwi.sn>
 *  @copyright  2006-2015 Kiwi/2SI Partner
 *  @version    2.0.0
 *  @link       http://www.kiwi.sn
 *  @link       http://www.ssi.sn
 * ----------------------------------------
 */

namespace Rubrique;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="article") * */
class Article {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
      
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $libelle;
    
    /**
     *  @ManyToOne(targetEntity="Rubrique\Article", inversedBy="rubrique") 
     * @JoinColumn(name="rubrique_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $rubrique;
    
     /**
     * @Column(type="decimal", scale=2, precision=10,nullable=false)
     * */
    protected $prixUnitaire;
    
    /** @Column(type="datetime", nullable=true) */
    public $createdDate;

    /** @Column(type="datetime", nullable=true) */
    public $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    public $deletedDate;
    
    

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
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

    function getRubrique() {
        return $this->rubrique;
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

    function setRubrique($rubrique) {
        $this->rubrique = $rubrique;
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
