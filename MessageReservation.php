<?php
// api/src/Entity/Message.php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Message échangé autour d'une réservation. Cela forme une conversation propre à
 * la réservation.
 *
 * @ORM\Entity
 * @ApiResource
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
     * @var DateTime Date de création du message par l'utilisateur.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $dateMessage;
     /* @ORM\Column(type="text")
     * @var string texte du message envoyé par l'utilisateur.
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    public $texteMessage;
     /* @ORM\Column(type="boolean")
     * @var boolean Le message a-t-il été lu par une personne qui n'est pas son auteur
     */
    public $isRead;

    /*-------------------------->  ASSOCIATIONS <-----------------------------*/  
    /**
     * @var ReservationPlace Réservation à laquelle est liée le présent message.
     * @ORM\ManyToOne(targetEntity="ReservationPlace", inversedBy="Messages")
     */
      public $ReservationPlace;
      /**
     * @var UserBlagapark Utilisateur qui est auteur du message.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="ReservationsPlaces")
     */
      public $UserBlagapark;
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
    public function __construct(DateTime $pDateMessage,string $pTexteMessage)
    {
        $this->dateMessage = $pDateMessage;
        $this->texteMessage = $pTexteMessage;
        $this->isRead = false;
    }
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/
     public function getId(): ?int
    {
        return $this->id;
    }
    
    }
?>