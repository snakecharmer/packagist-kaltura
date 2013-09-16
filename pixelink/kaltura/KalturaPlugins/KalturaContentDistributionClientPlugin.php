<?php
require_once(dirname(__FILE__) . "/../KalturaClientBase.php");
require_once(dirname(__FILE__) . "/../KalturaEnums.php");
require_once(dirname(__FILE__) . "/../KalturaTypes.php");

class KalturaDistributionAction
{
	const SUBMIT = 1;
	const UPDATE = 2;
	const DELETE = 3;
	const FETCH_REPORT = 4;
}

class KalturaDistributionErrorType
{
	const MISSING_FLAVOR = 1;
	const MISSING_THUMBNAIL = 2;
	const MISSING_METADATA = 3;
	const INVALID_DATA = 4;
}

class KalturaDistributionValidationErrorType
{
	const CUSTOM_ERROR = 0;
	const STRING_EMPTY = 1;
	const STRING_TOO_LONG = 2;
	const STRING_TOO_SHORT = 3;
	const INVALID_FORMAT = 4;
}

class KalturaEntryDistributionFlag
{
	const NONE = 0;
	const SUBMIT_REQUIRED = 1;
	const DELETE_REQUIRED = 2;
	const UPDATE_REQUIRED = 3;
}

class KalturaEntryDistributionStatus
{
	const PENDING = 0;
	const QUEUED = 1;
	const READY = 2;
	const DELETED = 3;
	const SUBMITTING = 4;
	const UPDATING = 5;
	const DELETING = 6;
	const ERROR_SUBMITTING = 7;
	const ERROR_UPDATING = 8;
	const ERROR_DELETING = 9;
	const REMOVED = 10;
}

class KalturaEntryDistributionSunStatus
{
	const BEFORE_SUNRISE = 1;
	const AFTER_SUNRISE = 2;
	const AFTER_SUNSET = 3;
}

class KalturaContentDistributionSearchItem extends KalturaSearchItem
{
	/**
	 * 
	 *
	 * @var bool
	 */
	public $noDistributionProfiles = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $distributionProfileId = null;

	/**
	 * 
	 *
	 * @var KalturaEntryDistributionSunStatus
	 */
	public $distributionSunStatus = null;

	/**
	 * 
	 *
	 * @var KalturaEntryDistributionFlag
	 */
	public $entryDistributionFlag = null;

	/**
	 * 
	 *
	 * @var KalturaEntryDistributionStatus
	 */
	public $entryDistributionStatus = null;

	/**
	 * 
	 *
	 * @var bool
	 */
	public $hasEntryDistributionValidationErrors = null;

	/**
	 * Comma seperated validation error types
	 *
	 * @var string
	 */
	public $entryDistributionValidationErrors = null;


}

abstract class KalturaDistributionValidationError extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var KalturaDistributionAction
	 */
	public $action = null;

	/**
	 * 
	 *
	 * @var KalturaDistributionErrorType
	 */
	public $errorType = null;

	/**
	 * 
	 *
	 * @var string
	 */
	public $description = null;


}

class KalturaDistributionValidationErrorMissingMetadata extends KalturaDistributionValidationError
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $fieldName = null;


}

class KalturaDistributionThumbDimensions extends KalturaObjectBase
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $width = null;

	/**
	 * 
	 *
	 * @var int
	 */
	public $height = null;


}

class KalturaDistributionValidationErrorMissingThumbnail extends KalturaDistributionValidationError
{
	/**
	 * 
	 *
	 * @var KalturaDistributionThumbDimensions
	 */
	public $dimensions;


}

class KalturaDistributionValidationErrorMissingFlavor extends KalturaDistributionValidationError
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $flavorParamsId = null;


}

class KalturaDistributionValidationErrorInvalidData extends KalturaDistributionValidationError
{
	/**
	 * 
	 *
	 * @var string
	 */
	public $fieldName = null;

	/**
	 * 
	 *
	 * @var KalturaDistributionValidationErrorType
	 */
	public $validationErrorType = null;

	/**
	 * Parameter of the validation error
	 * For example, minimum value for KalturaDistributionValidationErrorType::STRING_TOO_SHORT validation error
	 *
	 * @var string
	 */
	public $validationErrorParam = null;


}

class KalturaDistributionValidationErrorInvalidMetadata extends KalturaDistributionValidationErrorInvalidData
{
	/**
	 * 
	 *
	 * @var int
	 */
	public $metadataProfileId = null;


}

class KalturaContentDistributionClientPlugin extends KalturaClientPlugin
{
	/**
	 * @var KalturaContentDistributionClientPlugin
	 */
	protected static $instance;

	protected function __construct(KalturaClient $client)
	{
		parent::__construct($client);
	}

	/**
	 * @return KalturaContentDistributionClientPlugin
	 */
	public static function get(KalturaClient $client)
	{
		if(!self::$instance)
			self::$instance = new KalturaContentDistributionClientPlugin($client);
		return self::$instance;
	}

	/**
	 * @return array<KalturaServiceBase>
	 */
	public function getServices()
	{
		$services = array(
		);
		return $services;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'contentDistribution';
	}
}

