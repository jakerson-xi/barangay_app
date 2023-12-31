<?php
/**
* Copyright (c) Microsoft Corporation.  All Rights Reserved.  Licensed under the MIT License.  See License in the project root for license information.
* 
* PstnUserBlockMode File
* PHP version 7
*
* @category  Library
* @package   Microsoft.Graph
* @copyright (c) Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
namespace Beta\Microsoft\Graph\CallRecords\Model;

use Microsoft\Graph\Core\Enum;

/**
* PstnUserBlockMode class
*
* @category  Model
* @package   Microsoft.Graph
* @copyright (c) Microsoft Corporation. All rights reserved.
* @license   https://opensource.org/licenses/MIT MIT License
* @link      https://graph.microsoft.com
*/
class PstnUserBlockMode extends Enum
{
    /**
    * The Enum PstnUserBlockMode
    */
    const BLOCKED = "blocked";
    const UNBLOCKED = "unblocked";
    const UNKNOWN_FUTURE_VALUE = "unknownFutureValue";
}
