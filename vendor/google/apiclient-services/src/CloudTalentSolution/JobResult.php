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

namespace Google\Service\CloudTalentSolution;

class JobResult extends \Google\Model
{
  /**
   * @var Job
   */
  public $job;
  protected $jobType = Job::class;
  protected $jobDataType = '';
  /**
   * @var Status
   */
  public $status;
  protected $statusType = Status::class;
  protected $statusDataType = '';

  /**
   * @param Job
   */
  public function setJob(Job $job)
  {
    $this->job = $job;
  }
  /**
   * @return Job
   */
  public function getJob()
  {
    return $this->job;
  }
  /**
   * @param Status
   */
  public function setStatus(Status $status)
  {
    $this->status = $status;
  }
  /**
   * @return Status
   */
  public function getStatus()
  {
    return $this->status;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(JobResult::class, 'Google_Service_CloudTalentSolution_JobResult');
