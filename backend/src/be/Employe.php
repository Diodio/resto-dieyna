<?php

namespace Employe;

/** @Entity @HasLifecycleCallbacks 
 * @Table(name="employe") * */
class Employe {

    /** @Id
     * @Column(type="integer"), @GeneratedValue
     */
    protected $id;
    
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $reference;
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $nom;
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $adresse;
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $contact;
    
    /**
     * @Column(type="string", length=160, nullable=false)
     * */
    protected $salaire;
    
    
    
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

    function getReference() {
        return $this->reference;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getContact() {
        return $this->contact;
    }

    function getSalaire() {
        return $this->salaire;
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

    function setReference($reference) {
        $this->reference = $reference;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setContact($contact) {
        $this->contact = $contact;
    }

    function setSalaire($salaire) {
        $this->salaire = $salaire;
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




