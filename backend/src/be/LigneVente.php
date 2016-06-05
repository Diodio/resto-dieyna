<?php

namespace Vente;

/** @Entity @HasLifecycleCallbacks
 * @Table(name="ligne_vente") * */
class LigneVente {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="integer", nullable=false)
     * */
    protected $nombre;
    
    /**
     * @Column(type="decimal", scale=2, precision=10, nullable=false)
     * */
    protected $quantite;
    
   

    /**
     *  @ManyToOne(targetEntity="Rubrique\Article", inversedBy="article") 
     * @JoinColumn(name="article_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $article;

    /** @ManyToOne(targetEntity="Vente\Vente", inversedBy="vente") 
     * @JoinColumn(name="vente_id", referencedColumnName="id",
      onDelete="CASCADE") */
    protected $vente;
    
    /** @Column(type="datetime", nullable=true) */
    protected $createdDate;

    /** @Column(type="datetime", nullable=true) */
    protected $updatedDate;

    /** @Column(type="datetime", nullable=true) */
    protected $deletedDate;

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getArticle() {
        return $this->article;
    }

    function getVente() {
        return $this->vente;
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

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setArticle($article) {
        $this->article = $article;
    }

    function setVente($vente) {
        $this->vente = $vente;
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
        $this->createdDate = new \DateTime("now");
        $this->updatedDate = new \DateTime("now");
    }

}
