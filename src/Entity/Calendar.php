<?php

namespace App\Entity;

use App\Repository\CalendarRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalendarRepository::class)
 */
class Calendar
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $day;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="calendars")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Day::class, mappedBy="calendar_day")
     */
    private $calendar_idDay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDay(): ?\DateTimeInterface
    {
        return $this->day;
    }

    public function setDay(\DateTimeInterface $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCalendarIdDay(): ?Day
    {
        return $this->calendar_idDay;
    }

    public function setCalendarIdDay(?Day $calendar_idDay): self
    {
        $this->calendar_idDay = $calendar_idDay;

        return $this;
    }
}
