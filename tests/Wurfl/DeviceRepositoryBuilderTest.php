<?php
/**
 * test case
 */

/**
 * \Wurfl\DeviceRepositoryBuilder test case.
 */
class \Wurfl\DeviceRepositoryBuilderTest extends PHPUnit_Framework_TestCase
{

    const WURFL_FILE     = '../resources/wurfl_base.xml';
    const PATCH_FILE_ONE = '../resources/patch1.xml';
    const PATCH_FILE_TWO = '../resources/patch2.xml';

    /** @var  \Wurfl\DeviceRepositoryBuilder */
    private $deviceRepositoryBuilder;

    public function setUp()
    {
        $persistenceProvider   = new \Wurfl\Storage\Memory();
        $context               = new \Wurfl\Context ($persistenceProvider);
        $userAgentHandlerChain = \Wurfl\UserAgentHandlerChainFactory::createFrom($context);
        $devicePatcher         = new \Wurfl\Xml\DevicePatcher ();
        $this->deviceRepositoryBuilder
                               = new \Wurfl\DeviceRepositoryBuilder ($persistenceProvider, $userAgentHandlerChain, $devicePatcher);
    }

    public function testShouldBuildARepositoryOfAllDevicesFromTheXmlFile()
    {
        $wurflFile        = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::WURFL_FILE;
        $deviceRepository = $this->deviceRepositoryBuilder->build($wurflFile);
        self::assertNotNull($deviceRepository);
        self::assertEquals("Thu Jun 03 12:01:14 -0500 2010", $deviceRepository->getLastUpdated());
        $genericDevice = $deviceRepository->getDevice("generic");
        self::assertNotNull($genericDevice, "generic device is null");
    }

    public function testShouldAddNewDevice()
    {
        $wurflFile  = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::WURFL_FILE;
        $patchFile1 = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::PATCH_FILE_ONE;

        $deviceRepository = $this->deviceRepositoryBuilder->build($wurflFile, array($patchFile1));
        self::assertNotNull($deviceRepository);
        $newDevice1 = $deviceRepository->getDevice("generic_web_browser");
        self::assertNotNull($newDevice1, "generic web browser device is null");
        self::assertEquals("770", $newDevice1->getCapability("columns"));
    }

    public function testShouldApplyMoreThanOnePatches()
    {
        $wurflFile  = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::WURFL_FILE;
        $patchFile1 = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::PATCH_FILE_ONE;
        $patchFile2 = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::PATCH_FILE_TWO;

        $deviceRepository = $this->deviceRepositoryBuilder->build($wurflFile, array($patchFile1, $patchFile2));
        self::assertNotNull($deviceRepository);
        $newDevice1 = $deviceRepository->getDevice("generic_web_browser");
        self::assertNotNull($newDevice1, "generic web browser device is null");
        self::assertEquals("770", $newDevice1->getCapability("columns"));

        $newDevice2 = $deviceRepository->getDevice("generic_web_browser_new");
        self::assertNotNull($newDevice2, "generic web browser device is null");
        self::assertEquals("7", $newDevice2->getCapability("columns"));
    }

    public function testShouldNotRebuildTheRepositoryIfAlreadyBuild()
    {
        $persistenceProvider = new \Wurfl\Storage\Memory();
        $persistenceProvider->setWURFLLoaded(true);
        $context               = new \Wurfl\Context ($persistenceProvider);
        $userAgentHandlerChain = \Wurfl\UserAgentHandlerChainFactory::createFrom($context);
        $devicePatcher         = new \Wurfl\Xml\DevicePatcher ();
        $deviceRepositoryBuilder
                               = new \Wurfl\DeviceRepositoryBuilder ($persistenceProvider, $userAgentHandlerChain, $devicePatcher);
        self::assertNotNull($deviceRepositoryBuilder);
        $wurflFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . self::WURFL_FILE;

        try {
            $deviceRepository = $deviceRepositoryBuilder->build($wurflFile);
            $deviceRepository->getDevice("generic");
        } catch (\Exception $ex) {
        }
    }
}
