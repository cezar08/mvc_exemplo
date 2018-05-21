<?php
/**
 * Created by PhpStorm.
 * User: unochapeco
 * Date: 09/04/18
 * Time: 21:02
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Application\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @var string
     */
    protected $name;

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function __get($key)
    {
       return $this->$key;
    }

}