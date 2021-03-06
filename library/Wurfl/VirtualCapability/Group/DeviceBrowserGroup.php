<?php
namespace Wurfl\VirtualCapability\Group;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 *
 * @category   WURFL
 * @package    \Wurfl\VirtualCapability\VirtualCapability
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
/**
 * @package \Wurfl\VirtualCapability\VirtualCapability
 */
class DeviceBrowserGroup extends Group {

    protected $required_capabilities = array();

    protected $storage = array(
        'DeviceOs' => null,
        'DeviceOsVersion' => null,
        'Browser' => null,
        'BrowserVersion' => null,
    );

    /**
     * @var \Wurfl\VirtualCapability\UserAgentTool
    */
    protected static $ua_tool;

    public function compute() {
        if (self::$ua_tool === null) {
            self::$ua_tool = new \Wurfl\VirtualCapability\UserAgentTool();
        }

        // Run the UserAgentTool to get the relevant details
        $device = self::$ua_tool->getDevice($this->request->userAgent);

        $this->storage['DeviceOs']        = new \Wurfl\VirtualCapability\Group\ManualGroupChild($this->device, $this->request, $this, $device->os->name);
        $this->storage['DeviceOsVersion'] = new \Wurfl\VirtualCapability\Group\ManualGroupChild($this->device, $this->request, $this, $device->os->version);
        $this->storage['Browser']         = new \Wurfl\VirtualCapability\Group\ManualGroupChild($this->device, $this->request, $this, $device->browser->name);
        $this->storage['BrowserVersion']  = new \Wurfl\VirtualCapability\Group\ManualGroupChild($this->device, $this->request, $this, $device->browser->version);
    }
}
