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

class GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCase extends \Google\Collection
{
  protected $collection_key = 'caseContent';
  /**
   * @var GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCaseCaseContent[]
   */
  public $caseContent;
  protected $caseContentType = GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCaseCaseContent::class;
  protected $caseContentDataType = 'array';
  /**
   * @var string
   */
  public $condition;

  /**
   * @param GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCaseCaseContent[]
   */
  public function setCaseContent($caseContent)
  {
    $this->caseContent = $caseContent;
  }
  /**
   * @return GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCaseCaseContent[]
   */
  public function getCaseContent()
  {
    return $this->caseContent;
  }
  /**
   * @param string
   */
  public function setCondition($condition)
  {
    $this->condition = $condition;
  }
  /**
   * @return string
   */
  public function getCondition()
  {
    return $this->condition;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCase::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowCxV3FulfillmentConditionalCasesCase');
