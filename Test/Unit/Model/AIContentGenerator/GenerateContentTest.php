<?php

declare(strict_types=1);

namespace Creatuity\AIContent\Test\Unit\Model\AIContentGenerator;

use Creatuity\AIContent\Api\AIProviderInterface;
use Creatuity\AIContent\Api\Data\AIRequestInterface;
use Creatuity\AIContent\Api\Data\AIRequestInterfaceFactory;
use Creatuity\AIContent\Api\Data\AIResponseInterface;
use Creatuity\AIContent\Api\Data\PromptInterface;
use Creatuity\AIContent\Api\Data\SpecificationInterface;
use Creatuity\AIContent\Model\AIContentGenerator\GenerateContent;
use Creatuity\AIContent\Model\GetAIProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GenerateContentTest extends TestCase
{
    private readonly GetAIProvider|MockObject $provider;
    private readonly AIRequestInterfaceFactory|MockObject $AIRequestInterfaceFactory;

    protected function setUp(): void
    {
        $this->provider = $this->createMock(GetAIProvider::class);
        $this->AIRequestInterfaceFactory = $this->getMockBuilder(AIRequestInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();
    }

    public function testExecute(): void
    {
        $storeId = 1;
        $prompt = $this->createMock(PromptInterface::class);
        $apiRequest = $this->createMock(AIRequestInterface::class);
        $this->AIRequestInterfaceFactory
            ->expects($this->once())
            ->method('create')
            ->with(['data' => ['prompt' => [$prompt]]])
            ->willReturn($apiRequest);
        $spec = $this->createMock(SpecificationInterface::class);
        $spec->expects($this->once())->method('getStoreId')->willReturn($storeId);
        $apiResponse = $this->createMock(AIResponseInterface::class);
        $provider = $this->createMock(AIProviderInterface::class);
        $provider->expects($this->once())->method('call')->with($apiRequest, $spec)->willReturn($apiResponse);
        $this->provider->expects($this->once())->method('execute')->with($storeId)->willReturn($provider);
        $object = new GenerateContent($this->provider, $this->AIRequestInterfaceFactory);
        $this->assertSame($apiResponse, $object->execute([$prompt], $spec));
    }
}