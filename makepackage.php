<?php
/* $Id$ */
require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);
unlink('package.xml');

$releaseVersion = '0.2.0';
$apiVersion = '0.1.0';
$changelog = '
  - Added errorHandlerCallback in Services_YouTube_Exception class.
  - Added set_error_hander in sendRequest method.
  ';
$notes = $changelog;
$packagexml = new PEAR_PackageFileManager2();
$packagexml->setOptions(array('filelistgenerator' => 'file',
      'packagefile' => 'package2.xml',
      'packagedirectory' => dirname(__FILE__),
      'baseinstalldir' => 'Services',
      'ignore' => array('makepackage.php', 'Documentation/', 'ver/', 'CVS/'),
      'simpleoutput' => true,
      'changelogoldtonew' => true,
      'changelognotes' => $changelog,
      'exceptions' => array('ChangeLog' => 'doc'),
      'dir_roles' => array('examples' => 'doc', 'docs' => 'doc', 'tests' => 'test')));
$packagexml->setPackageType('php');
$packagexml->addRelease();
$packagexml->setChannel('pear.php.net');
$packagexml->setPackage('Services_YouTube');
$packagexml->setReleaseVersion($releaseVersion);
$packagexml->setAPIVersion($apiVersion);
$packagexml->setReleaseStability('alpha');
$packagexml->setAPIStability('alpha');
$packagexml->setSummary('PHP Client for YouTube API');
$packagexml->setDescription('PHP Client for YouTube API');
$packagexml->setNotes($notes);
$packagexml->setPhpDep('5.1.0');
$packagexml->setPearinstallerDep('1.4.0a12');
$packagexml->addExtensionDep('required', 'simplexml');
$packagexml->addExtensionDep('required', 'curl');
$packagexml->addPackageDepWithChannel('optional', 'Cache_Lite', 'pear.php.net');
$packagexml->addPackageDepWithChannel('optional', 'XML_RPC2', 'pear.php.net');
$packagexml->addMaintainer('lead', 'shin', 'Shin Ohno', 'ganchiku@gmail.com');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');
$packagexml->addGlobalReplacement('package-info', '@PEAR-VER@', 'version');
$packagexml->generateContents();
$pkg = &$packagexml->exportCompatiblePackageFile1();
if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $pkg->writePackageFile();
    $packagexml->writePackageFile();
} else {
    $pkg->debugPackageFile();
    $packagexml->debugPackageFile();
}
?>
