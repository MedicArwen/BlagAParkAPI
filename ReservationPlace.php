<?php
// api/src/Entity/ReservationPlace.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * Un utilisateur de l'application Blagapark.
 *
 * @ORM\Entity
 */
class ReservationPlace
{
    /**
     * @var int l'identifiant du favori de l'utilisateur.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /* @ORM\Column(type="date")
     * @var string la place a-t-elle été supprimée?
     */
    public $startDate;
     /* @ORM\Column(type="date")
     * @var string la place a-t-elle été supprimée?
     */
    public $endDate;
     /* @ORM\Column(type="time")
     * @var string la place a-t-elle été supprimée?
     */
    public $startHour;
     /* @ORM\Column(type="time")
     * @var string la place a-t-elle été supprimée?
     */
    public $endHour;
    
    
    
    /**
     * @var ParkingPlace utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="ParkingPlace", inversedBy="ReservationPlaces")
     */
      public $ParkingPlace;
      /**
     * @var ParkingPlace utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ReservationsPlaces")
     */
      public $UserBlagapark;
      
       /**
     * @var MessageReservation[] Liste des places favorites enregistrées par l'utilisateur.
     *
     * @ORM\OneToMany(targetEntity="MessageReservation", mappedBy="ReservationPlace", cascade={"persist", "remove"})
     */
    public $Messages;
    
     /**
     * @var BankTransaction Transaction financière entre le bailleur et le locataire pour le paiement de la place.
     *
     * @ORM\OneToOne(targetEntity="BankTransaction", mappedBy="ReservationPlace", cascade={"persist", "remove"})
     */
    public $Transaction;
     public function getId(): ?int
    {
        return $this->id;
    }
      
    public function __construct()
    {
        $this->Messages = new ArrayCollection();
    }
}
?>