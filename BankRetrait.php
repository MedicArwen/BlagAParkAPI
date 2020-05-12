<?php
// api/src/Entity/BankRetrait.php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * L’utilisateur peut voir le montant disponible sur son compte Blagapark et 
 * demander à ce qu’une somme soit virée sur son compte bancaire ou son PayPal 
 * suivant ce qui est configuré. Il saisi la somme, celle-ci est déduite du 
 * compte et le virement ajouté à la liste des virements à réaliser manuellement 
 * plus tard (liste dans le backoffice). Une liste des demandes de virement 
 * permet de suivre les demandes. Il est indiqué également les paiements de 
 * locations réalisées via le compte Blagapark
 *
 * @ORM\Entity
 * @ApiResource
 */
class BankRetrait
{
   /**
     * @var int Identifiant automatiquement généré de la transaction bancaire.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
   
     /* @ORM\Column(type="date")
     *  @Assert\DateTime
     *  @Assert\NotBlank
     *  @var DateTime Date de la demande de retrait au format "Y-m-d H:i:s".
     */
    public $dateRetrait;
     /* @ORM\Column(type="float")
     *  @var float Montant de la transaction?
     *  @Assert\GreaterThanOrEqual(0)
     *  @Assert\NotBlank
     */
    public $amount;
     /* @ORM\Column(type="boolean")
     *  @var boolean Le virement a-t-il été fait par le backoffice?
     */
    public $isExecuted;
    /* @ORM\Column(type="date")
     *  @Assert\DateTime
     *  @var DateTime Date d'exécution du virement par le backoffice au format "Y-m-d H:i:s".
     */
    public $dateExecution;
 
    
     /*------------------------->  ASSOCIATIONS <-----------------------------*/
     /**
     * @var UserBlagapark Utilisateur qui est dans la transaction en tant que locataire.
     * @ORM\ManyToOne(targetEntity="UserBlagapark", inversedBy="Retraits")
     * @Assert\NotBlank
     * @Assert\NotNull
     */
      public $UserBlagapark;
      
    /*------------------------>  CONSTRUCTEUR(S) <----------------------------*/
        public function __construct(UserBlagapark $pUserBlagapark,float $pAmmount)
    {
        // vérification de la légitimité de la transaction
        // TODO
        //Détails de la transaction
        $this->amount = $pAmmount;
        $this->dateRetrait = new \DateTime("now");
        $this->isExecuted = false;     
        $this->dateExecution = "";
        // Associations 
        $this->UserBlagapark = $pUserBlagapark;    
    }
      
    /*----------------------->  GETTERS ET SETTERS <--------------------------*/      
     public function getId(): ?int
    {
        return $this->id;
    }
}
?>