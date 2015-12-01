<?php
// src/AppBundle/Entity/Team.php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 *
 * Defines the properties of the User entity to represent the application users.
 * See http://symfony.com/doc/current/book/doctrine.html#creating-an-entity-class
 *
 * Tip: if you have an existing database, you can generate these entity class automatically.
 * See http://symfony.com/doc/current/cookbook/doctrine/reverse_engineering.html
 *
 * @author Pedro Data <mail@pedrodata.com>
 * 
 */
class Team {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id_team;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name_team;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $status_team;
    
    public function getIdteam() {
        return $this->id_team;
    }
    public function getNameteam() {
        return $this->name_team;
    }
    public function getStatus() {
        return $this->status_team;
    }
    public function setIdteam($id_team) {
        $this->id_team = $id_team;
    }
    public function setNameteam($name_team) {
        $this->name_team = $name_team;
    }
    public function setStatus($status) {
        $this->status_team  = $status;
    }
}
?>