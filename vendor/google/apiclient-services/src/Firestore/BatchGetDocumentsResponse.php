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

namespace Google\Service\Firestore;

class BatchGetDocumentsResponse extends \Google\Model
{
  /**
   * @var Document
   */
  public $found;
  protected $foundType = Document::class;
  protected $foundDataType = '';
  /**
   * @var string
   */
  public $missing;
  /**
   * @var string
   */
  public $readTime;
  /**
   * @var string
   */
  public $transaction;

  /**
   * @param Document
   */
  public function setFound(Document $found)
  {
    $this->found = $found;
  }
  /**
   * @return Document
   */
  public function getFound()
  {
    return $this->found;
  }
  /**
   * @param string
   */
  public function setMissing($missing)
  {
    $this->missing = $missing;
  }
  /**
   * @return string
   */
  public function getMissing()
  {
    return $this->missing;
  }
  /**
   * @param string
   */
  public function setReadTime($readTime)
  {
    $this->readTime = $readTime;
  }
  /**
   * @return string
   */
  public function getReadTime()
  {
    return $this->readTime;
  }
  /**
   * @param string
   */
  public function setTransaction($transaction)
  {
    $this->transaction = $transaction;
  }
  /**
   * @return string
   */
  public function getTransaction()
  {
    return $this->transaction;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BatchGetDocumentsResponse::class, 'Google_Service_Firestore_BatchGetDocumentsResponse');
