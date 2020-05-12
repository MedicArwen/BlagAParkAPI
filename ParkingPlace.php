<?php
// api/src/Entity/ParkingPlace.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * Un utilisateur de l'application Blagapark.
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
     * @ORM\Column(type="string",nullable=true)
     * @var string|null des indications pour trouver la place
     */
    public $howFindMe;
         /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null une idée des disponibilités de la place
     */
    public $disponibility;
         /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null l'url d'une photo de la place
     */
    public $urlPicture;
         /**
     * @ORM\Column(type="decimal")
     * @var float prix horaire de la place
     */
    public $pricePerHour;
         /**
     * @ORM\Column(type="boolean")
     * @var boolean place pour moto?
     */
    public $canMoto;
           /**
     * @ORM\Column(type="boolean")
     * @var boolean place pour voiture et caravane?
     */
    public $canCaravane;
           /**
     * @ORM\Column(type="boolean")
     * @var boolean place pour camion?
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
    
     /**
     * @var User utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ParkingPlaces")
     */
    public $UserBlagapark;
        /**
     * @var ParkingPlaceDispo[] Liste des places proposées par l'utilisateur.
     *
     * @ORM\OneToMany(targetEntity="ParkingPlaceDispo", mappedBy="ParkingPlace", cascade={"persist", "remove"})
     */
    public $ParkingPlaceDispos;
    
         /**
     * @var ParkingPlaceDispo[] Liste des places proposées par l'utilisateur.
     *
     * @ORM\OneToMany(targetEntity="ReservationPlace", mappedBy="ParkingPlace", cascade={"persist", "remove"})
     */
    public $ReservationPlaces;
    
    public function __construct()
    {
        $this->$ParkingPlaceDispos = new ArrayCollection();
        $this->ReservationPlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
}
?>