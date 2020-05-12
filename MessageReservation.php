<?php
// api/src/Entity/Message.php

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
class MessageReservation
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
    public $dateMessage;
     /* @ORM\Column(type="text")
     * @var string la place a-t-elle été supprimée?
     */
    public $texteMessage;
     /* @ORM\Column(type="boolean")
     * @var boolean la place a-t-elle été supprimée?
     */
    public $isRead;
   
    
    
    /**
     * @var ParkingPlace utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="ReservationPlace", inversedBy="Messages")
     */
      public $ReservationPlace;
      /**
     * @var ParkingPlace utilisateur qui a créé le favoris.
     *
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ReservationsPlaces")
     */
      public $UserBlagapark;
      
     public function getId(): ?int
    {
        return $this->id;
    }
    
    }
?>