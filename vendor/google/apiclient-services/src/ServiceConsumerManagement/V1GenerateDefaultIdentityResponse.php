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

namespace Google\Service\ServiceConsumerManagement;

class V1GenerateDefaultIdentityResponse extends \Google\Model
{
  /**
   * @var string
   */
  public $attachStatus;
  /**
   * @var V1DefaultIdentity
   */
  public $identity;
  protected $identityType = V1DefaultIdentity::class;
  protected $identityDataType = '';
  /**
   * @var string
   */
  public $role;

  /**
   * @param string
   */
  public function setAttachStatus($attachStatus)
  {
    $this->attachStatus = $attachStatus;
  }
  /**
   * @return string
   */
  public function getAttachStatus()
  {
    return $this->attachStatus;
  }
  /**
   * @param V1DefaultIdentity
   */
  public function setIdentity(V1DefaultIdentity $identity)
  {
    $this->identity = $identity;
  }
  /**
   * @return V1DefaultIdentity
   */
  public function getIdentity()
  {
    return $this->identity;
  }
  /**
   * @param string
   */
  public function setRole($role)
  {
    $this->role = $role;
  }
  /**
   * @return string
   */
  public function getRole()
  {
    return $this->role;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(V1GenerateDefaultIdentityResponse::class, 'Google_Service_ServiceConsumerManagement_V1GenerateDefaultIdentityResponse');
