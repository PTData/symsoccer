<?php
// src/AppBundle/Entity/Player.php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 * @author Pedro Data <mail@pedrodata.com>
 */
class Player {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $status_player;
    /**
     * @ORM\Column(type="string", length=120)
     */
    protected $name_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $age_player;
    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $position_player;
    /**
     * @ORM\Column(type="decimal", length=20)
     */
    protected $value_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $quality_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $number_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $id_team_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $condition_player;
    /**
     * @ORM\Column(type="integer")
     */
    protected $forma_player;
    /**
     * @ORM\Column(type="smallint", length=2)
     */
    protected $situation;

    /**
     * Get idPlayer
     *
     * @return integer
     */
    public function getIdPlayer()
    {
        return $this->id_player;
    }

    /**
     * Set statusPlayer
     *
     * @param integer $statusPlayer
     *
     * @return Player
     */
    public function setStatusPlayer($statusPlayer)
    {
        $this->status_player = $statusPlayer;

        return $this;
    }

    /**
     * Get statusPlayer
     *
     * @return integer
     */
    public function getStatusPlayer()
    {
        return $this->status_player;
    }

    /**
     * Set namePlayer
     *
     * @param string $namePlayer
     *
     * @return Player
     */
    public function setNamePlayer($namePlayer)
    {
        $this->name_player = $namePlayer;

        return $this;
    }

    /**
     * Get namePlayer
     *
     * @return string
     */
    public function getNamePlayer()
    {
        return $this->name_player;
    }

    /**
     * Set agePlayer
     *
     * @param integer $agePlayer
     *
     * @return Player
     */
    public function setAgePlayer($agePlayer)
    {
        $this->age_player = $agePlayer;

        return $this;
    }

    /**
     * Get agePlayer
     *
     * @return integer
     */
    public function getAgePlayer()
    {
        return $this->age_player;
    }

    /**
     * Set positionPlayer
     *
     * @param string $positionPlayer
     *
     * @return Player
     */
    public function setPositionPlayer($positionPlayer)
    {
        $this->position_player = $positionPlayer;

        return $this;
    }

    /**
     * Get positionPlayer
     *
     * @return string
     */
    public function getPositionPlayer()
    {
        return $this->position_player;
    }

    /**
     * Set valuePlayer
     *
     * @param string $valuePlayer
     *
     * @return Player
     */
    public function setValuePlayer($valuePlayer)
    {
        $this->value_player = $valuePlayer;

        return $this;
    }

    /**
     * Get valuePlayer
     *
     * @return string
     */
    public function getValuePlayer()
    {
        return $this->value_player;
    }

    /**
     * Set qualityPlayer
     *
     * @param integer $qualityPlayer
     *
     * @return Player
     */
    public function setQualityPlayer($qualityPlayer)
    {
        $this->quality_player = $qualityPlayer;

        return $this;
    }

    /**
     * Get qualityPlayer
     *
     * @return integer
     */
    public function getQualityPlayer()
    {
        return $this->quality_player;
    }

    /**
     * Set numberPlayer
     *
     * @param integer $numberPlayer
     *
     * @return Player
     */
    public function setNumberPlayer($numberPlayer)
    {
        $this->number_player = $numberPlayer;

        return $this;
    }

    /**
     * Get numberPlayer
     *
     * @return integer
     */
    public function getNumberPlayer()
    {
        return $this->number_player;
    }

    /**
     * Set idTeamPlayer
     *
     * @param integer $idTeamPlayer
     *
     * @return Player
     */
    public function setIdTeamPlayer($idTeamPlayer)
    {
        $this->idTeam_player = $idTeamPlayer;

        return $this;
    }

    /**
     * Get idTeamPlayer
     *
     * @return integer
     */
    public function getIdTeamPlayer()
    {
        return $this->idTeam_player;
    }

    /**
     * Set conditionPlayer
     *
     * @param integer $conditionPlayer
     *
     * @return Player
     */
    public function setConditionPlayer($conditionPlayer)
    {
        $this->condition_player = $conditionPlayer;

        return $this;
    }

    /**
     * Get conditionPlayer
     *
     * @return integer
     */
    public function getConditionPlayer()
    {
        return $this->condition_player;
    }

    /**
     * Set formaPlayer
     *
     * @param integer $formaPlayer
     *
     * @return Player
     */
    public function setFormaPlayer($formaPlayer)
    {
        $this->forma_player = $formaPlayer;

        return $this;
    }

    /**
     * Get formaPlayer
     *
     * @return integer
     */
    public function getFormaPlayer()
    {
        return $this->forma_player;
    }

    /**
     * Set situation
     *
     * @param integer $situation
     *
     * @return Player
     */
    public function setSituation($situation)
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * Get situation
     *
     * @return integer
     */
    public function getSituation()
    {
        return $this->situation;
    }
}
