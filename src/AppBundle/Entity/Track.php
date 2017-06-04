<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Track
 *
 * @ORM\Table(name="track")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TrackRepository")
 * @Vich\Uploadable
 */
class Track
{
    /**
     * Hook timestampable behavior
     * updates createdAt, updatedAt fields
     */
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="string", length=8)
     */
    private $length;

    /**
     * @Vich\UploadableField(mapping="track_files", fileNameProperty="mp3Name")
     * 
     * @var File
     */
    private $mp3File;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $mp3Name;

    /**
     * @ORM\Column(type="boolean", options={"default": 1})
     *
     * @var boolean
     */
    private $isVisible = true;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;    

    /**
     * Get position
     * @return  
     */
    public function getPosition()
    {
        return $this->position;
    }
    
    /**
     * Set position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get isVisible
     * @return  
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }
    
    /**
     * Set isVisible
     * @return $this
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;
        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $mp3
     *
     * @return Product
     */
    public function setMp3File(File $mp3 = null)
    {
        $this->mp3File = $mp3;

        if ($mp3) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }

    /**
     * @return File|null
     */
    public function getMp3File()
    {
        return $this->mp3File;
    }

    /**
     * @param string $mp3Name
     *
     * @return Product
     */
    public function setMp3Name($mp3Name)
    {
        $this->mp3Name = $mp3Name;
        
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMp3Name()
    {
        return $this->mp3Name;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Track
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set length
     *
     * @param string $length
     *
     * @return Track
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string
     */
    public function getLength()
    {
        return $this->length;
    }

}

