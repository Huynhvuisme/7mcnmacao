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

namespace Google\Service\Vision;

class GroupedResult extends \Google\Collection
{
  protected $collection_key = 'results';
  /**
   * @var BoundingPoly
   */
  public $boundingPoly;
  protected $boundingPolyType = BoundingPoly::class;
  protected $boundingPolyDataType = '';
  /**
   * @var ObjectAnnotation[]
   */
  public $objectAnnotations;
  protected $objectAnnotationsType = ObjectAnnotation::class;
  protected $objectAnnotationsDataType = 'array';
  /**
   * @var Result[]
   */
  public $results;
  protected $resultsType = Result::class;
  protected $resultsDataType = 'array';

  /**
   * @param BoundingPoly
   */
  public function setBoundingPoly(BoundingPoly $boundingPoly)
  {
    $this->boundingPoly = $boundingPoly;
  }
  /**
   * @return BoundingPoly
   */
  public function getBoundingPoly()
  {
    return $this->boundingPoly;
  }
  /**
   * @param ObjectAnnotation[]
   */
  public function setObjectAnnotations($objectAnnotations)
  {
    $this->objectAnnotations = $objectAnnotations;
  }
  /**
   * @return ObjectAnnotation[]
   */
  public function getObjectAnnotations()
  {
    return $this->objectAnnotations;
  }
  /**
   * @param Result[]
   */
  public function setResults($results)
  {
    $this->results = $results;
  }
  /**
   * @return Result[]
   */
  public function getResults()
  {
    return $this->results;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GroupedResult::class, 'Google_Service_Vision_GroupedResult');
