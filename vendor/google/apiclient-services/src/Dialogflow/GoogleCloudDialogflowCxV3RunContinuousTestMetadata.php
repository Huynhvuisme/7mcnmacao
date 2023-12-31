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

class GoogleCloudDialogflowCxV3RunContinuousTestMetadata extends \Google\Collection
{
  protected $collection_key = 'errors';
  /**
   * @var GoogleCloudDialogflowCxV3TestError[]
   */
  public $errors;
  protected $errorsType = GoogleCloudDialogflowCxV3TestError::class;
  protected $errorsDataType = 'array';

  /**
   * @param GoogleCloudDialogflowCxV3TestError[]
   */
  public function setErrors($errors)
  {
    $this->errors = $errors;
  }
  /**
   * @return GoogleCloudDialogflowCxV3TestError[]
   */
  public function getErrors()
  {
    return $this->errors;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3RunContinuousTestMetadata::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3RunContinuousTestMetadata');
