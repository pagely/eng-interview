<?php
namespace Pagely\Interview\API\Stats;

use Equip\Data\EntityInterface;
use Equip\Data\Traits\EntityTrait;
use Pagely\ApiFramework\Contract\ActionInputInterface;

use Pagely\ApiFramework\InputDefinition\AccountPermissionInputInterface;
use Pagely\ApiFramework\InputDefinition\AccountPermissionInputTrait;

use Pagely\Metabolize\Annotations\API\Input;
use Pagely\ApiFramework\InputDefinition\AuthInputTrait;

use Pagely\ApiFramework\InputDefinition\ResponseNotFoundInputTrait;
use Pagely\ApiFramework\InputDefinition\ResponseValidationInputTrait;
use Pagely\ApiFramework\InputDefinition\ResponseSuccessInputTrait;

use Pagely\Model\InputDefinitions\Pagely\Query\ServerIdsTrait;
use Pagely\Model\InputDefinitions\Pagely\Query\ServerNamesTrait;
use Pagely\Model\InputDefinitions\Pagely\Query\ServerTypesTrait;

use Pagely\ApiFramework\InputDefinition\Security\AdminOrAccountuserTrait;

/**
 * @Input\Request(
 *     title="Get CPU Stats for all of an account's servers",
 *     path="/analytics/accounts/{accountId}/server-cpu",
 *     method="GET",
 *     contentType="application/json",
 * )
 */
class CPUInputDefinition implements EntityInterface, ActionInputInterface, AccountPermissionInputInterface, ColumnsProvider
{
    use EntityTrait;
    use AuthInputTrait;
    use AccountPermissionInputTrait;
    use AdminOrAccountuserTrait;

    use ResponseNotFoundInputTrait;
    use ResponseValidationInputTrait;
    use ResponseSuccessInputTrait;

    use StatsEndpointInputTrait;
    use StatsDataEndpointInputTrait;

    use ServerIdsTrait;
    use ServerNamesTrait;
    use ServerTypesTrait;
}
