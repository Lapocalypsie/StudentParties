<?php

use PHPUnit\Framework\TestCase;
use App\Entity\Dj;

class DjTest extends TestCase
{
    public function testGetSetNom()
    {
        $dj = new Dj();
        $dj->setNom('Smith');
        $this->assertEquals('Smith', $dj->getNom());
    }

    public function testGetSetPrenom()
    {
        $dj = new Dj();
        $dj->setPrenom('John');
        $this->assertEquals('John', $dj->getPrenom());
    }

    public function testGetSetEmail()
    {
        $dj = new Dj();
        $dj->setEmail('john@example.com');
        $this->assertEquals('john@example.com', $dj->getEmail());
    }

    public function testGetSetTel()
    {
        $dj = new Dj();
        $dj->setTel(123456789);
        $this->assertEquals(123456789, $dj->getTel());
    }

    public function testGetSetPortfolio()
    {
        $dj = new Dj();
        $dj->setPortfolio('portfolio link');
        $this->assertEquals('portfolio link', $dj->getPortfolio());
    }

    public function testGetSetDateSoiree()
    {
        $dj = new Dj();
        $date = new \DateTime('2023-05-01');
        $dj->setDateSoiree($date);
        $this->assertEquals($date, $dj->getDateSoiree());
    }

    public function testGetSetHasMaterial()
    {
        $dj = new Dj();
        $dj->setHasMaterial(true);
        $this->assertTrue($dj->hasMaterial());
    }

    public function testGetSetColor()
    {
        $dj = new Dj();
        $dj->setColor('red');
        $this->assertEquals('red', $dj->getColor());
    }

    public function testGetSetNbSpeaker()
    {
        $dj = new Dj();
        $dj->setNbSpeaker(4);
        $this->assertEquals(4, $dj->getNbSpeaker());
    }

    public function testGetSetPowerSpeaker()
    {
        $dj = new Dj();
        $dj->setPowerSpeaker(500);
        $this->assertEquals(500, $dj->getPowerSpeaker());
    }
}
