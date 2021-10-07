<?php

namespace App\Tests;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SearchTest extends KernelTestCase
{
    /** @var EntityManagerInterface */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        DatabasePrimer::prime($kernel);

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    /** @test */
    public function testItWorks()
    {
        $video = new Video();

        $video->setQ('music');
        $video->setPart('snippet');
        $video->setRegionCode('US');

        $this->entityManager->persist($video);

        $videoRepository = $this->entityManager->getRepository(Video::class);

        // $videoSearch = $videoRepository->findOneBy(['q' => 'music']);

        $this->assertEquals('music', $video->getQ());
        $this->assertEquals('snippet', $video->getPart());
        $this->assertEquals('US', $video->getRegionCode());
        
    }

}