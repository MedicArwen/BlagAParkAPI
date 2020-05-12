<?php
// api/src/Entity/ParkingPlace.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * Une Place de Parking proposée à la location par un des utilisateurs de Blagapark.
   L’utilisateur doit :
    	Mettre une photo aidant à trouver la place
    	Choisir un prix horaire
    	Indiquer l'adresse
    	Indiquer la latitude et la longitude
    	Indiquer comment trouver la place
    	Décrire les disponibilités de manière générale (en semaine, en journée, par exemple)
    	Choisir les options : 
    •	Recharge électrique, 
    •	Pour moto, 
    •	Pour voiture et caravane, 
    •	Pour poids lourd.
 * 
 * @ApiResource
 * @ORM\Entity
 */
class ParkingPlace
{
    /**
 * @ORM\Id
 * @ORM\Column(type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
*/
    private $id;
    /**
     * @ORM\Column(type="string")
     * @var string Des indications pour trouver la place
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $howFindMe;
    /**
     * @ORM\Column(type="string")
     * @var string Adresse de la place.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $adresse;
     /**
     * @ORM\Column(type="decimal")
     * @var float Latitude de la place.
     * @Assert\NotNull
     */
    public $latitude;
     /**
     * @ORM\Column(type="decimal")
     * @var float Longitude de la place
     * @Assert\NotNull
     */
    public $logitude;
     /**
     * @ORM\Column(type="string")
     * @var string Une idée des disponibilités de la place
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $disponibility;
     /**
     * @ORM\Column(type="string")
     * @var string l'url d'une photo de la place
     * @Assert\Url
     */
    public $urlPicture;
     /**
     * @ORM\Column(type="decimal")
     * @var float prix horaire de la place
     * @Assert\Positive
     */
    public $pricePerHour;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Place éligible pour accueillir une moto?
     */
    public $canMoto;
           /**
     * @ORM\Column(type="boolean")
     * @var boolean Place éligible pour accueillir une voiture et caravane?
     */
    public $canCaravane;
    /**
     * @ORM\Column(type="boolean")
     * @var boolean Place éligible pour accueillir un camion?
     */
    public $canTruck;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Possibilité de recharge electrique?
     */
    public $canEnergyRecharge;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean|null la place a-t-elle été supprimée?
     */
    public $isDeleted;
    
    /*-------------------------->  ASSOCIATIONS <-----------------------------*/  
    /**
     * @var Favori[] Liste des places favorites enregistrées par l'utilisateur.
     * @ORM\OneToMany(targetEntity="Favori", mappedBy="ParkingPlace", cascade={"persist", "remove"})
     */
    public $Favoris;
     /**
     * @var User Utilisateur qui met la place à disposition en tant que BAILLEUR.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ParkingPlaces")
     */
    public $Bailleur;
     /**
     * @var ParkingPlaceDispo[] Liste des disponibilités de la place planifiées par le BAILLEUR.
     * @ORM\OneToMany(targetEntity="ParkingPlaceDispo", mappedBy="ParkingPlace", cascade={"persist", "remove"})
     */
    public $ParkingPlaceDispos;
     /**
     * @var ReservationPlace[] Liste des réservations crées pour cette place par des LOCATAIRES.
     * @ORM\OneToMany(targetEntity="ReservationPlace", mappedBy="ParkingPlace", cascade={"persist", "remove"})
     */
    public $ReservationPlaces;
    
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
    public function __construct(UserBlagapark $pBailleur,string $pAdresse,float $pLatitude,float $pLongitude,
            string $pHowFindMe,string $pDisponibility,string $pUrlPicture, float $pPricePerHour,
            bool $pCanMoto,bool $pCanCaravane,bool $pCanTruck,bool $pCanEnergyRecharge, bool $pIsDeleted)
    {
        //Caractéristiques de la place
        $this->howFindMe =$pHowFindMe;
        $this->adresse =$pAdresse;
        $this->latitude =$pLatitude;
        $this->longitude =$pLongitude;
        $this->disponibility=$pDisponibility;
        $this->urlPicture=$pUrlPicture;
        $this->pricePerHour=$pPricePerHour;
        $this->canMoto=$pCanMoto;
        $this->canCaravane=$pCanCaravane;
        $this->canTruck=$pCanTruck;
        $this->canEnergyRecharge=$pCanEnergyRecharge;
        $this->isDeleted=$pIsDeleted;
        // Associations
        $this->$ParkingPlaceDispos = new ArrayCollection();
        $this->ReservationPlaces = new ArrayCollection();
        $this->Favoris = new ArrayCollection();
        $this->Bailleur = $pBailleur;
        
    }
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/
    public function getId(): ?int
    {
        return $this->id;
    }
    
}
?>