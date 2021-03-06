<?php
namespace Wurfl;

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
 * @category   WURFL
 * @package    WURFL
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
/**
 * WURFL Context stores the persistence provider, cache provider and logger objects
 * @package    WURFL
 * 
 * @property-read \Wurfl\Storage\StorageInterface $persistenceProvider
 * @property-read \Wurfl\Storage\StorageInterface $cacheProvider
 * @property-read \Wurfl\Logger\LoggerInterface $logger
 */
class Context {
    
    /**
     * @var \Wurfl\Storage\StorageInterface
     */
    private $_persistenceProvider;
    /**
     * @var \Wurfl\Storage\StorageInterface
     */
    private $_cacheProvider;
    /**
     * @var \Wurfl\Logger\LoggerInterface
     */
    private $_logger;
    
    public function __construct(\Wurfl\Storage\StorageInterface $persistenceProvider, \Wurfl\Storage\StorageInterface $cacheProvider = null, \Wurfl\Logger\LoggerInterface $logger = null) {
        $this->_persistenceProvider = $persistenceProvider;
        $this->_cacheProvider = is_null($cacheProvider)? new \Wurfl\Storage\NullStorage(): $cacheProvider;
        $this->_logger = is_null($logger)? new \Wurfl\Logger\NullLogger(): $logger;
    }
    
    public function cacheProvider($cacheProvider) {
        $this->_cacheProvider = is_null($cacheProvider)? new \Wurfl\Storage\NullStorage(): $cacheProvider;
        return $this;
    }
    
    public function logger($logger) {
        $this->_logger = is_null($logger)? new \Wurfl\Logger\NullLogger(): $logger;
        return $this;
    }
    
    public function __get($name) {
        $name = '_'.$name;
        return $this->$name;
    }
}