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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowCxV3VariantsHistory extends \Google\Model
{
  /**
   * @var string
   */
  public $updateTime;
  /**
   * @var GoogleCloudDialogflowCxV3VersionVariants
   */
  public $versionVariants;
  protected $versionVariantsType = GoogleCloudDialogflowCxV3VersionVariants::class;
  protected $versionVariantsDataType = '';

  /**
   * @param string
   */
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  /**
   * @return string
   */
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
  /**
   * @param GoogleCloudDialogflowCxV3VersionVariants
   */
  public function setVersionVariants(GoogleCloudDialogflowCxV3VersionVariants $versionVariants)
  {
    $this->versionVariants = $versionVariants;
  }
  /**
   * @return GoogleCloudDialogflowCxV3VersionVariants
   */
  public function getVersionVariants()
  {
    return $this->versionVariants;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3VariantsHistory::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3VariantsHistory');
