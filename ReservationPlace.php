<?php
// api/src/Entity/ReservationPlace.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
/**
 * Réservation d'une place par un utilisateur. Il indique la période de location 
 * désirée.
 * Il peut cliquer sur payer pour valider la commande. La case à cocher permet de 
 * régler avec son compte Blagapark. Une transaction bancaire est crée lors que le
 * paiement est bien exécuté.
 * Il peut cliquer sur Contacter pour discuter avec le bailleur. Le paiement 
 * intervient alors dans un second temp.
 * La réservation n'est confirmée QUE lorsque le paiment est bien exécuté.
 * 
 *
 * @ORM\Entity
 * @ApiResource
 */
class ReservationPlace
{
    /**
     * @var int l'identifiant de la réservation de la place.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
     /* @ORM\Column(type="date")
     *  @var DateTime  Date de début de la réservation au format "Y-m-d H:i:s"..
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $startDateTime;
     /* @ORM\Column(type="date")
     *  @var DateTime  Date de fin de la réservation au format "Y-m-d H:i:s"..
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $endDateTime;
     /**
     * @ORM\Column(type="boolean")
     * @var boolean Le paiement a-t-il été effectué ?
     */
    public $isPaid;
     /* @ORM\Column(type="date")
     *  @var DateTime  Heure de création de la réservation.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $creationDateTime; 

    /*-------------------------->  ASSOCIATIONS <-----------------------------*/      
    /**
     * @var ParkingPlace Place qui est l'objet de la réservation.
     * @ORM\ManyToOne(targetEntity="ParkingPlace", inversedBy="ReservationPlaces")
     */
      public $ParkingPlace;
     /**
     * @var UserBlagapark Utilisateur qui a réservé la place.
     *
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ReservationsPlaces")
     */
      public $UserBlagapark;
     /**
     * @var MessageReservation[] Liste messages échangés par le bailleur et le locataire.autour de cette réservation.
     * @ORM\OneToMany(targetEntity="MessageReservation", mappedBy="ReservationPlace", cascade={"persist", "remove"})
     */
    public $Messages;
     /**
     * @var BankTransaction Transaction financière entre le bailleur et le locataire pour le paiement de la place.
     * @ORM\OneToOne(targetEntity="BankTransaction", mappedBy="ReservationPlace", cascade={"persist", "remove"})
     */
    public $Transaction;
    
      /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/  
    public function __construct(ParkingPlace $pParkingPlace, UserBlagapark $pUserBlagapark, 
            DateTime $pStartDateTime, DateTime $pEndDateTime)
    {
        //Caractéristiques de la réservation
        $this->startDateTime = $pStartDateTime;
        $this->endDateTime = $pEndDateTime;
        $this->isPaid = false;
        // associations
        $this->Messages = new ArrayCollection();
        // horodatage de la réservation
        $this->creationDateTime = new \DateTime("now");
    }
    
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/    
     public function getId(): ?int
    {
        return $this->id;
    }
      
    
}
?>