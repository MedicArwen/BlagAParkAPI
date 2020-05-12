<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * This is a dummy entity. Remove it!
 *
 * @ApiResource
 * @ORM\Entity
 */
class UserBlagapark
{
    /**
     * @var int entity identificator
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
/**
     * @ORM\Column(type="integer")
     * @var int Mode d'authentification de l'utilisateur dans firebase (0:email, 1:fb,2:twitter,3:google)
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 0,
     *      max = 3,
     *      minMessage = "le mode doit être compris entre 0 et 3 (0:email, 1:fb,2:twitter,3:google).",
     *      maxMessage = "le mode doit être compris entre 0 et 3 (0:email, 1:fb,2:twitter,3:google)."
     * )
     */
      public $authModeFirebase;
    
     /**
     * @ORM\Column(type="string")
     * @var string Identifiant de l'utilisateur dans firebase (doit être conforme à la norme RFC 4122).
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Uuid
     */
    public $uidFirebase;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Dernier token généré par firebase lors de la connexion
     * @Assert\NotBlank
     */
    public $authTokenFirebase;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Prénom et le nom de l'utilisateur
     * @Assert\NotBlank
     */
    public $DisplayName;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Texte descriptif parlant de l'utilisateur pour humaniser la présentation
     * @Assert\NotBlank
     *      
     */
    public $about;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Url de la photo d'avatar de l'utilisateur
     * @Assert\Url
     */
    public $urlPicture;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Numéro de téléphone de l'utilisateur
     */
    public $phoneNumber;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Adresse email de l'utilisateur
     * @Assert\Email
     */
    public $email;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Identifiant facebook
     
     */
    public $contactFacebook;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Identifiant twitter
     */
    public $contactTwitter;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Adresse googlemail
     */
    public $contactGoogle;
     /**
     * @ORM\Column(type="string",nullable=true)
     * @var string|null Adresse postale de l'utilisateur
     */
    public $postalAdress;
 
    /*------------------------->  ASSOCIATIONS <-----------------------------*/
    
    /**
     * @var Favori[] Liste des places favorites enregistrées par l'utilisateur.
     * @ORM\OneToMany(targetEntity="Favori", mappedBy="UserBlagapark", cascade={"persist", "remove"})
     */
    public $Favoris;
    
     /**
     * @var ParkinPlace[] Liste des places proposées par l'utilisateur.
     *
     * @ORM\OneToMany(targetEntity="ParkingPlace", mappedBy="UserBlagapark", cascade={"persist", "remove"})
     */
    public $ParkingPlaces;
    
     /**
     * @var ReservationPlace[] Liste des places proposées par l'utilisateur comme bailleur.
     *
     * @ORM\OneToMany(targetEntity="ReservationPlace", mappedBy="UserBlagapark", cascade={"persist", "remove"})
     */
    public $ReservationsPlaces;   
    /**
     * @var BankTransaction Liste des transactions impliquant l'utilisateur comme bailleur.
     *
     * @ORM\OneToMany(targetEntity="BankTransaction", mappedBy="Bailleur", cascade={"persist", "remove"})
     */
    public $TransactionsBailleur;
    /**
     * @var BankTransaction Liste des transactions impliquant l'utilisateur comme locataire.
     *
     * @ORM\OneToMany(targetEntity="BankTransaction", mappedBy="Locataire", cascade={"persist", "remove"})
     */
    public $TransactionsLocataire;
    
    public function __construct(int $pAuthModeFirebase,string $pUidFirebase)
    {
        $this->Favoris = new ArrayCollection();
        $this->ParkingPlaces = new ArrayCollection();
        $this->ReservationsPlaces = new ArrayCollection();
        $this->TransactionsBailleur = new ArrayCollection();
        $this->TransactionsLocataire = new ArrayCollection();
        $this->authModeFirebase = $pAuthModeFirebase;
        $this->uidFirebase = $pUidFirebase;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
 
}
