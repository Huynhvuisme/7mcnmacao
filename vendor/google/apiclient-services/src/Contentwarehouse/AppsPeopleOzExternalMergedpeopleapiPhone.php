<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Contentwarehouse;

class AppsPeopleOzExternalMergedpeopleapiPhone extends \Google\Model
{
  /**
   * @var string
   */
  public $canonicalizedForm;
  /**
   * @var AppsPeopleOzExternalMergedpeopleapiFieldEmergencyInfo
   */
  public $emergencyInfo;
  protected $emergencyInfoType = AppsPeopleOzExternalMergedpeopleapiFieldEmergencyInfo::class;
  protected $emergencyInfoDataType = '';
  /**
   * @var AppsPeopleOzExternalMergedpeopleapiPhoneExtendedData
   */
  public $extendedData;
  protected $extendedDataType = AppsPeopleOzExternalMergedpeopleapiPhoneExtendedData::class;
  protected $extendedDataDataType = '';
  /**
   * @var string
   */
  public $formattedType;
  /**
   * @var AppsPeopleOzExternalMergedpeopleapiPersonFieldMetadata
   */
  public $metadata;
  protected $metadataType = AppsPeopleOzExternalMergedpeopleapiPersonFieldMetadata::class;
  protected $metadataDataType = '';
  /**
   * @var string
   */
  public $type;
  /**
   * @var string
   */
  public $uri;
  /**
   * @var string
   */
  public $value;

  /**
   * @param string
   */
  public function setCanonicalizedForm($canonicalizedForm)
  {
    $this->canonicalizedForm = $canonicalizedForm;
  }
  /**
   * @return string
   */
  public function getCanonicalizedForm()
  {
    return $this->canonicalizedForm;
  }
  /**
   * @param AppsPeopleOzExternalMergedpeopleapiFieldEmergencyInfo
   */
  public function setEmergencyInfo(AppsPeopleOzExternalMergedpeopleapiFieldEmergencyInfo $emergencyInfo)
  {
    $this->emergencyInfo = $emergencyInfo;
  }
  /**
   * @return AppsPeopleOzExternalMergedpeopleapiFieldEmergencyInfo
   */
  public function getEmergencyInfo()
  {
    return $this->emergencyInfo;
  }
  /**
   * @param AppsPeopleOzExternalMergedpeopleapiPhoneExtendedData
   */
  public function setExtendedData(AppsPeopleOzExternalMergedpeopleapiPhoneExtendedData $extendedData)
  {
    $this->extendedData = $extendedData;
  }
  /**
   * @return AppsPeopleOzExternalMergedpeopleapiPhoneExtendedData
   */
  public function getExtendedData()
  {
    return $this->extendedData;
  }
  /**
   * @param string
   */
  public function setFormattedType($formattedType)
  {
    $this->formattedType = $formattedType;
  }
  /**
   * @return string
   */
  public function getFormattedType()
  {
    return $this->formattedType;
  }
  /**
   * @param AppsPeopleOzExternalMergedpeopleapiPersonFieldMetadata
   */
  public function setMetadata(AppsPeopleOzExternalMergedpeopleapiPersonFieldMetadata $metadata)
  {
    $this->metadata = $metadata;
  }
  /**
   * @return AppsPeopleOzExternalMergedpeopleapiPersonFieldMetadata
   */
  public function getMetadata()
  {
    return $this->metadata;
  }
  /**
   * @param string
   */
  public function setType($type)
  {
    $this->type = $type;
  }
  /**
   * @return string
   */
  public function getType()
  {
    return $this->type;
  }
  /**
   * @param string
   */
  public function setUri($uri)
  {
    $this->uri = $uri;
  }
  /**
   * @return string
   */
  public function getUri()
  {
    return $this->uri;
  }
  /**
   * @param string
   */
  public function setValue($value)
  {
    $this->value = $value;
  }
  /**
   * @return string
   */
  public function getValue()
  {
    return $this->value;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AppsPeopleOzExternalMergedpeopleapiPhone::class, 'Google_Service_Contentwarehouse_AppsPeopleOzExternalMergedpeopleapiPhone');
