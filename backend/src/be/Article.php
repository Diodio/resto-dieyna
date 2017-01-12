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

namespace Article;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="article", uniqueConstraints={@UniqueConstraint(name="article_idx", columns={"rubrique_id", "libelle"})}) * */
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

    function getRubrique() {
        return $this->rubrique;
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

    function setRubrique($rubrique) {
        $this->rubrique = $rubrique;
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
    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
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
