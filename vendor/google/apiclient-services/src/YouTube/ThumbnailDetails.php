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

namespace Google\Service\YouTube;

class ThumbnailDetails extends \Google\Model
{
  /**
   * @var Thumbnail
   */
  public $default;
  protected $defaultType = Thumbnail::class;
  protected $defaultDataType = '';
  /**
   * @var Thumbnail
   */
  public $high;
  protected $highType = Thumbnail::class;
  protected $highDataType = '';
  /**
   * @var Thumbnail
   */
  public $maxres;
  protected $maxresType = Thumbnail::class;
  protected $maxresDataType = '';
  /**
   * @var Thumbnail
   */
  public $medium;
  protected $mediumType = Thumbnail::class;
  protected $mediumDataType = '';
  /**
   * @var Thumbnail
   */
  public $standard;
  protected $standardType = Thumbnail::class;
  protected $standardDataType = '';

  /**
   * @param Thumbnail
   */
  public function setDefault(Thumbnail $default)
  {
    $this->default = $default;
  }
  /**
   * @return Thumbnail
   */
  public function getDefault()
  {
    return $this->default;
  }
  /**
   * @param Thumbnail
   */
  public function setHigh(Thumbnail $high)
  {
    $this->high = $high;
  }
  /**
   * @return Thumbnail
   */
  public function getHigh()
  {
    return $this->high;
  }
  /**
   * @param Thumbnail
   */
  public function setMaxres(Thumbnail $maxres)
  {
    $this->maxres = $maxres;
  }
  /**
   * @return Thumbnail
   */
  public function getMaxres()
  {
    return $this->maxres;
  }
  /**
   * @param Thumbnail
   */
  public function setMedium(Thumbnail $medium)
  {
    $this->medium = $medium;
  }
  /**
   * @return Thumbnail
   */
  public function getMedium()
  {
    return $this->medium;
  }
  /**
   * @param Thumbnail
   */
  public function setStandard(Thumbnail $standard)
  {
    $this->standard = $standard;
  }
  /**
   * @return Thumbnail
   */
  public function getStandard()
  {
    return $this->standard;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ThumbnailDetails::class, 'Google_Service_YouTube_ThumbnailDetails');
