<?php

namespace Vente;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="vente") * */
class Vente {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
     /**
     * @Column(type="string", length=60, nullable=false, unique=true)
     * */
    protected $numero;
    
   /** @Column(type="datetime", nullable=true) */
    public $date;
    
   /** @Column(type="decimal", scale=2, precision=10, nullable=false) */
    public $montant;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;
    
    /** @OneToMany(targetEntity="Rubrique\Rubrique", mappedBy="rubrique") */
    public $rubrique;
    
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getDate() {
        return $this->date;
    }

    function getMontant() {
        return $this->montant;
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

    function getArticle() {
        return $this->article;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setMontant($montant) {
        $this->montant = $montant;
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

    function setArticle($article) {
        $this->article = $article;
    }

            /** @PrePersist */
    public function doPrePersist() {
    	$this->status = 0;
    	$this->createdDate = new \DateTime("now");
    	$this->updatedDate = new \DateTime("now");
    }

    }




